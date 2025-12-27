<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <style>
     body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 800px;
            backdrop-filter: blur(50px);
            margin: 0; /* Remove default body margin */
        }

        .container {
            background-color: #fff;
            position: absolute;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 600px;
            height: 900px;
            top: 5%;
            left: 30%; /* Center the container */
        }

        .header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .profile {
            text-align: center;
            padding: 20px;
            font-weight: bold;
        }

        img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-bottom: 10px;
            border: 1px solid #000;
            border-radius: 5px;
        }

        .details {
            padding: 20px;
        }

        .field {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .field label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .field p {
            margin: 0;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Student Details</h2>
    </div>
    
    <div class="profile">
        <label>Student Photo</label>
        <br><br>
        <img src="20.jpg" style="width: 100px; height: 90px;" alt="Student Photo">
       
    </div>

    <div class="details">

    <div class="field">
            <label>Name:</label>
            <p>Student</p>
        </div>

        <div class="field">
            <label>Register Number:</label>
            <p>123456</p>
        </div>

        <div class="field">
            <label>Aadhaar Number:</label>
            <p>1234-5678-9012</p>
        </div>

        <div class="field">
            <label>Date of Birth:</label>
            <p>01-Jan-2000</p>
        </div>
        <div class="field">
            <label>Class:</label>
            <p>1</p>
        </div>
        <div class="field">
            <label>Section:</label>
            <p>A</p>
        </div>

        <div class="field">
            <label>Gender:</label>
            <p>Male</p>
        </div>

        <div class="field">
            <label>Caste:</label>
            <p>General</p>
        </div>

        <div class="field">
            <label>Student Status:</label>
            <p>Promoted</p>
        </div>
    </div>
</div>

</body>
</html>
