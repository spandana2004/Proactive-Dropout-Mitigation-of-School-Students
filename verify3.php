<?php
include('connect.php');

// Handle OTP submission
if (isset($_POST['submit'])) {
    $otp = $_POST['otp'];
    $schoolCode=$_POST['schoolCode'];
    // Check OTP against the database
    $query = "SELECT * FROM school_details WHERE  OTP = '$otp'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Verification is successful
        // Update the OTP to '0' in the database
        $sql = "UPDATE school_details SET OTP = '0' where School_Code='$schoolCode'";
        $updateResult = mysqli_query($conn, $sql);

        if ($updateResult) {
            echo '<script>alert("OTP verified.");</script>';
    $redirectURL = "reset_password.php? schoolCode=" . $schoolCode;
    echo '<meta http-equiv="refresh" content="0.01;url=' . $redirectURL . '">';
            exit();  
        } else {
            echo 'Error updating OTP in the database.';
        }
    } else {
        echo '<script>alert("Invalid OTP.Please try again!!")
    window.location.href = "otp_verify.php";</script>';  
        
    }

    mysqli_close($conn);
}
