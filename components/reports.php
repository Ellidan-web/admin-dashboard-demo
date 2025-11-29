<?php
$pageTitle = "Feedback Responses Breakdown";
$additionalCSS = "reports.css";
include 'includes/header.php';
include 'includes/sidebar.php';
?>

<h1>
  <img src="../assets/images/ellidan_logo.png" alt="ellidan Logo" 
       style="height:60px; vertical-align:middle; margin-right:10px;">
  <span style="color: #005A9C;">Feedback Responses Breakdown</span>
</h1>

<!-- Sidebar placeholder for later -->
<div class="sidebar" id="sidebarMenu">
 <ul>
  <li><a href="index.html" onclick="toggleMenu()">📊 Dashboard</a></li>
  <li><a href="page1.html" onclick="toggleMenu()">📁 Reports</a></li>
  <li>
    <a href="" 
       target="_blank" 
       onclick="toggleMenu()">
      📬 Spreadsheet
    </a>
  </li>
  <li><a href="settings.html" onclick="toggleMenu()">🛠️ Settings</a></li>
  <li><a href="logout.php" onclick="toggleMenu()">🚪 Logout</a></li>
</ul>

</div>
<!--OFFICE FILTER-->
  <div class="controls">
    <label>Filter by Office:
      <select id="officeSelect">
       <option value="">-- All Offices --</option>
  <option value="Demo Office A">Demo Office A</option>
  <option value="Demo Office B">Demo Office B</option>
  <option value="Demo Office C">Demo Office C</option>
  <option value="Demo Office D">Demo Office D</option>
  <option value="Demo Office E">Demo Office E</option>
  <option value="Demo Office F">Demo Office F</option>
  <option value="Demo Office G">Demo Office G</option>
  <option value="Demo Office H">Demo Office H</option>
  <option value="Demo Office I">Demo Office I</option>
  <option value="Demo Office J">Demo Office J</option>
  <option value="Demo Office K">Demo Office K</option>
  <option value="Demo Office L">Demo Office L</option>
  <option value="Demo Office M">Demo Office M</option>
  <option value="Demo Office N">Demo Office N</option>
  <option value="Demo Office O">Demo Office O</option>
  <option value="Demo Office P">Demo Office P</option>
  <option value="Demo Office Q">Demo Office Q</option>
  <option value="Demo Office R">Demo Office R</option>
  <option value="Demo Office S">Demo Office S</option>
  <option value="Demo Office T">Demo Office T</option>
      </select>
    </label>

    <!--BUTTONS-->
    <button id="applyFilter">Apply Filter</button>
    <button id="resetFilter">Reset Filter</button>
  </div>

  <div class="overlay"></div>

<!-- Container where the filtered or processed responses will be dynamically displayed -->
<div id="responsesContainer"></div>

<script src="/iGov-CC-Dashboard/components/js/hamburger.js" defer></script>
<script src="js/main.js"></script>
<script src="js/reports.js"></script>
</body>
</html>