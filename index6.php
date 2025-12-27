<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Aadhar Page</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<style type="text/css">
    body {
            
            font-family: Arial, sans-serif;
            background-color: #EAF2F8; /* Background color for the entire page */
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
    }
	.login-form {
		width: 380px;
    	margin: 50px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f8f9f9;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
        border-radius: 10px;
    }
    .login-form h3 {
        margin: 0 0 15px;
        font-family: Arial, sans-serif;
    }
    .form-control, .btn {
        min-height: 38px;
        padding: 10px 20px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
        background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 10px;
    }
    .btn:hover {
            background-color: #0056b3;
        }
        .btn-send-otp {
        width: 70%; /* You can adjust the width as per your requirements */
    }
    
</style>
</head>
<body>
<div class="login-form">
<form action="v6.php" method="post">
     <center><img src="images.png" style="width: 80px; height: 60px; border-radius: 2px"></center><br>
        <h3 class="text-center"><b> Aadhaar Authentication</b></h3>   
        <br>  
        <div class="form-group second_box">
        <input type="text" id="aadhar" name="aadhar" class="form-control" value="<?php echo isset($_GET['adhaarNumber']) ? $_GET['adhaarNumber'] : ''; ?>" readonly>

        </div>
        <br>
        <div class="form-group second_box">
        <input type="number" id="otp" name="otp" class="form-control" placeholder="Enter OTP" required>

        </div>
        <br>
        <div class="form-group second_box">
        <center><button type="submit" name="submit" class="btn btn-primary btn-send-otp">Submit OTP</button></center>
        </div>    
        </div>    
    </form>
</body>
</html>