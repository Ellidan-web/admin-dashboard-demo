# i-GOV Admin Dashboard
A comprehensive web-based dashboard system for monitoring and analyzing citizen feedback and service delivery metrics for the Naga City local government.

---

## 📋 Project Overview
A PHP-based demonstration of a citizen feedback analytics platform. This demo showcases a working admin dashboard with sample data visualization, reporting features, and an interactive UI for tracking service metrics. The production version handles sensitive government data; this preview includes anonymized sample datasets for portfolio purposes.

---

## 🚀 Features

### Core Functionality
- **Real-time Data Visualization** – Interactive charts and graphs displaying feedback metrics.  
- **Multi-role Access Control** – Superadmin and regular user roles with appropriate permissions.  
- **Advanced Filtering** – Filter data by date range and specific government offices.  
- **Responsive Design** – Mobile-friendly interface with hamburger navigation.  
- **Automated Data Sync** – Direct integration with a JSON endpoint for demo purposes.  

### Dashboard Components
- **Client Demographics** – Age, sex, and client type distributions.  
- **Service Metrics** – SQD (Service Quality Dimensions) ratings across 9 categories.  
- **Citizen's Charter Awareness** – CC1, CC2, and CC3 compliance metrics.  
- **Office Performance** – Service delivery metrics by department.  
- **Geographical Analysis** – Barangay-level service utilization.  
- **Suggestions & Comments** – Real-time citizen feedback display.  
- **Services Availed** – Automated scrolling service list.

---

## 🛠️ Technology Stack

### Frontend
- **HTML5** – Semantic markup structure.  
- **CSS3** – Custom variables and responsive design.  
- **JavaScript** – Dynamic chart rendering and interactivity.  
- **Chart.js** – Data visualization library.

### Backend
- **PHP 7.4+** – Server-side processing and authentication.  
- **MySQL** – User management and session storage.  
- **JSON Demo Data** – Stored in `js/sampledata.json` for public demo.

### Security
- **Session-based Authentication** – Secure user login system.  
- **Role-based Access Control** – Permission levels for different user types.  
- **Password Hashing** – Secure credential storage using PHP `password_hash`.

---

## 📁 Project Structure
```
IGOV-CC-DASHBOARD/
├── assets/
│   └── images/
│       ├── elildan_logo.png
│       ├── lgu_logo.png
│       └── logo.png
├── css/
│   ├── dashboard.css
│   ├── login.css
│   ├── reports.css
│   ├── settings.css
│   └── style.css
├── js/
│   ├── dashboard.js
│   ├── hamburger.js
│   ├── main.js
│   ├── reports.js
│   ├── sampledata.json
│   └── settings.js
├── includes/
│   ├── auth_check.php
│   ├── header.php
│   └── sidebar.php
├── add_user.php
├── dashboard.php
├── db.php
├── hash.php
├── index.php
├── login.php
├── logout.php
├── reports.php
├── settings.php
├── settings_users.php
├── admin_system.sql
└── README.md
```

yaml
Copy code

---

## 🚀 Installation & Setup

### Prerequisites
- Web server (Apache/Nginx)  
- PHP 7.4 or higher  
- MySQL 5.7 or higher  
- Modern web browser  

### Installation Steps
1. Clone the repository:
```bash
git clone [repository-url]
Database Setup:

sql
Copy code
CREATE DATABASE igov_system;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) UNIQUE NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  name VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('superadmin', 'user') DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
Configure database credentials in includes/db.php:

php
Copy code
$conn = new mysqli("localhost", "your_username", "your_password", "igov_system");
Create Admin User for Demo:
Run hash.php to generate a password hash for the demo credentials:

Username / Email: admin@dummy.com

Password: admin123

Insert into the database:

sql
Copy code
INSERT INTO users (username, email, name, password, role) 
VALUES ('admin@dummy.com', 'admin@dummy.com', 'Demo Admin', 'hashed_password_here', 'superadmin');
Sample Data:
Demo data for the dashboard is provided in js/sampledata.json. No live Google Sheets integration is needed for the demo.

👥 User Roles
Superadmin: Full system access, user management, reporting, and system configuration.

Regular User: Dashboard viewing, basic reporting, and filtered data access.

🎨 Customization
Styling: Modify CSS variables in :root and update color schemes in respective CSS files.

Charts: Customize chart colors in JavaScript files.

Office List: Update the office dropdown in dashboard.php to reflect your organization.

🔒 Security Features
Session-based authentication

Password hashing with bcrypt

SQL injection prevention using prepared statements

Role-based access control

Input validation and sanitization

🤝 Contributing
Fork the repository

Create a feature branch

Commit your changes

Push to the branch

Create a Pull Request

📄 License
This project is developed for the Naga City Local Government Unit.

🆘 Support
For technical support or questions: Contact Me
