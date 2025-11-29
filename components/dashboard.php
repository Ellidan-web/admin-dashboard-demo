<?php
$pageTitle = "Admin Dashboard";
$additionalCSS = "dashboard.css";
include 'includes/header.php';
include 'includes/sidebar.php';
?>
<!--TITLE-->
  <h1>
 <img src="../assets/images/ellidan_logo.png" 
     alt="ellidan Logo" 
     style="height:60px; vertical-align:middle; margin-right:10px;">
  <span>Admin Dashboard</span>
</h1>


  <!--DATE AND OFFICE FILTER SELECT-->
  <div class="controls">
    <label>Start Date:
      <input type="date" id="startDate">
    </label>
    <label>End Date:
      <input type="date" id="endDate">
    </label>
    <label>Office:
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
    <button id="applyFilter">Apply Filters</button>
    <button id="resetFilter">Reset Filters</button>
    <button onClick="window.location.reload();">Refresh Data</button>
  </div>
<!--CHARTS OF ALL THE DATAS-->
  <div class="charts">
    <div class="chart-containerClient"><canvas id="chartClientType"></canvas></div>
    <div class="chart-containerSex"><canvas id="chartSex"></canvas></div>
    <div class="chart-containerAge"><canvas id="chartAge"></canvas></div><br>
    <div class="chart-container2"><canvas id="chartBarangay"></canvas></div>
    <div class="chart-containerCC1"><canvas id="chartCC1"></canvas></div>
    <div class="chart-containerCC2"><canvas id="chartCC2"></canvas></div>
    <div class="chart-containerCC3"><canvas id="chartCC3"></canvas></div>
    <div class="chart-container"><canvas id="chartSQD"></canvas></div>
    <div class="chart-containerOffice"><canvas id="chartOffice"></canvas></div>
    <div class="suggestions-box" id="suggestionsBox">
  <h2>💬 Suggestions & Comments</h2>
  <div class="scroll-container" id="suggestionScrollContainer">
    <ul id="suggestionList"></ul>
  </div>
</div>

 <div class="services-box" id="servicesBox">
  <h2>📋 Services Availed</h2>
  <div class="scroll-container" id="serviceScrollContainer">
    <ul id="serviceList"></ul>
  </div>
</div>

<script src="/iGov-CC-Dashboard/components/js/hamburger.js" defer></script>
<script src="js/main.js"></script>
<script src="js/dashboard.js"></script>
</body>
</html>