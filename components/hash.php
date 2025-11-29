<?php
// This script generates a secure hashed version of the password "admin123".

// The password you want to hash
$plainPassword = "admin123";

// Generate a hashed version of the password using PHP's password_hash function.
// PASSWORD_DEFAULT uses the bcrypt algorithm which is secure.
$hashed = password_hash($plainPassword, PASSWORD_DEFAULT);

// Output the hashed password
echo $hashed;

// You can copy this hash and store it in your database as the user's password.
?>
