<?php
$pageTitle = "Settings – Manage Users";
$additionalCSS = "settings.css";
include 'includes/header.php';
include 'includes/sidebar.php';
?>

<!-- Main Content Area -->
<div class="container">
  <h1>🛠️ Add New User</h1>

  <!-- User creation form -->
  <form method="POST" action="add_user.php">
    <label for="email">Email (Gmail)</label>
    <input type="email" name="email" id="email" required>

    <label for="name">Full Name</label>
    <input type="text" name="name" id="name" required>

    <label for="role">User Role</label>
    <select name="role" id="role">
      <option value="user">User</option>
      <option value="admin">Admin</option>
      <option value="superadmin">Super Admin</option>
    </select>

    <!-- Display list of existing users via iframe -->
    <h2 style="margin-top: 50px;">👥 Active Users</h2>
    <iframe src="settings_users.php" width="100%" height="400" style="border:none;"></iframe>

    <button type="submit">Add User</button>
  </form>
</div>

<script src="/iGov-CC-Dashboard/components/js/hamburger.js" defer></script>
<script src="js/main.js"></script>
<script src="js/settings.js"></script>
</body>
</html>