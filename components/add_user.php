<?php
// Start the session to access session variables like the logged-in user's role
session_start();

// Include the database connection (db.php should have your $conn = new mysqli(...) code)
require 'db.php';

// Only allow users with the role 'superadmin' to access this page
if ($_SESSION['role'] !== 'superadmin') {
  // If not a superadmin, stop the script and show an error
  die("Access denied");
}

// Check if the form was submitted using POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the form data: email, full name, and role from the HTML form
  $email = $_POST['email'];
  $name = $_POST['name'];
  $role = $_POST['role'];

  // Set a default password for the new user
  $defaultPassword = "default123";

  // Securely hash the password so it's not stored in plain text in the database
  $hashedPassword = password_hash($defaultPassword, PASSWORD_DEFAULT);

  // Prepare a SQL statement to insert the new user into the users table
  // Note: we use email as both 'username' and 'email' fields
  $stmt = $conn->prepare("INSERT INTO users (username, email, name, password, role) VALUES (?, ?, ?, ?, ?)");

  // Bind the form values to the SQL statement securely
  $stmt->bind_param("sssss", $email, $email, $name, $hashedPassword, $role);

  // Execute the SQL statement
  if ($stmt->execute()) {
    // If successful, redirect back to settings.php with success message
    header("Location: settings.php?success=1");
  } else {
    // If there's an error (e.g. duplicate email), show the error
    echo "Error: " . $stmt->error;
  }
}
?>
