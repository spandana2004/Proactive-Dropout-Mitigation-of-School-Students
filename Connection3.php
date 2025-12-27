<?php
include('connect.php');
// Form data
if (isset($_POST['submit'])) {
$aadhaar = $_POST['aadhaar'];
$schoolCode = $_POST['schoolCode'];
$name = $_POST['name'];
$dateOfBirth = $_POST['date_of_birth'];
$gender = $_POST['gender'];
$class = $_POST['class'];
$section = $_POST['section'];
$email = $_POST['email'];
$password = $_POST['password'];

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

if ($class > 10) {
    $redirectURL = "Staff_Reg.php?adhaarNumber=" . $aadharNumber;
    echo '<script>
        alert("Invalid Class.");
        window.location.href = "' . $redirectURL . '"; 
    </script>';
}
$sql = "SELECT * FROM teacher_details where Adhaar_Number='$aadhaar'";
    $result = mysqli_query($conn, $sql);
    $count_adh = mysqli_num_rows($result);

        if ($count_adh > 0) {
            $redirectURL = "Inter.php?schoolCode=" . $schoolCode;
            echo '<script>
                    alert("Teacher details already exist.");
                    window.location.href = "' . $redirectURL . '"; 
                </script>';
            exit();
        }

        $targetDir = "teachers/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
        // Check if image file is a valid image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            $uploadOk = 0;
        }
    
        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
            $uploadOk = 0;
        }
    
        // Allow certain file formats
        $allowedFormats = array("jpg", "jpeg", "png");
        if (!in_array($imageFileType, $allowedFormats)) {
            $uploadOk = 0;
        }
    
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $redirectURL = "Staff_Reg.php?adhaarNumber=" . $aadharNumber;
                    echo '<script>
                            alert("Sorry, there was an error uploading your file..");
                            window.location.href = "' . $redirectURL . '"; 
                        </script>';
            exit();
        }
        else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {

$sql = "INSERT INTO teacher_details (Adhaar_Number, School_Code, Name, DOB, Gender, Class, Section, Email_Id, Password,Image) VALUES ('$aadhaar', '$schoolCode', '$name', '$dateOfBirth', '$gender', '$class', '$section', '$email', '$hashedPassword', '$targetFile')";

if (mysqli_query($conn, $sql)) {
    // Registration successful, you can redirect to a success page
    $redirectURL = "Inter.php?schoolCode=" . $schoolCode;
    echo '<script>
            alert("Registered Successfully.");
            window.location.href = "' . $redirectURL . '"; 
        </script>';
} else {
    $redirectURL = "Inter.php?schoolCode=" . $schoolCode;
    echo '<script>
            alert("Registration Failed.");
            window.location.href = "' . $redirectURL . '"; 
        </script>';
}
} else {
$redirectURL = "Staff_Reg.php?adhaarNumber=" . $aadharNumber;
echo '<script>
        alert("Sorry, there was an error uploading your file..");
        window.location.href = "' . $redirectURL . '"; 
    </script>';
exit();
}
}
}

$conn->close();
?>
