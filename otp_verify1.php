<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <style>
        body {
            background: url('S.jpeg') no-repeat;
        background-size: cover;
            text-align: center;
        }
        .container {
            margin: 100px auto;
            width: 350px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            font-size: 17px;
        }
        h2 {
            font-size: 25px;
            color: #333;
        }
        input[type="number"],input[type="text"] {
            width: 85%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="submit"] {
            width: 60%;
            padding: 13px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>OTP Verification</h2>
        <form action="verify6.php" method="post">
            <br>
            <input type="text" id="schoolCode" name="schoolCode" class="form-control" value="<?php echo isset($_GET['schoolCode']) ? $_GET['schoolCode'] : ''; ?>" readonly>
               <br>
               <input type="number" id="adhaar" name="adhaar" class="form-control" value="<?php echo isset($_GET['adhaar']) ? $_GET['adhaar'] : ''; ?>" readonly>
               <br>
               <input type="hidden" id="role" name="role" class="form-control" value="<?php echo isset($_GET['role']) ? $_GET['role'] : ''; ?>" readonly>
               <br>
            <input type="number" name="otp" placeholder="Enter OTP" required>
            <br><br>
            <input type="submit" name="submit" value="Verify">
            <br><br><br>
        </form>
    </div>
</body>
</html>
