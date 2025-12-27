<?php
// Include the database connection file
include('connect.php');

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get and sanitize the school code and password
    $schoolName = mysqli_real_escape_string($conn, $_POST['school_name']);
    $schoolCode = mysqli_real_escape_string($conn, $_POST['school_code']);
    $password = mysqli_real_escape_string($conn, $_POST['passwordInput']);

    // Check if the school is registered
    $checkSchoolQuery = "SELECT School_Password, School_Name FROM school_details WHERE School_Code = '$schoolCode' AND School_Name ='$schoolName' ";
    $result = mysqli_query($conn, $checkSchoolQuery);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['School_Password'];

        // Verify the password 
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, allow access or redirect to the school's dashboard
            session_start();
            $_SESSION['school_name'] = $row['School_Name'];
            $redirectURL = "Inter.php?schoolCode=" . $schoolCode;
            echo '<script>
                alert("Login Successful.");
                window.location.href = "' . $redirectURL . '"; 
            </script>';
        } else {
            // Incorrect Password
            echo '<script>alert("Incorrect Password")
            window.location.href = "School_log.php";</script>'; // Redirect to login page
        }
    } else {
        // School not registered
        echo '<script>alert("School not yet registered")
        window.location.href = "School_log.php";</script>';// Redirect to login page
    }
}
?>

