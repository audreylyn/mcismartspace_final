<!-- Login Form -->
<form method="POST" action="">
    <div class="form-group">
        <label for="email" class="form-label">Email</label>
        <input type="email" 
               class="form-control" 
               id="email" 
               name="email" 
               placeholder="Enter your email"
               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" 
               required>
    </div>
    
    <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <div class="password-input-group">
            <input type="password" 
                   class="form-control" 
                   id="password" 
                   name="password" 
                   placeholder="Enter your password"
                   required>
            <button type="button" class="password-toggle" id="passwordToggle">
                <i class="fas fa-eye"></i>
            </button>
        </div>
    </div>
    
    <button type="submit" class="btn-signin" id="loginBtn">
        <i class="fas fa-sign-in-alt"></i> Sign In
    </button>
</form>
