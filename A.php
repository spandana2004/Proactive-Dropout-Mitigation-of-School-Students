
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<title> Register page</title>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<link rel="stylesheet" href="style_pr.css">
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

<h1>Principal Registration</h1>

<form  action="Inter.php" method="post" onsubmit="return validateForm()">
<div class="input-box">
<span class="icon">
<ion-icon name="person"></ion-icon></span>
<input type="text" required>
<label>Full Name</label>
</div>
<div class="input-box">
<input type="date">
</div>

<br>
Gender: 
<input type="radio" name="gender" size="15" maxlength="30" value="male">Male &nbsp &nbsp
<input type="radio" name="gender" size="15" maxlength="30" value="female">Female &nbsp &nbsp
<input type="radio" name="gender" size="15" maxlength="30" value="others">Others &nbsp &nbsp
<br>
<div class="input-box">
<span class="icon">
<ion-icon name="mail"></ion-icon></span>
<input type="email" required>
<label>Email Id</label>
</div>
<div class="input-box">
<span class="icon">
<ion-icon name="person"></ion-icon></span>
<input type="number" required>
<label>Adhaar Number</label>
</div>
<div class="input-box">
<span class="icon">
<ion-icon name="lock-closed"></ion-icon></span>
<input type="password" id="passwordInput" required>
<span></span>
<label>Password</label></i>
</div>
<div class="input box">
    <label>
        <input type="checkbox" id="showPasswordCheckbox">
        Show Password
    </label>
</div><br>
<div class="input box">
<label><input type="checkbox" id="agreeCheckbox">I agree to all <font color="blue">Terms and Conditions</font></u></label><br><br>
<input type="submit" value="Register"><br><br>
<center><div id="successMessage" style="display: none;"><font color="multicolor">
  Registered Successfully!
</font></center></div>
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



















































