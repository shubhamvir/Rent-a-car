🚗 Car Rental Web Application
A secure, full-featured car rental web application with role-based access control, CRUD operations, and comprehensive security measures.

**✨ Features**
**👥 User Roles
**Customers: Browse cars, make bookings, view rental history

Agencies: Manage car inventory, view bookings, update availability

**🔧 CRUD Operations
**✅ Create: User registration, car listings, bookings

✅ Read: Browse cars, view bookings, check availability

✅ Update: Edit car details, modify bookings

✅ Delete: Remove cars, cancel bookings

**🛡️ Security Implementation
**SQL Injection prevention using prepared statements

XSS protection with input sanitization

Secure session management

Password hashing with bcrypt

CSRF protection

Role-based access control

**🛠️ Technology Stack**
Component	Technology
Frontend	HTML5, CSS3, Bootstrap 5, JavaScript
Backend	PHP 7.4+
Database	MySQL 8.0+
Server	Apache HTTP Server
Security	Custom security middleware, OWASP compliance
📥 Installation
Prerequisites
Apache Web Server

PHP 7.4 or higher

MySQL 8.0 or higher

Git

Setup Steps
Clone the repository

bash
git clone https://github.com/yourusername/car-rental-system.git
cd car-rental-system
Configure Apache (on Kali Linux)

bash
sudo apt update
sudo apt install apache2 php libapache2-mod-php php-mysql mysql-server
sudo systemctl start apache2
sudo systemctl start mysql
Import Database

bash
sudo mysql -u root -p
sql
CREATE DATABASE carrental;
USE carrental;
SOURCE carrental.sql;
EXIT;
Set Permissions

bash
sudo chown -R www-data:www-data /var/www/html/car-rental-system
sudo chmod -R 755 /var/www/html/car-rental-system
Configure Database Connection
Edit db_connect.php:

php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "carrental";
Access Application
Open browser: http://localhost/car-rental-system/

**🛡️ Security Features**
Implemented Security Measures
Vulnerability	Protection Method
SQL Injection	Prepared statements with parameter binding
XSS Attacks	Input sanitization and output encoding
Session Hijacking	HTTP-only cookies, secure session config
CSRF Attacks	Token-based validation
Password Attacks	bcrypt hashing with strong password policy
Directory Traversal	Path validation and whitelisting
Security Files
security.php - Session security and headers

validation.php - Input validation functions

auth_check.php - Authentication middleware

.htaccess - Web server security rules

**📁 Project Structure**
text
car-rental-system/
assets/              # Images, icons, static files
includes/            # PHP includes and security files
security.php     # Security configuration
validation.php   # Input validation functions
auth_check.php   # Authentication middleware
pages/               # Core application pages
customer_login.php
agency_login.php
agency_dashboard.php
view_cars.php
uploads/             # File upload directory (secured)
backups/             # Database backups
lib/                 # External libraries
.htaccess            # Apache security rules
carrental.sql        # Database schema
db_connect.php       # Database configuration
index.php           # Main landing page
README.md           # This file

**🚀 Usage**
For Customers
Register an account

Login to system

Browse available cars

Select dates and book

View booking history

For Agencies
Register as agency

Login to dashboard

Add/Edit/Delete cars

View all bookings

Manage inventory

**🧪 Testing**
Security Testing
bash
# Test SQL injection
curl "http://localhost/car-rental-system/login.php" -d "username=' OR '1'='1"

# Test XSS payload
curl "http://localhost/car-rental-system/register.php" -d "name=<script>alert('xss')</script>"
Functional Testing
Registration Test: Create new customer/agency accounts

Login Test: Verify authentication works

CRUD Test: Test all Create, Read, Update, Delete operations

Access Control: Verify role-based permissions

🔧 Development
Code Standards
Use prepared statements for all database queries

Validate all user inputs

Sanitize all outputs

Follow PHP PSR standards


**👨‍💻 Author**
Shubham Virkar
GitHub: shubhamvir
Student ID: 24243981
Project: Secure Web Applications


