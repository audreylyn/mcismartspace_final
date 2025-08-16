<?php
class RateLimiter {
    private $db;
    private $maxAttempts = 5; // Maximum login attempts
    private $lockoutTime = 900; // 15 minutes in seconds
    private $ipAddress;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->ipAddress = $this->getClientIP();
    }
    
    /**
     * Check if login attempts are allowed
     */
    public function isAllowed() {
        try {
            // Clean up old records
            $this->cleanupOldRecords();
            
            // Check current attempts
            $query = "SELECT COUNT(*) as attempts, MAX(attempt_time) as last_attempt 
                     FROM login_attempts 
                     WHERE ip_address = :ip 
                     AND attempt_time > DATE_SUB(NOW(), INTERVAL :lockout_time SECOND)";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':ip', $this->ipAddress);
            $stmt->bindParam(':lockout_time', $this->lockoutTime, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetch();
            $attempts = $result['attempts'];
            $lastAttempt = $result['last_attempt'];
            
            // If max attempts reached, check if lockout period has passed
            if ($attempts >= $this->maxAttempts) {
                if ($lastAttempt) {
                    $lastAttemptTime = strtotime($lastAttempt);
                    $timeElapsed = time() - $lastAttemptTime;
                    
                    if ($timeElapsed < $this->lockoutTime) {
                        $remainingTime = $this->lockoutTime - $timeElapsed;
                        return [
                            'allowed' => false,
                            'remaining_time' => $remainingTime,
                            'message' => "Account temporarily locked. Try again in " . ceil($remainingTime / 60) . " minutes."
                        ];
                    } else {
                        // Lockout period has passed, reset attempts
                        $this->resetAttempts();
                        return ['allowed' => true];
                    }
                }
            }
            
            return ['allowed' => true];
            
        } catch (PDOException $e) {
            // If database error, allow login (fail open for security)
            error_log("Rate limiter error: " . $e->getMessage());
            return ['allowed' => true];
        }
    }
    
    /**
     * Record a failed login attempt
     */
    public function recordFailedAttempt($email) {
        try {
            $query = "INSERT INTO login_attempts (ip_address, email, attempt_time, success) 
                     VALUES (:ip, :email, NOW(), 0)";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':ip', $this->ipAddress);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            
        } catch (PDOException $e) {
            error_log("Failed to record login attempt: " . $e->getMessage());
        }
    }
    
    /**
     * Record a successful login attempt
     */
    public function recordSuccessfulAttempt($email) {
        try {
            $query = "INSERT INTO login_attempts (ip_address, email, attempt_time, success) 
                     VALUES (:ip, :email, NOW(), 1)";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':ip', $this->ipAddress);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            
            // Reset failed attempts for this IP
            $this->resetAttempts();
            
        } catch (PDOException $e) {
            error_log("Failed to record successful login: " . $e->getMessage());
        }
    }
    
    /**
     * Reset failed attempts for this IP
     */
    private function resetAttempts() {
        try {
            $query = "DELETE FROM login_attempts 
                     WHERE ip_address = :ip AND success = 0";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':ip', $this->ipAddress);
            $stmt->execute();
            
        } catch (PDOException $e) {
            error_log("Failed to reset attempts: " . $e->getMessage());
        }
    }
    
    /**
     * Clean up old records
     */
    private function cleanupOldRecords() {
        try {
            $query = "DELETE FROM login_attempts 
                     WHERE attempt_time < DATE_SUB(NOW(), INTERVAL 24 HOUR)";
            
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            
        } catch (PDOException $e) {
            error_log("Failed to cleanup old records: " . $e->getMessage());
        }
    }
    
    /**
     * Get client IP address
     */
    private function getClientIP() {
        $ipKeys = ['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'];
        
        foreach ($ipKeys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        
        return $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    }
    
    /**
     * Get remaining attempts
     */
    public function getRemainingAttempts() {
        try {
            $query = "SELECT COUNT(*) as attempts 
                     FROM login_attempts 
                     WHERE ip_address = :ip 
                     AND success = 0 
                     AND attempt_time > DATE_SUB(NOW(), INTERVAL :lockout_time SECOND)";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':ip', $this->ipAddress);
            $stmt->bindParam(':lockout_time', $this->lockoutTime, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetch();
            return max(0, $this->maxAttempts - $result['attempts']);
            
        } catch (PDOException $e) {
            return $this->maxAttempts;
        }
    }
}
?>
