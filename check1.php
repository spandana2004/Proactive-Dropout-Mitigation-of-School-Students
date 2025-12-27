<?php
session_start();
include('connect.php');
 
$schoolName = $_GET['schoolName']; 
$sql = "SELECT School_Code FROM school_details WHERE School_Name = '$schoolName'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$schoolCode = $row['School_Code'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<title> School_Verify page</title>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<link rel="stylesheet" href="stylech1.css">
</head>
<style>
#preloader{
background: white url(785.gif) no-repeat center center;
width: 99%;
height: 100%;
position: fixed;
z-index: 1000;
}
</style>

<body>
        <div id="preloader">
    </div>
<div class="center">
<div class="loginbox">
<img src="2.png" class="avatar"></div>
<br>
<h1><font color="black">Verify School</font></h1>

<form action="verify1.php" method="post" onsubmit="return togglePasswordVisibility()">
<label><font size=3.5 color="#76D7C4">School Name</label></font>
<div class="input-box">
<span class="icon">
<ion-icon name="school"></ion-icon></span>
<input type="text" name="school_name" id="school_name" value="<?php echo $schoolName ?>" readonly>
</div>
<label><font size=3.5 color="#76D7C4">School Code</label></font>
<div class="input-box">
<span class="icon">
<ion-icon name="school"></ion-icon></span>
<input type="text" name="school_code" id="school_code" value="<?php echo $schoolCode ?>" readonly>
</div>
<div class="input-box">
<span class="icon">
<ion-icon name="lock-closed"></ion-icon></span>
<input type="password" name="passwordInput" id="passwordInput" required>
<span></span>
<label>School Password</label></i>
</div>
<div class="select">
<label for="select"><font color="black">View Details of:</font></label>
<select id="category" name="role" required>  
    <option value="Select">Select</option> 
    <option value="Student">Student</option> 
 <option value="Teacher">Teacher</option> 
    </select></div><br>
<div class="input box">
    <label>
        <input type="checkbox" id="showPasswordCheckbox"><font color="black">
        Show Password</font>
    </label>
</div><br><br>
<input type="submit" name="submit" value="Submit">
</form>

<script>
function togglePasswordVisibility() {
    const passwordInput = document.getElementById("passwordInput");
    const showPasswordCheckbox = document.getElementById("showPasswordCheckbox");

    if (showPasswordCheckbox.checked) {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}

const showPasswordCheckbox = document.getElementById("showPasswordCheckbox");
showPasswordCheckbox.addEventListener("click", togglePasswordVisibility);
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");

    form.addEventListener("submit", function(event) {
        const categorySelect = document.getElementById("category");
        
        if (categorySelect.value === "Select") {
            alert("Please select a valid category");
            event.preventDefault(); // Prevent the form from submitting
        }
    });
});
</script>
<script>
var loader=document.getElementById("preloader");
setTimeout(function() {
    loader.style.display = "none";
}, 5000);
</script>
</body>
</html>
