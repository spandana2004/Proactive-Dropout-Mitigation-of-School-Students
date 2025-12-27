<?php
include('connect.php');

// Handle OTP submission
if (isset($_POST['submit'])) {
    $otp = $_POST['otp'];
    $schoolCode=$_POST['schoolCode'];
    $aadhaar=$_POST['adhaar'];
    $role=$_POST['role'];
    // Check OTP against the database
    if($role==='Teacher')
    {
    $query = "SELECT * FROM teacher_details WHERE  OTP = '$otp'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Verification is successful
        // Update the OTP to '0' in the database
        $sql = "UPDATE teacher_details SET OTP = '0' where School_Code='$schoolCode' AND Adhaar_Number='$aadhaar'";
        $updateResult = mysqli_query($conn, $sql);

        if ($updateResult) {
            echo '<script>alert("OTP verified.");</script>';
    $redirectURL = "reset_password1.php? schoolCode=" . $schoolCode . "&adhaar=" . $aadhaar . "&role=" . $role;
    echo '<meta http-equiv="refresh" content="0.01;url=' . $redirectURL . '">';
            exit();  
        } else {
            echo 'Error updating OTP in the database.';
        }
    } else {
        echo '<script>alert("Invalid OTP.Please try again!!")
    window.location.href = "otp_verify1.php";</script>';  
        
    }

    mysqli_close($conn);
}
else if($role==='Principal')
{
    $query = "SELECT * FROM principal_details WHERE  OTP = '$otp'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Verification is successful
        // Update the OTP to '0' in the database
        $sql = "UPDATE principal_details SET OTP = '0' where School_Code='$schoolCode' AND Adhaar_Number='$aadhaar'";
        $updateResult = mysqli_query($conn, $sql);

        if ($updateResult) {
            echo '<script>alert("OTP verified.");</script>';
    $redirectURL = "reset_password1.php? schoolCode=" . $schoolCode . "&adhaar=" . $aadhaar . "&role=" . $role;
    echo '<meta http-equiv="refresh" content="0.01;url=' . $redirectURL . '">';
            exit();  
        } else {
            echo 'Error updating OTP in the database.';
        }
    } else {
        echo '<script>alert("Invalid OTP.Please try again!!")
    window.location.href = "otp_verify1.php";</script>';  
        
    }

    mysqli_close($conn);
}
}

