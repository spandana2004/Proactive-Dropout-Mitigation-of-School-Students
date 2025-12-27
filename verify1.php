<?php
// Include the database connection file
include('connect.php');

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get and sanitize the school code and password
    $schoolName = mysqli_real_escape_string($conn, $_POST['school_name']);
    $schoolCode = mysqli_real_escape_string($conn, $_POST['school_code']);
    $password = mysqli_real_escape_string($conn, $_POST['passwordInput']);
    $selectRole=  mysqli_real_escape_string($conn, $_POST['role']);

    // Check if the school is registered
    $checkSchoolQuery = "SELECT School_Password, School_Name FROM school_details WHERE School_Code = '$schoolCode' AND School_Name ='$schoolName' ";
    $result = mysqli_query($conn, $checkSchoolQuery);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['School_Password'];

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, allow access or redirect to the school's dashboard
            session_start();
            $_SESSION['school_name'] = $row['School_Name'];
            $_SESSION['school_code'] = $schoolCode; // Store the school code in a session variable
    
    if ($selectRole === 'Student') {
        $redirectURL = "view1.php?schoolCode=" . $schoolCode;
        echo '<script>
        alert("Credentials Found.");
        window.location.href = "' . $redirectURL . '"; 
    </script>';
    } elseif ($selectRole === 'Teacher') {
        $redirectURL = "view2.php?schoolCode=" . $schoolCode;
        echo '<script>
        alert("Credentials Found.");
        window.location.href = "' . $redirectURL . '"; 
    </script>';
    } 
        } else {
            $redirectURL = "Inter.php?schoolCode=" . $schoolCode;
    echo '<script>
        alert("Incorrect Password.");
        window.location.href = "' . $redirectURL . '"; 
    </script>';
        }
    } else {
        // School not registered
        $redirectURL = "Inter.php?schoolCode=" . $schoolCode;
    echo '<script>
        alert("Invalid School Details.");
        window.location.href = "' . $redirectURL . '"; 
    </script>';// Redirect to login page
    }
}
?>

