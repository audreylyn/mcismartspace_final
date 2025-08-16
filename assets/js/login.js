// Login page interactive effects and security features
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const inputs = document.querySelectorAll('.form-control');
    const loginBtn = document.getElementById('loginBtn');
    const securityInfo = document.querySelector('.security-info');
    
    // Password toggle functionality
    const passwordToggle = document.getElementById('passwordToggle');
    const passwordInput = document.getElementById('password');
    
    if (passwordToggle && passwordInput) {
        passwordToggle.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Update icon
            const icon = this.querySelector('i');
            if (type === 'password') {
                icon.className = 'fas fa-eye';
                icon.title = 'Show password';
            } else {
                icon.className = 'fas fa-eye-slash';
                icon.title = 'Hide password';
            }
        });
    }
    
    // Add focus effects
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    });
    
    // Form submission animation and validation
    form.addEventListener('submit', function(e) {
        // Check if button is already disabled (rate limiting)
        if (loginBtn.disabled) {
            e.preventDefault();
            return;
        }
        
        // Update button state
        loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Signing In...';
        loginBtn.disabled = true;
        
        // Add loading class to form
        form.classList.add('loading');
    });
    
    // Real-time password strength indicator
    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            const strength = calculatePasswordStrength(password);
            updatePasswordStrengthIndicator(strength);
        });
    }
    
    // Session timeout warning (if user is logged in)
    if (typeof sessionTimeout !== 'undefined') {
        startSessionTimeoutWarning();
    }
    
    // Rate limiting visual feedback
    updateRateLimitVisuals();
});

/**
 * Calculate password strength
 */
function calculatePasswordStrength(password) {
    let score = 0;
    
    if (password.length >= 8) score += 1;
    if (/[a-z]/.test(password)) score += 1;
    if (/[A-Z]/.test(password)) score += 1;
    if (/[0-9]/.test(password)) score += 1;
    if (/[^A-Za-z0-9]/.test(password)) score += 1;
    
    if (score <= 2) return 'weak';
    if (score <= 3) return 'medium';
    if (score <= 4) return 'strong';
    return 'very-strong';
}

/**
 * Update password strength indicator
 */
function updatePasswordStrengthIndicator(strength) {
    const passwordField = document.getElementById('password');
    const parent = passwordField.parentElement;
    
    // Remove existing strength classes
    parent.classList.remove('password-weak', 'password-medium', 'password-strong', 'password-very-strong');
    
    // Add new strength class
    parent.classList.add(`password-${strength}`);
    
    // Update visual feedback
    const strengthText = document.querySelector('.password-strength-text');
    if (strengthText) {
        strengthText.textContent = `Password strength: ${strength.replace('-', ' ')}`;
        strengthText.className = `password-strength-text text-${getStrengthColor(strength)}`;
    }
}

/**
 * Get color for password strength
 */
function getStrengthColor(strength) {
    switch (strength) {
        case 'weak': return 'danger';
        case 'medium': return 'warning';
        case 'strong': return 'info';
        case 'very-strong': return 'success';
        default: return 'secondary';
    }
}

/**
 * Update rate limiting visual indicators
 */
function updateRateLimitVisuals() {
    const securityInfo = document.querySelector('.security-info');
    if (!securityInfo) return;
    
    const warningText = securityInfo.querySelector('.text-warning');
    if (warningText) {
        const attempts = parseInt(warningText.textContent.match(/\d+/)[0]);
        
        if (attempts <= 2) {
            securityInfo.classList.add('rate-limit-danger');
        } else if (attempts <= 4) {
            securityInfo.classList.add('rate-limit-warning');
        }
    }
}

/**
 * Start session timeout warning
 */
function startSessionTimeoutWarning() {
    const warningTime = 5 * 60; // 5 minutes before timeout
    const sessionTimeout = parseInt(sessionTimeout) || 1800; // 30 minutes default
    
    setInterval(() => {
        const remainingTime = sessionTimeout - (Date.now() / 1000);
        
        if (remainingTime <= warningTime && remainingTime > 0) {
            showSessionTimeoutWarning(Math.ceil(remainingTime / 60));
        }
    }, 1000);
}

/**
 * Show session timeout warning
 */
function showSessionTimeoutWarning(minutes) {
    // Check if warning already shown
    if (document.querySelector('.session-timeout-warning')) return;
    
    const warning = document.createElement('div');
    warning.className = 'alert alert-warning session-timeout-warning';
    warning.innerHTML = `
        <i class="fas fa-clock"></i> 
        Your session will expire in ${minutes} minute${minutes > 1 ? 's' : ''}. 
        <button type="button" class="btn btn-sm btn-outline-warning ms-2" onclick="extendSession()">
            Extend Session
        </button>
    `;
    
    const form = document.querySelector('form');
    form.parentNode.insertBefore(warning, form);
}

/**
 * Extend session (AJAX call)
 */
function extendSession() {
    fetch('api/session.php', {
        method: 'POST',
        credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove warning
            const warning = document.querySelector('.session-timeout-warning');
            if (warning) warning.remove();
            
            // Show success message
            showMessage('Session extended successfully!', 'success');
        }
    })
    .catch(error => {
        console.error('Error extending session:', error);
        showMessage('Failed to extend session', 'danger');
    });
}

/**
 * Show message to user
 */
function showMessage(message, type = 'info') {
    const messageDiv = document.createElement('div');
    messageDiv.className = `alert alert-${type} alert-dismissible fade show`;
    messageDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    const container = document.querySelector('.login-form-container');
    container.insertBefore(messageDiv, container.firstChild);
    
    // Auto-remove after 5 seconds
    setTimeout(() => {
        if (messageDiv.parentNode) {
            messageDiv.remove();
        }
    }, 5000);
}

/**
 * Handle form errors gracefully
 */
function handleFormError(error) {
    console.error('Form error:', error);
    
    // Re-enable login button
    const loginBtn = document.getElementById('loginBtn');
    if (loginBtn) {
        loginBtn.innerHTML = '<i class="fas fa-sign-in-alt"></i> Sign In';
        loginBtn.disabled = false;
    }
    
    // Remove loading state
    const form = document.querySelector('form');
    if (form) {
        form.classList.remove('loading');
    }
    
    // Show error message
    showMessage('An error occurred. Please try again.', 'danger');
}
