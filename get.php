<?php
// get_sections.php

// Database connection details
$servername = "127.0.0.1";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "search_db"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the selected class from the AJAX request
$selectedClass = $_GET['class'];

// Construct the SQL query to retrieve sections for the selected class
$sql = "SELECT DISTINCT `Section` FROM `commn_db` WHERE `Class` = '$selectedClass'";
$result = $conn->query($sql);

// Check if there are sections available for the selected class
if ($result->num_rows > 0) {
    $sections = array();
    while ($row = $result->fetch_assoc()) {
        $sections[] = $row['Section'];
    }
    echo json_encode($sections);
} else {
    echo json_encode(array()); // Return an empty array if no sections are found
}

// Close the database connection
$conn->close();
?>
