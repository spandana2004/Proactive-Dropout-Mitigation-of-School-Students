
<?php
// Include the database connection file
include('connect.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './PHPMailer-master/src/Exception.php';
require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/SMTP.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $schoolCode=$_POST['schoolCode'];

    // Validate email and check if it exists in the database
    $query = "SELECT * FROM school_details WHERE School_Email = '$email' AND School_Code='$schoolCode'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $otp = generateOTP(); // Implement your OTP generation logic
        $sql = "UPDATE school_details SET OTP = ? WHERE School_Code = ? AND School_Email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $otp, $schoolCode, $email);
        $stmt->execute();
        // Send the OTP to the user's email using PHPMailer
        $to = $email;
        $vcode=$otp;

        sendMail($to, $vcode);
            // Redirect to a success page after sending the OTP
    // Delay the redirection by a few seconds to ensure the alert is visible
    echo '<script>alert("OTP sent to your registered Email Id.");</script>';
    $redirectURL = "otp_verify.php? schoolCode=" . $schoolCode;
    echo '<meta http-equiv="refresh" content="0.01;url=' . $redirectURL . '">';
            exit();   
    
 } else {
        echo '<script>alert("Incorrect Credentials.")
        window.location.href = "forgot_password.php";</script>';
}
   
    // Close the database connection
    $stmt->close();
    $conn->close();
    
}

function generateOTP() {
    // Implement your OTP generation logic (e.g., random 6-digit number)
    return mt_rand(100000, 999999);
}

function sendMail($to, $vcode) {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Enter your email ID
    $mail->Username = "tikotikarshreyas@gmail.com";
    $mail->Password = "xpkn zvkx chue fyen";

    // Your email ID and Email Title
    $mail->setFrom("tikotikarshreyas@gmail.com", "Data Legions");

    $mail->addAddress($to);

    // You can change the subject according to your requirement!
    $mail->Subject = "Reset Password";

    // You can change the Body Message according to your requirement!
    $mail->Body = "Hello School,\n Your OTP for resetting password is {$vcode}.\n Please ignore if not requested.";
    $mail->send();
}

?>