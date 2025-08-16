-- SmartSpace Database Setup
-- Run this script in phpMyAdmin to create the database and tables

-- Create database
CREATE DATABASE IF NOT EXISTS smartspace;
USE smartspace;

-- Drop existing tables if they exist
DROP TABLE IF EXISTS login_attempts;
DROP TABLE IF EXISTS student;
DROP TABLE IF EXISTS teacher;
DROP TABLE IF EXISTS dept_admin;
DROP TABLE IF EXISTS registrar;
DROP TABLE IF EXISTS roles;

-- Create roles table
CREATE TABLE roles (
    RoleID INT NOT NULL AUTO_INCREMENT,
    RoleName VARCHAR(50) NOT NULL,
    PRIMARY KEY (RoleID)
);

-- Insert roles
INSERT INTO roles (RoleID, RoleName) VALUES 
(1, 'Registrar'),
(2, 'Department Admin'),
(3, 'Teacher'),
(4, 'Student');

-- Create registrar table
CREATE TABLE registrar (
    regid INT NOT NULL AUTO_INCREMENT,
    Reg_Email VARCHAR(50) NOT NULL,
    Reg_Password VARCHAR(255) NOT NULL,
    PRIMARY KEY (regid)
);

-- Insert registrar data
INSERT INTO registrar (regid, Reg_Email, Reg_Password) VALUES 
(1, 'registrar@gmail.com', '1234');

-- Create department admin table
CREATE TABLE dept_admin (
    AdminID INT NOT NULL AUTO_INCREMENT,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    Department VARCHAR(50) NOT NULL,
    Email VARCHAR(50) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    PRIMARY KEY (AdminID)
);

-- Insert department admin data
INSERT INTO dept_admin (AdminID, FirstName, LastName, Department, Email, Password) VALUES 
(1, 'John', 'Admin', 'Computer Science', 'admin@cs.edu', '1234');

-- Create teacher table
CREATE TABLE teacher (
    TeacherID INT NOT NULL AUTO_INCREMENT,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    Department VARCHAR(50) NOT NULL,
    Email VARCHAR(50) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    AdminID INT NOT NULL,
    PRIMARY KEY (TeacherID),
    FOREIGN KEY (AdminID) REFERENCES dept_admin(AdminID)
);

-- Insert teacher data
INSERT INTO teacher (TeacherID, FirstName, LastName, Department, Email, Password, AdminID) VALUES 
(1, 'Jane', 'Smith', 'Computer Science', 'smith@cs.edu', '1234', 1);

-- Create student table
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
    PRIMARY KEY (StudentID),
    FOREIGN KEY (AdminID) REFERENCES dept_admin(AdminID)
);

-- Insert student data
INSERT INTO student (StudentID, FirstName, LastName, Department, Program, YearSection, Email, Password, AdminID) VALUES 
(1, 'John', 'Doe', 'Computer Science', 'BSIT', '2A', 'doe@student.edu', '1234', 1),
(2, 'Jane', 'Wilson', 'Computer Science', 'BSIT', '2A', 'jane@student.edu', '1234', 1);

-- Create login_attempts table for rate limiting
CREATE TABLE login_attempts (
    id INT NOT NULL AUTO_INCREMENT,
    ip_address VARCHAR(45) NOT NULL,
    email VARCHAR(100) NOT NULL,
    attempt_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    success TINYINT(1) DEFAULT 0,
    PRIMARY KEY (id),
    INDEX idx_ip_time (ip_address, attempt_time),
    INDEX idx_cleanup (attempt_time)
);

-- Create indexes for better performance
CREATE INDEX idx_roles_name ON roles(RoleName);
CREATE INDEX idx_registrar_email ON registrar(Reg_Email);
CREATE INDEX idx_admin_email ON dept_admin(Email);
CREATE INDEX idx_teacher_email ON teacher(Email);
CREATE INDEX idx_student_email ON student(Email);

-- Show all tables
SHOW TABLES;

-- Show table structures
DESCRIBE roles;
DESCRIBE registrar;
DESCRIBE dept_admin;
DESCRIBE teacher;
DESCRIBE student;
DESCRIBE login_attempts;
