<?php
require_once 'config/database.php';
require_once 'middleware/auth_middleware.php';
require_once 'middleware/rate_limiter.php';
require_once 'middleware/session_manager.php';

// Initialize session manager
$sessionManager = new SessionManager();

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    // Validate current session
    if ($sessionManager->validateSession()) {
        $role = $_SESSION['role'];
        switch ($role) {
            case 'Registrar':
                header('Location: views/manage_admins.php');
                exit();
            case 'Department Admin':
                header('Location: views/dept_admin.php');
                exit();
            case 'Teacher':
                header('Location: views/teacher.php');
                exit();
            case 'Student':
                header('Location: views/student.php');
                exit();
        }
    } else {
        // Session is invalid, redirect to login
        $sessionManager->destroySession();
        header('Location: index.php?timeout=1');
        exit();
    }
}

$error_message = '';
$remainingAttempts = 5;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    if (empty($email) || empty($password)) {
        $error_message = 'Email and password are required';
    } else {
        // Initialize rate limiter
        $rateLimiter = new RateLimiter();
        
        // Check if login attempts are allowed
        $rateLimitCheck = $rateLimiter->isAllowed();
        
        if (!$rateLimitCheck['allowed']) {
            $error_message = $rateLimitCheck['message'];
            header('Location: index.php?rate_limit=1');
            exit();
        }
        
        // Get remaining attempts for display
        $remainingAttempts = $rateLimiter->getRemainingAttempts();
        
        // Try to authenticate with each role until one works
        $auth = new AuthMiddleware();
        $authenticated = false;
        
        $roles = ['Registrar', 'Department Admin', 'Teacher', 'Student'];
        foreach ($roles as $role) {
            $result = $auth->authenticate($email, $password, $role);
            if ($result['success']) {
                // Record successful login
                $rateLimiter->recordSuccessfulAttempt($email);
                
                // Create secure session
                $userData = [
                    'user_id' => $result['user_id'],
                    'role' => $result['role'],
                    'email' => $email,
                    'name' => $result['name']
                ];
                
                $sessionManager->createSession($userData);
                
                // Redirect based on role
                switch ($role) {
                    case 'Registrar':
                        header('Location: views/manage_admins.php');
                        exit();
                    case 'Department Admin':
                        header('Location: views/dept_admin.php');
                        exit();
                    case 'Teacher':
                        header('Location: views/teacher.php');
                        exit();
                    case 'Student':
                        header('Location: views/student.php');
                        exit();
                }
                $authenticated = true;
                break;
            }
        }
        
        if (!$authenticated) {
            // Record failed login attempt
            $rateLimiter->recordFailedAttempt($email);
            
            // Get updated remaining attempts
            $remainingAttempts = $rateLimiter->getRemainingAttempts();
            
            if ($remainingAttempts <= 0) {
                $error_message = 'Too many failed attempts. Account temporarily locked.';
                header('Location: index.php?rate_limit=1');
                exit();
            } else {
                $error_message = "Invalid email or password. {$remainingAttempts} attempts remaining.";
            }
        }
    }
}

// Include the HTML structure
include 'includes/login/head.php';
?>

<div class="login-container">
    <?php include 'includes/login/login_header.php'; ?>
    
    <?php include 'includes/login/login_form.php'; ?>
    
    <!-- Security Info -->
    <div class="security-info">
        <small class="text-muted">
            <i class="fas fa-shield-alt"></i> 
            <?php if ($remainingAttempts < 5): ?>
                <span class="text-warning"><?php echo $remainingAttempts; ?> login attempts remaining</span>
            <?php else: ?>
                Secure login system
            <?php endif; ?>
        </small>
    </div>
    
    <?php include 'includes/login/login_footer.php'; ?>
</div>

<?php include 'includes/login/scripts.php'; ?>
