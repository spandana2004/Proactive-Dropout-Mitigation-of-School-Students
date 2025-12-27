<?php
// Include the database connection file
include('connect.php');

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get and sanitize the school code and password
    $aadhaar = mysqli_real_escape_string($conn, $_POST['aadhaar']);
    $schoolCode = mysqli_real_escape_string($conn, $_POST['schoolCode']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $selectedRole = mysqli_real_escape_string($conn, $_POST['choice']);
 if($selectedRole==='Teacher')
 {
    $checkTeacherQuery = "SELECT Password FROM teacher_details WHERE School_Code = '$schoolCode' AND Adhaar_Number ='$aadhaar' ";
    $result = mysqli_query($conn, $checkTeacherQuery);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['Password'];

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, allow access or redirect to the school's dashboard
            session_start();
    $_SESSION['aadhaar'] = $aadhaar;
    header("Location: teach_dash.php");
                exit;
        } else {
            // Incorrect Password
            echo '<script>alert("Incorrect Password")
            window.location.href = "Login.php";</script>'; // Redirect to login page
        }
    } else {
        // School not registered
        echo '<script>alert("Incorrect Credentials")
        window.location.href = "Login.php";</script>';// Redirect to login page
    }
} 
else {
    $checkPrincipalQuery = "SELECT Password FROM principal_details WHERE School_Code = '$schoolCode' AND Adhaar_Number ='$aadhaar' ";
    $result1 = mysqli_query($conn, $checkPrincipalQuery);

    if (mysqli_num_rows($result1) == 1) {
        $row1 = mysqli_fetch_assoc($result1);
        $hashedPassword1 = $row1['Password'];

        // Verify the password
        if (password_verify($password, $hashedPassword1)) {
            // Password is correct, allow access or redirect to the school's dashboard
            session_start();
            header("Location: principal_dashboard1.php");
                exit;
        } else {
            // Incorrect Password
            echo '<script>alert("Incorrect Password")
            window.location.href = "Login.php";</script>'; // Redirect to login page
        }
    } else {
        // School not registered
        echo '<script>alert("Incorrect Credentials")
        window.location.href = "Login.php";</script>';// Redirect to login page
    }
} 
}
?>

