<?php
    include("connect.php");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<title> Verification Page</title>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<link rel="stylesheet" href="style_cv.css">
</head>
<style>
#preloader{
background: black url(5.gif) no-repeat center center;
border-radius: 25px;
opacity: 0.7;
width: 99%;
height: 100%;
position: fixed;
z-index: 1000;
}
</style>

<body>
<div id="preloader"></div>
<div class="center">
<div class="loginbox">
<img src="2.png" class="avatar"></div>
<br>

<h1>Verification Page</h1>

<form  action="Connection.php" method="post" onsubmit="return validateForm()">
<div class="input-box">
<input type="text" name="school_name" id="school_name" required>
<label>School Name</label>
</div>
<div class="input-box">
<input type="text" name="school_code" id="school_code" required>
<label>School Code</label>
</div>
<div class="input-box">
<input type="password" name="school_id" id="school_id" required>
<label>Enter Unique Id</label>
</div>
<br>
<br>
<input type="submit" name="submit" value="Verify"><br><br><br>
</form>

<script>
var loader=document.getElementById("preloader");
setTimeout(function() {
    loader.style.display = "none";
}, 5000);
</script>
</body>
</html>



















































