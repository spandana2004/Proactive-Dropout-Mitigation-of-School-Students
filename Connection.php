<?php
// Include the database connection file (connect.php)
$host = 'localhost';
$dbname = 'sih';
$username = 'root';
$password = '';
$port = 3306;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $username, $password);
    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get values from the form
    $schoolName = $_POST["school_name"];
    $schoolCode = $_POST["school_code"];
    $uniqueId = $_POST["school_id"];

    // Connect to the database (you should already have a database connection in "connect.php")
    // Insert your database connection code here.

    // Check if the school name and school code exist
    $query = "SELECT * FROM school WHERE School_Name = :schoolName AND School_Code = :schoolCode";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':schoolName', $schoolName);
    $stmt->bindParam(':schoolCode', $schoolCode);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // School name and code exist
        // Now, check the unique ID
        $row = $stmt->fetch();

        if ($row["Unique_Id"] == $uniqueId) {
            // Authentication successful
            // You can redirect the user to a protected page or perform other actions here.
            echo '<script>alert("School Details found.")
            window.location.href = "School_reg.php";</script>';
        } else {
            // Incorrect unique ID
            echo '<script>alert("Incorrect Unique ID")
            window.location.href = "Verify.php";</script>';
        }
    } else {
        // School details not found
        echo '<script>alert("School Details not found!!!")
        window.location.href = "Verify.php";</script>';
    }
}
?>
