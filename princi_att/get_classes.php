<?php
// get_classes.php for duse.php to fetch class name

$servername = "127.0.0.1";
$username = "root"; 
$password = ""; 
$dbname = "search_db"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Construct the SQL query to retrieve distinct classes
$sql = "SELECT DISTINCT `Class` FROM `commn_db`";
$result = $conn->query($sql);

// Check if there are classes available
if ($result->num_rows > 0) {
    $classes = array();
    while ($row = $result->fetch_assoc()) {
        $classes[] = $row['Class'];
    }
    echo json_encode($classes);
} else {
    echo json_encode(array()); // Return an empty array if no classes are found
}

// Close the database connection
$conn->close();
?>
