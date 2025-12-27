<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Date</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;600;700&display=swap" rel="stylesheet">
    <style>
       body {
        font-family: "Poppins", sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        height: 100vh;
        transition: background-color 0.3s, color 0.3s;
    }
    .option a {
        text-decoration: none !important; /* Remove the default underline for links */
        color: #fff !important; 
    }

    .slider-container {
        width: 250px; /* Adjust the width of the sliding bar as needed */
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: flex-start; /* Align to the left */
        background-color: #000; /* Change background color to black */
        color: #fff;
        padding: 20px;
        transition: background-color 0.3s; /* Transition for background color changes */
        border-right: 2px solid #ccc;
        position: fixed; /* Set the position to fixed */
        top: 0; /* Stick to the top */
        bottom: 0; /* Extend to the bottom */
        overflow-y: auto; 
    }

    .welcome-message {
        font-size: 34px;
        color: #000; /* Set text color to black */
        margin-left: 30px;
        margin-top: 40px; /* Add margin to separate the message from the left edge */
    }

    .officials-text {
        font-size: 24px;
        margin-top: 40px; /* Increase margin to separate text from options and image */
        margin-bottom: 20px; 
        transition: color 0.3s;
        /* Add margin to separate text from options and image */
    }

    .options-slider {
        display: flex;
        flex-direction: column;
        align-items: center; /* Center the options horizontally */
        margin-top: 20px;
      
    }

    .option {
        width: 200px;
        padding: 15px; /* Increase padding for options */
        background-color: #070707;
        margin-bottom: 15px; /* Increase margin between options */
        border-radius: 8px;
        text-align: center;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .option:hover {
        background-color: #ddd;
    }

    .logo-img {
        max-width: 100%; /* Ensure the image doesn't exceed its container */
        max-height: 100px; /* Set a maximum height for the image */
        margin-bottom: 30px;
        margin-left: 50px; /* Increase margin between image and options */
    }
    .option img {
        max-width: 20px;
        margin-right: 10px;
    }
    .option a {
        text-decoration: none !important; /* Remove the default underline for links */
        color: #fff !important; 
    }
        .container {
            width: 80%;
            margin: 20px auto;
        }
        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
    .logo-img {
        max-width: 100%; /* Ensure the image doesn't exceed its container */
        max-height: 100px; /* Set a maximum height for the image */
        margin-bottom: 30px;
        margin-left: 50px; /* Increase margin between image and options */
    }
    .option img {
        max-width: 20px;
        margin-right: 10px;
    }
    .option a {
        text-decoration: none !important; /* Remove the default underline for links */
        color: #fff !important; 
    }

    .background-page {
        flex: 1;
        padding: 60px;
        transition: background-color 0.3s, color 0.3s;
        margin-left: 250px; /* Smooth transition for background and text color changes */
    }
    .back-button {
            width: 60px;
            padding: 15px;
            background-color: #070707;
            margin-bottom: 15px;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s;
            border: none;
            color: #fff;
        }

        .back-button:hover {
            background-color: #ddd;
        }
        .view-class-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Adjust the height as needed */
}
     form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background-color: #F4D03F;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-size: 16px;
            display: block;
            margin-bottom: 8px;
            color: #070707;
        }

        select, input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }

        button {
            background-color: #070707;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #ddd;
        }
        canvas#attendanceChart {
            max-width: calc(100% - 270px);
            margin-left: 270px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="slider-container">
    <button class="back-button" onclick="goBack()">
            <box-icon name='arrow-back' color='#fff' size='md'><img src="back1.png" alt="Option Image"></box-icon>
        </button>
        <!-- Your slider container content... -->
        <div class="officials-text"><b>Principal</b><br>View All Classes</div>
        <img class="logo-img" src="2.png" alt="Logo Image">
        <div class="options-slider">
            <div class="option"><img src="dash2.png" alt="Option Image"> Dashboard</div>
            <div class="option"><img src="att1.png" alt="Option Image"><a href="view_class.php">Attendance Report</a></div>

            <div class="option"><img src="log1.png" alt="Option Image">Logout</div>
            <!-- Add more options as needed -->
        </div>
    </div>
    <div class="container">
        <h2>Select Date</h2>
        <form action="att.php" method="GET">
            <label for="date">Select Date:</label>
            <input type="text" id="date" name="date" placeholder="Select Date" required>
            <button type="submit">Show Attendance</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#date", {
            dateFormat: "Y-m-d", // Set the date format
            maxDate: "today" // Restrict selection to today and earlier dates
        });
        function goBack() {
        window.history.back();
    }
    </script>
</body>
</html>
