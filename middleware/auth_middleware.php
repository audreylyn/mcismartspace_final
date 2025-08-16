<?php
require_once __DIR__ . '/../config/database.php';

class AuthMiddleware {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    
    public function authenticate($email, $password, $role) {
        try {
            $table = $this->getTableByRole($role);
            if (!$table) {
                return ['success' => false, 'message' => 'Invalid role selected'];
            }
            
            $emailColumn = $this->getEmailField($role);
            $query = "SELECT * FROM {$table} WHERE {$emailColumn} = :email LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch();
                
                // For demo purposes, using plain text comparison
                // In production, use password_verify() with hashed passwords
                if ($this->verifyPassword($password, $user, $role)) {
                    return [
                        'success' => true,
                        'user_id' => $user[$this->getIdField($role)],
                        'role' => $role,
                        'name' => $this->getUserName($user, $role)
                    ];
                } else {
                    return ['success' => false, 'message' => 'Invalid password'];
                }
            } else {
                return ['success' => false, 'message' => 'User not found'];
            }
            
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Database error: ' . $e->getMessage()];
        }
    }
    
    private function getTableByRole($role) {
        switch ($role) {
            case 'Registrar':
                return 'registrar';
            case 'Department Admin':
                return 'dept_admin';
            case 'Teacher':
                return 'teacher';
            case 'Student':
                return 'student';
            default:
                return false;
        }
    }
    
    private function getEmailField($role) {
        switch ($role) {
            case 'Registrar':
                return 'Reg_Email';
            case 'Department Admin':
                return 'Email';
            case 'Teacher':
                return 'Email';
            case 'Student':
                return 'Email';
            default:
                return 'Email';
        }
    }
    
    private function getIdField($role) {
        switch ($role) {
            case 'Registrar':
                return 'regid';
            case 'Department Admin':
                return 'AdminID';
            case 'Teacher':
                return 'TeacherID';
            case 'Student':
                return 'StudentID';
            default:
                return 'id';
        }
    }
    
    private function getUserName($user, $role) {
        switch ($role) {
            case 'Registrar':
                return 'Registrar';
            case 'Department Admin':
                return $user['FirstName'] . ' ' . $user['LastName'];
            case 'Teacher':
                return $user['FirstName'] . ' ' . $user['LastName'];
            case 'Student':
                return $user['FirstName'] . ' ' . $user['LastName'];
            default:
                return 'User';
        }
    }
    
    private function verifyPassword($password, $user, $role) {
        switch ($role) {
            case 'Registrar':
                return $password === $user['Reg_Password'];
            case 'Department Admin':
                return $password === $user['Password'];
            case 'Teacher':
                return $password === $user['Password'];
            case 'Student':
                return $password === $user['Password'];
            default:
                return false;
        }
    }
    
    public function isAuthenticated() {
        return isset($_SESSION['user_id']) && isset($_SESSION['role']);
    }
    
    public function requireAuth() {
        if (!$this->isAuthenticated()) {
            $this->redirectToLogin();
        }
    }
    
    public function requireRole($requiredRole) {
        $this->requireAuth();
        
        if ($_SESSION['role'] !== $requiredRole) {
            $this->redirectToLogin();
        }
    }
    
    private function redirectToLogin() {
        // Get the current script path and determine the base path
        $scriptPath = $_SERVER['SCRIPT_NAME'];
        
        // If we're in a dashboard subdirectory, go up to the root
        if (strpos($scriptPath, '/dashboard/') !== false) {
            $basePath = dirname(dirname($scriptPath));
        } else {
            $basePath = dirname($scriptPath);
        }
        
        // Ensure we don't end up with an empty path
        if ($basePath === '/') {
            $basePath = '';
        }
        
        $loginUrl = $basePath . '/index.php';
        header('Location: ' . $loginUrl);
        exit();
    }
    
    public function getCurrentUser() {
        if ($this->isAuthenticated()) {
            return [
                'id' => $_SESSION['user_id'],
                'role' => $_SESSION['role'],
                'email' => $_SESSION['email'],
                'name' => $_SESSION['name']
            ];
        }
        return null;
    }
    
    public function logout() {
        session_unset();
        session_destroy();
        $this->redirectToLogin();
    }
}
?>
