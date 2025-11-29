<!-- Hamburger Menu -->
<div class="hamburger-container">
  <div class="hamburger" onclick="toggleMenu()">☰</div>
</div>

<!-- Sidebar -->
<div class="sidebar" id="sidebarMenu">
  <ul>
    <li><a href="dashboard.php" onclick="toggleMenu()">📊 Dashboard</a></li>
    <li><a href="reports.php" onclick="toggleMenu()">📁 Reports</a></li>
    <li>
      <a href="https://docs.google.com/spreadsheets/d/1QY3Vz9px-U8YVR" 
         target="_blank" 
         onclick="toggleMenu()">
        📬 Spreadsheet
      </a>
    </li>
    <li><a href="settings.php" onclick="toggleMenu()">🛠️ Settings</a></li>
    <li><a href="logout.php" onclick="toggleMenu()">🚪 Logout</a></li>
  </ul>
</div>

<!-- Overlay -->
<div class="overlay" id="overlay" onclick="toggleMenu()"></div>