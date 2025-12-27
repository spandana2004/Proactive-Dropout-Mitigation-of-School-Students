<?php
include('connect.php');
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input
    $schoolCode=$_POST['schoolCode'];
    $newPassword = $_POST['password'];
    $confirmPassword = $_POST['cpassword'];

    if ($newPassword === $confirmPassword) {
        // Passwords match, proceed with password reset and database update

        // Replace with the appropriate SQL query to update the password // Replace with the actual user ID
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        $updateQuery = "UPDATE school_details SET School_Password = '$hashedPassword' WHERE School_Code = '$schoolCode'";

        if ($conn->query($updateQuery) === TRUE) {
            // Password updated successfully, redirect to the next page
            echo '<script>alert("Your Password has been reset successfully")
            window.location.href = "School_log.php";</script>';
        } else {
            echo '<script>alert("Password Reset failed")
            window.location.href = "School_log.php";</script>';
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "Passwords do not match. Please try again.";
    }
}
?>
