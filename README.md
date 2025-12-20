# Admin Dashboard
A web-based dashboard for monitoring citizen feedback and service delivery metrics.

## Overview
PHP-based demo showcasing an admin dashboard with sample data visualization, reporting, and interactive UI. Production handles sensitive data; demo uses anonymized datasets.

## Features
- Real-time Charts: Interactive feedback visualizations  
- Multi-role Access: Superadmin and user permissions  
- Advanced Filtering: By date and office  
- Responsive Design: Mobile-friendly interface  
- Automated Data Sync: JSON endpoint integration  

Dashboard Components: Client demographics, service metrics, Citizen’s Charter compliance, office performance, barangay-level analysis, suggestions/comments, services availed.

## Tech Stack
Frontend: HTML5, CSS3, JavaScript, Chart.js  

Backend: PHP 7.4+, MySQL, JSON demo data, appscript API (In private demo)

Security: Session-based auth, role-based access, password hashing, input validation

## Project Structure
```
ADMIN-DASHBOARD/
├── assets/images/ └── logos
├── css/ └── dashboard.css, login.css, style.css...
├── js/ └── dashboard.js, sampledata.json...
├── includes/ └── auth_check.php, header.php...
├── add_user.php
├── dashboard.php
├── db.php
├── hash.php
├── index.php
├── login.php
├── logout.php
├── reports.php
├── settings.php
├── admin_system.sql
└── README.md
```

## Installation
1. Clone repo: `git clone [repository-url]`  
2. Create database:
```
CREATE DATABASE admin_system;
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) UNIQUE NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  name VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('superadmin','user') DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
Configure includes/db.php with your DB credentials

Create admin user (run hash.php for password hash) and insert demo data

Demo data in js/sampledata.json

##  User Roles
Superadmin: Full access, user management, reports

User: Dashboard viewing, filtered reports

##  Customization
CSS variables for styling

JS for chart colors

Update office list in dashboard.php

##  Security
Session-based auth

Password hashing (bcrypt)

SQL injection prevention

Role-based access control

##  Contributing
Fork → Feature branch → Commit → Push → Pull Request

##  Support
Contact project maintainer for assistance
