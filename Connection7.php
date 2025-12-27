<?php
include('connect.php');

// Form data
if (isset($_POST['submit'])) {
    $aadhar_number = $_POST['aadhar_number'];
    $name = $_POST['name'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $email_id = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM beo_details where aadhar_number='$aadhar_number'";
    $result = mysqli_query($conn, $sql);
    $count_adh = mysqli_num_rows($result);

    if ($count_adh > 0) {
        $redirectURL = "beo_reg.php?aadhar_number=" . $aadhar_number;
        echo '<script>
                alert("BEO details already exist.");
                window.location.href = "' . $redirectURL . '"; 
            </script>';
        exit();
    }

    $targetDir = "bbeo/";
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
        $redirectURL = "beo_reg.php?aadhar_number=" . $aadhar_number;
        echo '<script>
                alert("Sorry, there was an error uploading your file..");
                window.location.href = "' . $redirectURL . '"; 
            </script>';
        exit();
    } else {
        // Move uploaded file and continue with the rest of your code
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            // SQL query to insert data into the database with the hashed password
            $sql = "INSERT INTO beo_details (aadhar_number,Name, email_id, date_of_birth, gender, password,image) VALUES ('$aadhar_number', '$name', '$date_of_birth', '$gender', '$email_id', '$hashedPassword', '$targetFile')";

            if (mysqli_query($conn, $sql)) {
                // Registration successful, you can redirect to a success page
                $redirectURL = "beo_login.php?name=" . $name;
                echo '<script>
                        alert("Registered Successfully.");
                        window.location.href = "' . $redirectURL . '"; 
                      </script>';
            } else {
                $redirectURL = "beo_reg.php?name=" . $name;
                echo '<script>
                        alert("Registration Failed.");
                        window.location.href = "' . $redirectURL . '"; 
                      </script>';
            }
        } else {
            $redirectURL = "beo_reg.php?adhaarNumber=" . $aadhar_number;
            echo '<script>
                    alert("Sorry, there was an error uploading your files..");
                    window.location.href = "' . $redirectURL . '"; 
                  </script>';
            exit();
        }
    }
}

$conn->close();
?>
