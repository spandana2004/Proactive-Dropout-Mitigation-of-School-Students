<?php
include('connect.php');

// Form data
if (isset($_POST['submit'])) {
    $aadhaar = $_POST['aadhaar'];
    $schoolCode = $_POST['schoolCode'];
    $name = $_POST['name'];
    $dateOfBirth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM principal_details where Adhaar_Number='$aadhaar'";
    $result = mysqli_query($conn, $sql);
    $count_adh = mysqli_num_rows($result);

    if ($count_adh > 0) {
        $redirectURL = "Inter.php?schoolCode=" . $schoolCode;
        echo '<script>
                alert("Principal details already exist.");
                window.location.href = "' . $redirectURL . '"; 
            </script>';
        exit();
    }

    $targetDir = "principals/";
    $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a valid image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check === false) {
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["photo"]["size"] > 500000) {
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedFormats = array("jpg", "jpeg", "png");
    if (!in_array($imageFileType, $allowedFormats)) {
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $redirectURL = "Principal_Reg.php?adhaarNumber=" . $aadharNumber;
        echo '<script>
                alert("Sorry, there was an error uploading your file..");
                window.location.href = "' . $redirectURL . '"; 
            </script>';
        exit();
    } else {
        // Move uploaded file and continue with the rest of your code
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            // SQL query to insert data into the database with the hashed password
            $sql = "INSERT INTO principal_details (Adhaar_Number, School_Code, Name, DOB, Gender, Email_Id, Password,Image) VALUES ('$aadhaar', '$schoolCode', '$name', '$dateOfBirth', '$gender', '$email', '$hashedPassword', '$targetFile')";

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
            $redirectURL = "Principal_Reg.php?adhaarNumber=" . $aadharNumber;
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
