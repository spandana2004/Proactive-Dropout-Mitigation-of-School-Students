<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        .slider-container {
            width: 250px;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            background-color: #000;
            color: #fff;
            padding: 20px;
            transition: background-color 0.3s;
            border-right: 2px solid #ccc;
            position: fixed;
            top: 0;
            bottom: 0;
            overflow-y: auto;
        }

        .welcome-message {
            font-size: 34px;
            color: #000;
            margin-left: 30px;
            margin-top: 40px;
        }

        .officials-text {
            font-size: 24px;
            margin-top: 40px;
            margin-bottom: 20px;
            transition: color 0.3s;
        }

        .options-slider {
            display: flex;
            flex-direction: column;
            align-items: flex-start; /* Align options to the left */
            margin-top: 20px;
        }

        .option {
            width: 100%; /* Adjusted width for better responsiveness */
            padding: 15px;
            background-color: #070707;
            margin-bottom: 15px;
            border-radius: 8px;
            text-align: left; /* Align text to the left */
            cursor: pointer;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
        }

        .option img {
            max-width: 20px;
            margin-right: 10px;
        }

        .option a {
            text-decoration: none !important;
            color: #fff !important; 
        }

        .option:hover {
            background-color: #ddd;
        }

        .logo-img {
            max-width: 100%;
            max-height: 100px;
            margin-bottom: 30px;
            margin-left: 50px;
        }

        .dark-theme .slider-container,
        .dark-theme .slider-container .options-slider,
        .dark-theme .option {
            background-color: #fff;
            color: #000;
        }

        .light-theme .slider-container,
        .light-theme .slider-container .options-slider,
        .light-theme .option {
            background-color: #000;
            color: #fff;
        }

        .background-page {
            flex: 1;
            padding: 60px;
            transition: background-color 0.3s, color 0.3s;
            margin-left: 250px;
        }
    </style>
    <title>Higher Education Officials Dashboard</title>
</head>
<body>

<?php
// Define your PHP variables or include external PHP files if needed
// For example: include 'config.php';
?>

<div class="slider-container">
    <div class="officials-text"><b>Authorities &<br> Officials</b><br>Dashboard</div>
    <img class="logo-img" src="l1.jpg" alt="Logo Image">
    <div class="options-slider">
        <div class="option"><img src="dash2.png" alt="Option Image"> Dashboard</div>
        <div class="option"><img src="att1.png" alt="Option Image"> Attendance Report</div>
        <div class="option"><img src="bar1.png" alt="Option Image"> Bar Graph Analysis</div>
        <div class="option"><img src="pie1.png" alt="Option Image"> Pie Chart Analysis</div>
        <div class="option"><img src="set1.png" alt="Option Image"><a href="setting1.html">Settings</a></div>
        <div class="option" id="darkThemeOption"><img src="dark1.png" alt="Option Image"> Dark Theme</div>
        <div class="option" id="lightThemeOption"><img src="light1.png" alt="Option Image"> Light Theme</div>
        <div class="option"><img src="log1.png" alt="Option Image"> Logout</div>
        <!-- Add more options as needed -->
    </div>
</div>

<div class="background-page">
    <!-- Content of the right side background page goes here -->
    <h2><b>Welcome!</b></h2>
    <img src="m.jpg" alt="Image 1" style="margin-right: 10px; width: 450px; height: 400px;">
<img src="j.jpg" alt="Image 2" style="float:right; width: 450px; height: 400px;"><br>
<img src="k.png" alt="Image 3" style="width: 600px; height: 400px;">

    <?php
    // Your PHP code for dynamic content goes here
    ?>
</div>

<script>
    // Your existing JavaScript code goes here
</script>

</body>
</html>
