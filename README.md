# SmartSpace - PHP Login System with Middleware

A comprehensive PHP-based login system with role-based authentication and middleware for educational institution management.

## Features

- **Role-based Authentication**: Supports 4 user roles (Registrar, Department Admin, Teacher, Student)
- **Secure Middleware**: Authentication and authorization middleware for protected routes
- **Modern UI**: Beautiful, responsive design using Bootstrap 5 and Font Awesome
- **Session Management**: Secure session handling with automatic redirects
- **Dashboard System**: Customized dashboards for each user role
- **Database Integration**: MySQL database with PDO for secure database operations

## User Roles

1. **Registrar** - Full system access, user management, reports
2. **Department Admin** - Department-specific management, student/teacher oversight
3. **Teacher** - Course management, grades, attendance, assignments
4. **Student** - Course enrollment, grades, schedule, assignments

## Database Setup

### 1. Create Database
```sql
CREATE DATABASE smartspace;
USE smartspace;
```

### 2. Create Tables
```sql
-- Roles Table
CREATE TABLE roles (
  RoleID INT NOT NULL AUTO_INCREMENT,
  RoleName VARCHAR(50) NOT NULL,
  PRIMARY KEY (RoleID)
);

INSERT INTO roles (RoleID, RoleName) VALUES
(1, 'Registrar'),
(2, 'Department Admin'),
(3, 'Teacher'),
(4, 'Student');

-- Registrar
CREATE TABLE registrar (
  regid INT NOT NULL AUTO_INCREMENT,
  Reg_Email VARCHAR(50) NOT NULL,
  Reg_Password VARCHAR(255) NOT NULL,
  PRIMARY KEY (regid)
);

INSERT INTO registrar (regid, Reg_Email, Reg_Password) VALUES
(1, 'registrar@gmail.com', '1234');

-- Department Admin
CREATE TABLE dept_admin (
  AdminID INT NOT NULL AUTO_INCREMENT,
  FirstName VARCHAR(50) NOT NULL,
  LastName VARCHAR(50) NOT NULL,
  Department VARCHAR(50) NOT NULL,
  Email VARCHAR(50) NOT NULL,
  Password VARCHAR(255) NOT NULL,
  PRIMARY KEY (AdminID)
);

-- Student
CREATE TABLE student (
  StudentID INT NOT NULL AUTO_INCREMENT,
  FirstName VARCHAR(50) NOT NULL,
  LastName VARCHAR(50) NOT NULL,
  Department VARCHAR(50) NOT NULL,
  Program VARCHAR(50) NOT NULL,
  YearSection VARCHAR(50) NOT NULL,
  Email VARCHAR(50) NOT NULL,
  Password VARCHAR(255) NOT NULL,
  AdminID INT NOT NULL,
  PRIMARY KEY (StudentID)
);

-- Teacher
CREATE TABLE teacher (
  TeacherID INT NOT NULL AUTO_INCREMENT,
  FirstName VARCHAR(50) NOT NULL,
  LastName VARCHAR(50) NOT NULL,
  Department VARCHAR(50) NOT NULL,
  Email VARCHAR(50) NOT NULL,
  Password VARCHAR(255) NOT NULL,
  AdminID INT NOT NULL,
  PRIMARY KEY (TeacherID)
);
```

### 3. Add Sample Users
```sql
-- Add Department Admin
INSERT INTO dept_admin (FirstName, LastName, Department, Email, Password) VALUES
('John', 'Admin', 'Computer Science', 'admin@cs.edu', '1234');

-- Add Teacher
INSERT INTO teacher (FirstName, LastName, Department, Email, Password, AdminID) VALUES
('Dr. Smith', 'Johnson', 'Computer Science', 'smith@cs.edu', '1234', 1);

-- Add Student
INSERT INTO student (FirstName, LastName, Department, Program, YearSection, Email, Password, AdminID) VALUES
('Jane', 'Doe', 'Computer Science', 'BS Computer Science', '3rd Year A', 'jane@student.edu', '1234', 1);
```

## Installation

### 1. Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- XAMPP/WAMP/MAMP (for local development)

### 2. Setup Steps
1. Clone or download the project to your web server directory
2. Create the database and tables using the SQL commands above
3. Update database credentials in `config/database.php` if needed
4. Ensure your web server can execute PHP files
5. Access the application through your web browser

### 3. Configuration
Edit `config/database.php` to match your database settings:
```php
private $host = 'localhost';
private $db_name = 'smartspace';
private $username = 'root';
private $password = '';
```

## Usage

### 1. Login
- Navigate to `index.php`
- Select your role from the role selector
- Enter your email and password
- Click "Login"

### 2. Default Credentials
- **Registrar**: registrar@gmail.com / 1234
- **Department Admin**: admin@cs.edu / 1234
- **Teacher**: smith@cs.edu / 1234
- **Student**: jane@student.edu / 1234

### 3. Navigation
- Each role has a customized dashboard
- Use the sidebar navigation to access different features
- Click the user menu (top-right) to access profile or logout

## File Structure

```
smartspace/
├── index.php                 # Main login page
├── logout.php               # Logout handler
├── config/
│   └── database.php         # Database configuration
├── middleware/
│   └── auth_middleware.php  # Authentication middleware
└── dashboard/
    ├── registrar.php        # Registrar dashboard
    ├── dept_admin.php       # Department admin dashboard
    ├── teacher.php          # Teacher dashboard
    └── student.php          # Student dashboard
```

## Security Features

- **Password Protection**: Role-based access control
- **Session Management**: Secure session handling
- **SQL Injection Prevention**: PDO prepared statements
- **XSS Protection**: HTML escaping for user input
- **Authentication Middleware**: Route protection

## Customization

### Adding New Roles
1. Add role to `roles` table
2. Create corresponding table for user data
3. Update `AuthMiddleware` class
4. Create dashboard file
5. Update login redirects

### Styling
- Modify CSS in each dashboard file
- Update color schemes for different roles
- Customize Bootstrap components

## Troubleshooting

### Common Issues
1. **Database Connection Error**: Check database credentials and connection
2. **Session Issues**: Ensure PHP sessions are enabled
3. **Permission Errors**: Check file permissions and web server configuration
4. **404 Errors**: Verify file paths and web server configuration

### Debug Mode
Enable error reporting in PHP for development:
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

## Future Enhancements

- Password hashing with bcrypt
- Two-factor authentication
- Email verification
- Password reset functionality
- Activity logging
- API endpoints
- Mobile responsive improvements

## License

This project is open source and available under the MIT License.

## Support

For support or questions, please refer to the documentation or create an issue in the project repository.


 Database Updates:
New login_attempts table for tracking
Automatic cleanup of old records
Indexed for optimal performance
Updated database_setup.sql included
🎯 Security Benefits:
Prevents brute force attacks
Protects against session hijacking
Automatic account lockout
Session timeout management
IP-based security tracking
Enterprise-grade protection