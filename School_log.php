<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<title> School_Login page</title>
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
<h1>School Login</h1>

<form action="Connection2.php" method="post" onsubmit="return validateForm()">
<div class="input-box">
<span class="icon">
<ion-icon name="school"></ion-icon></span>
<input type="text" name="school_name" id="school_name" required>
<label>School Name</label>
</div>
<div class="input-box">
<span class="icon">
<ion-icon name="school"></ion-icon></span>
<input type="text" name="school_code" id="school_code" required>
<label>School Code</label>
</div>
<div class="input-box">
<span class="icon">
<ion-icon name="lock-closed"></ion-icon></span>
<input type="password" name="passwordInput" id="passwordInput" required>
<span></span>
<label>School Password</label></i>
</div>
<br>
<div class="input box">
<label><input type="checkbox" id="showPasswordCheckbox">Show Password</label>
<br><br>
<div class="pass" align="right">
<a href="forgot_password.php">Forgot Password?</div></a>
</div>
<input type="submit" name="submit" value="Login">
</form>
<div class="signup_link">
Not yet registered ? <a href="School_reg.php">Register</a>
</div>

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
