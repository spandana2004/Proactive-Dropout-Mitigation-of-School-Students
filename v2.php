<?php
include('connect.php');

// Handle OTP submission
if (isset($_POST['submit'])) {
    $aadharNumber = $_POST['aadhar'];
    $otp = $_POST['otp'];

    // Check OTP against the database
    $query = "SELECT * FROM adhaar_details WHERE Adhaar_Number = '$aadharNumber' AND OTP = '$otp'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Verification is successful
        // Update the OTP to '0' in the database
        $sql = "UPDATE adhaar_details SET OTP = '0' WHERE Adhaar_Number = '$aadharNumber'";
        $updateResult = mysqli_query($conn, $sql);

        if ($updateResult) {
            // Include Aadhar number in the URL as a query parameter
            $redirectURL = "Staff_Reg.php?adhaarNumber=" . $aadharNumber;
            echo '<script>
                alert("OTP verified. Aadhaar Authentication Successful.");
                window.location.href = "' . $redirectURL . '"; // Redirect to staff_reg.php
            </script>';
        } else {
            echo 'Error updating OTP in the database.';
        }
    } else {
        $redirect = "index2.php?adhaarNumber=" . $aadharNumber;
        echo '<script>
        alert("Invalid OTP. Please try again.");
        window.location.href = "' . $redirect . '"; 
    </script>';
        
    }

    mysqli_close($conn);
}
