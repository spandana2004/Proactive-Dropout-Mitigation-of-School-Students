<?php
include('connect.php');

if (isset($_POST['submit'])) {
    // Retrieve and sanitize user inputs
    $schoolName = mysqli_real_escape_string($conn, $_POST['school_name']);
    $schoolCode = mysqli_real_escape_string($conn, $_POST['school_code']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $school_Password = mysqli_real_escape_string($conn, $_POST['passwordInput']);
    $cschool_Password = mysqli_real_escape_string($conn, $_POST['cpasswordInput']);
    $state = mysqli_real_escape_string($conn, $_POST['inputState']);
    $district = mysqli_real_escape_string($conn, $_POST['inputDistrict']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);

    // Process image upload
    $targetDir = "uploads/";
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
        echo '<script>alert("Sorry, there was an error uploading your file.")
            window.location.href = "School_reg.php";</script>';
    } else {
        if (move_uploaded_file($_FILES["logo"]["tmp_name"], $targetFile)) {
            // Image uploaded successfully, now proceed with the database insertion

            // Hash the password
            $hash = password_hash($school_Password, PASSWORD_DEFAULT);

            // Use prepared statement to insert data
            $insertQuery = $conn->prepare("INSERT INTO school_details (School_Name, School_Code, School_Email, School_Password, State, District, Category, Image_Path) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $insertQuery->bind_param("ssssssss", $schoolName, $schoolCode, $email, $hash, $state, $district, $category, $targetFile);

            if ($insertQuery->execute()) {
                echo '<script>alert("Registered Successfully")
                window.location.href = "School_log.php";</script>';
            } else {
                echo '<script>alert("Error while registering.")
                window.location.href = "School_reg.php";</script>';
            }
        } else {
            echo '<script>alert("Sorry, there was an error uploading your file.")
            window.location.href = "School_reg.php";</script>';
        }
    }
}
?>
