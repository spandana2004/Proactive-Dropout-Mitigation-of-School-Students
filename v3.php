
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
    // Get Aadhar number and email from the form
    $aadharNumber = $_POST['adhaar'];
    $email = $_POST['email'];

    // Check if the combination exists in the database (Use prepared statements to prevent SQL injection)
    $sql = "SELECT * FROM adhaar_details WHERE Adhaar_Number = ? AND Email_Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $aadharNumber, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate and store an OTP (you can customize this part)
        $otp = generateOTP(); // Implement your OTP generation logic

        // Update the OTP in the database
        $sql = "UPDATE adhaar_details SET OTP = ? WHERE Adhaar_Number = ? AND Email_Id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $otp, $aadharNumber, $email);
        $stmt->execute();
         
        // Send the OTP to the user's email using PHPMailer
        $to = $email;
        $vcode=$otp;

        sendMail($to, $vcode);
            // Redirect to a success page after sending the OTP
    // Delay the redirection by a few seconds to ensure the alert is visible
    echo '<script>alert("OTP sent to your registered Email Id");</script>';
    // Include the OTP in the URL as a query parameter
    $redirectURL = "index4.php?adhaarNumber=" . $aadharNumber;
    echo '<meta http-equiv="refresh" content="0.01;url=' . $redirectURL . '">';
            exit();      
    
 } else {
        echo '<script>alert("Incorrect Aadhaar Number or Email Id.")
        window.location.href = "index3.php";</script>';
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
    $mail->Subject = "Aadhaar Verification code";

    // You can change the Body Message according to your requirement!
    $mail->Body = "Hello User,\n Your OTP for Aadhaar Verification is {$vcode}.\n Please ignore if not requested.";
    $mail->send();
}

?>