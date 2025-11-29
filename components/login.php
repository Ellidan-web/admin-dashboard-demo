<?php
session_start(); // Start a new or resume existing session
require 'db.php'; // Include database connection

$error = ''; // Initialize error message variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Check if form is submitted via POST
  $input = $_POST['username']; // Get user input (username or email)
  $password = $_POST['password']; // Get entered password

  // Prepare SQL statement to find user by username or email
  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
  $stmt->bind_param("ss", $input, $input); // Bind parameters to SQL query

  $stmt->execute(); // Execute the query
  $result = $stmt->get_result(); // Get the result set
  $user = $result->fetch_assoc(); // Fetch the user data

  // Verify user exists and password is correct
  if ($user && password_verify($password, $user['password'])) {
    // Set session variables
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['name'] = $user['name'];

    // Redirect to dashboard
    header("Location: dashboard.php");
    exit;
  } else {
    // Show error message if login fails
    $error = "❌ Invalid username or password.";
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login | Admin System</title>
<link rel="icon" type="image/png" href="/iGov-CC-Dashboard/assets/images/ellidan_logo.png">
  <!-- Google Font: Montserrat -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet" />
 <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <div class="login-box">
  <!-- logo centered inside the container -->
  <img src="../assets/images/ellidan_logo.png" alt="ellidan Logo" class="logo" />
    <!-- Page heading -->
    <h1>i-GOV Feedback Dashboard</h1>
    <h2>Welcome!</h2>

    <!-- PHP: Display error message if login fails -->
    <?php if (!empty($error)): ?>
      <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <!-- Login form -->
    <form action="login.php" method="POST">
      <input type="text" name="username" placeholder="Username" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>

