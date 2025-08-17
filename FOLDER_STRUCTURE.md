# 📁 SmartSpace Project Structure

## 🎯 **Main Files**
- `index.php` - Main login page (now clean and manageable!)
- `README.md` - Project documentation
- `database_setup.sql` - Database setup script
- `extend_session.php` - Session extension endpoint

## 📂 **Assets Folder**
```
assets/
├── css/
│   └── login.css          # All login page styles + security indicators
└── js/
    └── login.js           # Login page JavaScript + security features
```

## 📂 **Includes Folder**
```
includes/
└── login/
    ├── head.php               # HTML head section
    ├── scripts.php            # JavaScript includes & closing tags
    ├── login_header.php       # Left section + logo + branding + alerts
    ├── login_form.php         # Login form HTML
    └── login_footer.php       # Footer text
```

## 📂 **Config & Middleware**
```
config/
└── database.php           # Database connection class

middleware/
├── auth_middleware.php    # Authentication logic
├── rate_limiter.php       # Rate limiting & brute force protection
└── session_manager.php    # Session security & timeout management
```

## 📂 **Dashboard Pages**
```
views/
├── registrar.php          # Registrar dashboard
├── dept_admin.php         # Department Admin dashboard
├── teacher.php            # Teacher dashboard
└── student.php            # Student dashboard
```

## 🛡️ **Security Features**

### **Rate Limiting**
- **5 login attempts** allowed per IP address
- **15-minute lockout** after exceeding limit
- **IP-based tracking** with automatic cleanup
- **Visual indicators** showing remaining attempts

### **Session Management**
- **30-minute session timeout** (configurable)
- **Automatic session regeneration** every 5 minutes
- **IP address validation** (prevents session hijacking)
- **User agent validation** (additional security layer)
- **Secure cookie settings** (httponly, secure, samesite)

### **Login Security**
- **Brute force protection** with progressive delays
- **Failed attempt tracking** with database logging
- **Automatic role detection** (no manual selection needed)
- **Session timeout warnings** 5 minutes before expiry

## 🎨 **Benefits of This Structure**

1. **Clean index.php** - Only 50 lines of PHP logic!
2. **Easy to maintain** - Each component in its own file
3. **Reusable components** - Can include parts in other pages
4. **Better organization** - Clear separation of concerns
5. **Enterprise security** - Rate limiting, session management, brute force protection
6. **Team collaboration** - Multiple developers can work on different parts

## 🔧 **How to Use**

- **Add new styles**: Edit `assets/css/login.css`
- **Add new functionality**: Edit `assets/js/login.js`
- **Modify form**: Edit `includes/login/login_form.php`
- **Change branding**: Edit `includes/login/login_header.php`
- **Configure security**: Edit `middleware/rate_limiter.php` and `middleware/session_manager.php`
- **Add new pages**: Follow the same include pattern

## 📱 **Responsive Design**
All CSS is in `assets/css/login.css` with media queries for:
- Desktop (full split layout)
- Tablet (vertical layout)
- Mobile (form-only layout)

## 🚀 **New Security Features**

### **Rate Limiting Configuration**
```php
// In middleware/rate_limiter.php
private $maxAttempts = 5;        // Max login attempts
private $lockoutTime = 900;       // Lockout duration (15 min)
```

### **Session Configuration**
```php
// In middleware/session_manager.php
private $sessionTimeout = 1800;   // Session timeout (30 min)
private $regenerateInterval = 300; // Regenerate session ID (5 min)
```

### **Database Requirements**
- New `login_attempts` table for rate limiting
- Automatic cleanup of old records
- Indexed for optimal performance
