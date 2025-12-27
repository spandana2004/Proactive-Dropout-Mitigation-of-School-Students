<?php
session_start(); // Start the session
unset($_SESSION['school_name']); // Clear the school name session variable
session_destroy(); // Destroy the session

// Redirect to the login page
header("Location: HomePage.php");
exit();
?>

