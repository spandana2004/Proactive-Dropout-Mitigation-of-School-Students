<?php
include('connect.php');

// Form data
if (isset($_POST['submit'])) {
    $aadhaar = mysqli_real_escape_string($conn, $_POST['aadhaar']);
    $schoolCode = mysqli_real_escape_string($conn, $_POST['schoolCode']);
    $regno = mysqli_real_escape_string($conn, $_POST['reg_no']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $dateOfBirth = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $class = mysqli_real_escape_string($conn, $_POST['class']);
    $section = mysqli_real_escape_string($conn, $_POST['section']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $caste = mysqli_real_escape_string($conn, $_POST['caste']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $income = mysqli_real_escape_string($conn, $_POST['income']);

    // Validate class
    if ($class > 10) {
        $redirectURL = "Student_Reg.php?adhaarNumber=" . $aadhaar;
        echo '<script>
                alert("Invalid Class.");
                window.location.href = "' . $redirectURL . '"; 
            </script>';
        exit();
    }

    // Check if the student details already exist
    $sql_check = "SELECT * FROM student_details WHERE Adhaar_Number='$aadhaar'";
    $result_check = mysqli_query($conn, $sql_check);
    $count_adh = mysqli_num_rows($result_check);

    if ($count_adh > 0) {
        $redirectURL = "Inter.php?schoolCode=" . $schoolCode;
        echo '<script>
                alert("Student details already exist.");
                window.location.href = "' . $redirectURL . '"; 
            </script>';
        exit();
    }

    $targetDir = "students/";
    $targetFile = $targetDir . basename($_FILES["logo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a valid image
    $check = getimagesize($_FILES["logo"]["tmp_name"]);
    if ($check === false) {
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["logo"]["size"] > 500000) {
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedFormats = array("jpg", "jpeg", "png");
    if (!in_array($imageFileType, $allowedFormats)) {
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $redirectURL = "Student_Reg.php?adhaarNumber=" . $aadhaar;
                echo '<script>
                        alert("Sorry, there was an error uploading your file..");
                        window.location.href = "' . $redirectURL . '"; 
                    </script>';
        exit();
    } else {
        if (move_uploaded_file($_FILES["logo"]["tmp_name"], $targetFile)) {
            // SQL query to insert data into the database with the hashed password
            $sql = "INSERT INTO student_details (Adhaar_Number, School_Code, Register_Number, Name, DOB, Gender, Caste, Income, Class, Section, Email_Id, Student_Status, Image) VALUES ('$aadhaar', '$schoolCode', '$regno', '$name', '$dateOfBirth', '$gender', '$caste', '$income', '$class', '$section', '$email', '$status', '$targetFile')";

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
            $redirectURL = "Student_Reg.php?adhaarNumber=" . $aadhaar;
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
