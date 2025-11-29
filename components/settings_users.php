<?php
session_start();

// Check if user is logged in and has 'superadmin' role
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'superadmin') {
  die("Access denied"); // Deny access if not authorized
}

require 'db.php'; // Include database connection

// Handle user deletion if a 'delete' parameter is present in the URL
if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']); // Sanitize input to an integer
  $stmt = $conn->prepare("DELETE FROM users WHERE id = ?"); // Prepare delete query
  $stmt->bind_param("i", $id); // Bind ID parameter
  $stmt->execute(); // Execute the delete operation
  header("Location: settings_users.php"); // Redirect to refresh user list
  exit;
}

// Fetch all users sorted by role in descending order
$result = $conn->query("SELECT id, name, email, role FROM users ORDER BY role DESC");
?>

<!-- Styling for the user table -->
<style>
  body {
    font-family: 'Montserrat', sans-serif;
    padding: 0 1rem;
    background: #fff;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    border-radius: 8px;
    overflow: hidden;
    margin-top: 20px;
  }
  th, td {
    padding: 12px 16px;
    border-bottom: 1px solid #eee;
    text-align: center;
  }
  th {
    background-color: #005A9C;
    color: white;
    font-weight: 600;
  }
  tr:hover {
    background-color: #f9f9f9;
  }
  .remove-btn {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    text-decoration: none;
  }
  .remove-btn:hover {
    background-color: #c82333;
  }
</style>

<!-- Table displaying user accounts -->
<table>
  <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Role</th>
    <th>Action</th>
  </tr>

  <!-- Loop through each user and display their information -->
  <?php while($row = $result->fetch_assoc()): ?>
  <tr>
    <!-- Escape HTML to prevent XSS -->
    <td><?= htmlspecialchars($row['name']) ?></td>
    <td><?= htmlspecialchars($row['email']) ?></td>
    <td><?= htmlspecialchars($row['role']) ?></td>
    <td>
      <?php if ($_SESSION['username'] !== $row['email']): ?>
        <!-- Show remove button only if not the current user -->
        <a href="settings_users.php?delete=<?= $row['id'] ?>" class="remove-btn" onclick="return confirm('Are you sure you want to remove this user?')">Remove</a>
      <?php else: ?>
        <!-- Indicate the logged-in user -->
        <em>Current</em>
      <?php endif; ?>
    </td>
  </tr>
  <?php endwhile; ?>
</table>
