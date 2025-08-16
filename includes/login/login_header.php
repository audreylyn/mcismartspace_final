<!-- Left Section with Building Image -->
<div class="left-section">
    <div class="left-content">
        <h1>MCiSmartSpace</h1>
        <p>Empowering Education Through Technology</p>
    </div>
</div>

<!-- Right Section with Login Form -->
<div class="right-section">
    <div class="login-form-container">
        <!-- Logo -->
        <div class="logo"></div>
        
        <!-- Brand Name -->
        <h1 class="brand-name">MCiSmartSpace</h1>
        <p class="subtitle">Meycauayan College</p>
        
        <!-- Error/Success Messages -->
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i> <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>
        
        <!-- Session Timeout Message -->
        <?php if (isset($_GET['timeout'])): ?>
            <div class="alert alert-warning">
                <i class="fas fa-clock"></i> Your session has expired. Please login again.
            </div>
        <?php endif; ?>
        
        <!-- Rate Limit Message -->
        <?php if (isset($_GET['rate_limit'])): ?>
            <div class="alert alert-danger">
                <i class="fas fa-ban"></i> Too many login attempts. Please wait before trying again.
            </div>
        <?php endif; ?>
