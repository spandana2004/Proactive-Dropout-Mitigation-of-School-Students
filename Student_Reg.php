
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<title> Register page</title>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<link rel="stylesheet" href="style_std1.css">
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

<h1>Student Registration</h1>

<form  action="Connection5.php" method="post" onsubmit="return validateForm() " enctype="multipart/form-data">
<label><font size=3.5 color="#76D7C4">Aadhaar Number</font></label>
<div class="input-box">
<span class="icon">
<ion-icon name="person"></ion-icon></span>
<input type="number" name="aadhaar"  value="<?php echo isset($_GET['adhaarNumber']) ? $_GET['adhaarNumber'] : ''; ?>" readonly>
</div>
<div class="input-box">
<span class="icon">
<ion-icon name="school"></ion-icon></span>
<input type="text" name="schoolCode" required>
<label>School Code</label>
</div>
<div class="input-box">
<span class="icon">
<ion-icon name="person"></ion-icon></span>
<input type="text" name="reg_no" required>
<label>Register Number</label>
</div>
<div class="input-box">
<span class="icon">
<ion-icon name="person"></ion-icon></span>
<input type="text" name="name" required>
<label>Full Name</label>
</div>
<div class="input-box">
<input type="date" name="date_of_birth" required>
</div>
<br>
Gender: 
<input type="radio" name="gender" size="15" maxlength="30" value="Male" required>Male &nbsp &nbsp
<input type="radio" name="gender" size="15" maxlength="30" value="Female" required>Female &nbsp &nbsp
<input type="radio" name="gender" size="15" maxlength="30" value="Others" required>Others &nbsp &nbsp
<br><br>
<div class="select">
<label for="select">Caste:</label>
<select id="caste"  name="caste" required>  
    <option value="Select">Select</option> 
    <option value="General">General</option> 
 <option value="OBC">OBC</option> 
    <option value="SC">Schedule Caste</option>
    <option value="ST">Schedule Tribe</option>
    </select></div>
    <div class="input-box">
<input type="number" name="income" required>
<label>Enter Parent's Annual Income</label>
</div>
<div class="input-box">
<input type="text" name="class" required>
<label>Class</label>
</div>
<div class="input-box">
<input type="text" name="section" required>
<label>Section</label>
</div>
<div class="input-box">
<span class="icon">
<ion-icon name="mail"></ion-icon></span>
<input type="email" name="email" required>
<label>Email Id</label>
</div>
<label><font size=3.5 color="#76D7C4">Student Status</font></label>
<div class="input-box">
<span class="icon">
<ion-icon name="person"></ion-icon></span>
<input type="text" name="status" value="Promoted" readonly>
</div>
<br><label for="logo"><b>Choose Photo:</b></label>
<br><br>
<div class="img">
<input type="file" name="logo" id="logo" accept="image/*" style="cursor: pointer;" required>
</div>
<br>
<div class="input box">
<label><input type="checkbox" id="agreeCheckbox" required>I agree to all <font color="blue"><a href="Terms_Cond.php">Terms and Conditions</a></font></u></label><br><br><br>
<input type="submit" name="submit" value="Register"><br><br>
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
document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");

    form.addEventListener("submit", function(event) {
        const categorySelect = document.getElementById("caste");
        const classInput = document.getElementsByName("class")[0];
        const sectionInput = document.getElementsByName("section")[0];
        
        if (categorySelect.value === "Select") {
            alert("Please select a valid caste");
            event.preventDefault(); // Prevent the form from submitting
        }
        
        // Validate Class
        const classValue = parseInt(classInput.value);
        if (classValue <= 0 || classValue > 10) {
            alert("Invalid Class");
            event.preventDefault(); // Prevent the form from submitting
        }

        // Validate Section
        const validSections = ['A','B','C','D','E','F','G','H','I','J']; // Add more valid sections if needed
        if (!validSections.includes(sectionInput.value.toUpperCase())) {
            alert("Please select a valid section (e.g., 'A-J')");
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



















































