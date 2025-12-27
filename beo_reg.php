
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<title> Register page</title>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<link rel="stylesheet" href="style_prp.css">
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

<h1>BEO Registration</h1>

<form  action="Connection7.php" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
<label><font size=3.5 color="#76D7C4">Aadhaar Number</font></label>
<div class="input-box">
    <span class="icon">
        <ion-icon name="person"></ion-icon>
    </span>
    <input type="text" id="aadhar" name="aadhar"  value="<?php echo isset($_GET['aadhar_number']) ? $_GET['aadhar_number'] : ''; ?>">
</div>
<div class="input-box">
    <span class="icon">
        <ion-icon name="person"></ion-icon>
    </span>
    <input type="text" id="name" name="name" required>
    <label>Full Name</label>
</div>
<div class="input-box">
 <font color="grey"> Date of Birth:</font><br>
<input type="date" name="date_of_birth" required>
</div>

<br>
<font color="grey">Gender: </font>
<input type="radio" name="gender" size="15" maxlength="30" value="Male" required>Male &nbsp &nbsp
<input type="radio" name="gender" size="15" maxlength="30" value="Female" required>Female &nbsp &nbsp
<input type="radio" name="gender" size="15" maxlength="30" value="Others" required>Others &nbsp &nbsp
<br><br>
<div class="input-box">
<span class="icon">
<ion-icon name="mail"></ion-icon></span>
<input type="email_id" name="email_id" required>
<label>Email Id</label>
</div>
<div class="input-box">
<span class="icon">
<ion-icon name="lock-closed"></ion-icon></span>
<input type="password" id="passwordInput" name="password" required>
<span></span>
<label>Enter Password</label></i>
</div>
<div class="input box">
    <label>
        <input type="checkbox" id="showPasswordCheckbox">
        Show Password
    </label><br><br>
    <br><label for="photo"><b>Choose Photo:</b></label>
<br><br>
<div class="img">
<input type="file" name="photo" id="photo" accept="image/*" style="cursor: pointer;" required>
</div>
<br><br>
</div>
<div class="input box">
<label><input type="checkbox" id="agreeCheckbox" required>I agree to all <font color="blue"><a href="TermsNCond.php">Terms and Conditions</a></font></u></label><br><br>
<input type="submit" name="submit" value="Register">
<br><br><br>
</form>
<script>
  function validateForm() {
    var agreeCheckbox = document.getElementById("agreeCheckbox");
    var dateOfBirth = document.querySelector('input[type="date"]').value;
    var genderInputs = document.querySelectorAll('input[name="gender"]');
    var agreeCheckbox = document.getElementById("agreeCheckbox");
    var successMessage = document.getElementById("successMessage");



    if (!dateOfBirth) {
      alert("Please specify your date of birth.");
      return false; 
    }

    var selectedGender = false;
    for (var i = 0; i < genderInputs.length; i++) {
      if (genderInputs[i].checked) {
        selectedGender = true;
        break;
      }
    }
    if (!selectedGender) {
      alert("Please select your gender.");
      return false; 
    }
        if (!agreeCheckbox.checked) {
      alert("Please agree to the Terms and Conditions to register.");
      return false; 
    }
   
    successMessage.style.display = "block";

    
    setTimeout(function() {
      window.location.href = "Inter.php";
    }, 3000); 

    return false; 
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



















































