<?php
// This file establishes a connection to the MySQL database

// Create a new connection to the MySQL database using:
// - hostname: "localhost"
// - username: "root"
// - password: "" (empty by default for XAMPP)
// - database name: "admin_system"
$conn = new mysqli("localhost", "root", "", "admin_system");

// Check if the connection failed
if ($conn->connect_error) {
  // If there's an error, stop the script and display the error message
  die("Connection failed: " . $conn->connect_error);
}

// If this line is reached, the connection was successful
?>
