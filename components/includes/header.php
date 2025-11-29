<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $pageTitle ?? 'Admin Feedback System'; ?></title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <?php if (isset($additionalCSS)): ?>
    <link rel="stylesheet" href="css/<?php echo $additionalCSS; ?>">
  <?php endif; ?>
   <link rel="icon" type="image/png" href="/iGov-CC-Dashboard/assets/images/ellidan_logo.png">
</head>
<body>