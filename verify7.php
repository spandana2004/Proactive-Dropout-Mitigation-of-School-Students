<?php
include('connect.php');
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input
    $schoolCode=$_POST['schoolCode'];
    $newPassword = $_POST['password'];
    $confirmPassword = $_POST['cpassword'];
    $role=$_POST['role'];
    $aadhaar=$_POST['adhaar'];
    
    if($role==='Teacher')
    {
    if ($newPassword === $confirmPassword) {
        // Passwords match, proceed with password reset and database update

        // Replace with the appropriate SQL query to update the password // Replace with the actual user ID
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        $updateQuery = "UPDATE teacher_details SET Password = '$hashedPassword' WHERE School_Code = '$schoolCode' AND Adhaar_Number='$aadhaar' ";

        if ($conn->query($updateQuery) === TRUE) {
            // Password updated successfully, redirect to the next page
            echo '<script>alert("Your Password has been reset successfully")
            window.location.href = "Login.php";</script>';
        } else {
            echo '<script>alert("Password Reset failed")
            window.location.href = "Login.php";</script>';
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "Passwords do not match. Please try again.";
    }
}
else if($role==='Principal')
{
if ($newPassword === $confirmPassword) {
    // Passwords match, proceed with password reset and database update

    // Replace with the appropriate SQL query to update the password // Replace with the actual user ID
    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

    $updateQuery = "UPDATE principal_details SET Password = '$hashedPassword' WHERE School_Code = '$schoolCode' AND Adhaar_Number='$aadhaar' ";

    if ($conn->query($updateQuery) === TRUE) {
        // Password updated successfully, redirect to the next page
        echo '<script>alert("Your Password has been reset successfully")
        window.location.href = "Login.php";</script>';
    } else {
        echo '<script>alert("Password Reset failed")
        window.location.href = "Login.php";</script>';
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Passwords do not match. Please try again.";
}
}
}
?>
