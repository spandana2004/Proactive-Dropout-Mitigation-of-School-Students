<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<title> Login page</title>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<link rel="stylesheet" href="style1.css">
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
<img src="1.jpg" class="avatar"></div>
<br>
<h1>Login</h1>

<form action="Connection6.php" method="post" onsubmit="return validateForm()">
<div class="input-box">
<span class="icon">
<ion-icon name="person"></ion-icon></span>
<input type="number" name="aadhaar" required>
<label>Adhaar Number</label>
</div>
<div class="input-box">
<span class="icon">
<ion-icon name="school"></ion-icon></span>
<input type="text" name="schoolCode" required>
<label>School Code</label>
</div>
<div class="input-box">
<span class="icon">
<ion-icon name="lock-closed"></ion-icon></span>
<input type="password" id="passwordInput" name="password" required>
<span></span>
<label>Password</label></i>
</div>
<div class="select">
<label for="select"><b>Login As:</b></label>
<select id="select" name="choice">  
    <option value="Select">Select</option>  
    <option value="Principal">Principal</option> 
    <option value="Teacher">Teacher</option>
    </select></div><br>
<div class="input box">
<label><input type="checkbox" id="showPasswordCheckbox">Show Password</label>
<br><br>
<div class="pass" align="right">
<a href="forgot_password1.php">Forgot Password?</div></a>
</div>
<input type="submit" name="submit" value="Login">
<br>
<br>
<br>
</form>
<script>
function validateForm() {
    var selectedRole = document.getElementById("select").value;

    if (selectedRole == "select") {
        alert("Please select a valid role to Login (Administrator, Teacher, or Principal).");
        return false; 
    }
    return true; 
}
</script>

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
var loader=document.getElementById("preloader");
setTimeout(function() {
    loader.style.display = "none";
}, 5000);
</script>
</body>
</html>
