<?php
// Database connection details
$servername = "127.0.0.1";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "sih"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the selected date from the URL
$selectedDate = $_GET['date'] ?? date('Y-m-d'); // Default to today if no date is selected

// Calculate the start and end dates of the week based on the selected date
$startOfWeek = date('Y-m-d', strtotime('last Monday', strtotime($selectedDate)));
$endOfWeek = date('Y-m-d', strtotime('next Sunday', strtotime($startOfWeek)));

// Fetch attendance data for the selected week from the database
$sql = "SELECT `Class`, `Section`, `attendance_date`, `attendance_status` FROM `attendance` WHERE `attendance_date` BETWEEN '$startOfWeek' AND '$endOfWeek'";
$result = $conn->query($sql);

// Initialize arrays to store attendance data for each day of the week
$attendanceData = [
    'Monday' => ['present' => 0, 'absent' => 0],
    'Tuesday' => ['present' => 0, 'absent' => 0],
    'Wednesday' => ['present' => 0, 'absent' => 0],
    'Thursday' => ['present' => 0, 'absent' => 0],
    'Friday' => ['present' => 0, 'absent' => 0],
    'Saturday' => ['present' => 0, 'absent' => 0],
    'Sunday' => ['present' => 0, 'absent' => 0]
];

$class = "";
$section = "";

// Process attendance data and count the number of present and absent entries for each day
while ($row = $result->fetch_assoc()) {
    $dayOfWeek = date('l', strtotime($row['attendance_date']));
    $attendanceStatus = $row['attendance_status'];

    if ($attendanceStatus == 1) {
        $attendanceData[$dayOfWeek]['present']++;
    } else {
        $attendanceData[$dayOfWeek]['absent']++;
    }

    // Store class and section information
    $class = $row['Class'];
    $section = $row['Section'];
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    z-index: 1; /* Ensure the slider is on top of other content */
}

.background-page {
    flex: 1;
    padding: 60px;
    transition: background-color 0.3s, color 0.3s;
    margin-left: 270px; /* Adjusted to accommodate the slider */
    overflow-y: auto; /* Enable scrolling if content exceeds viewport height */
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
        canvas {
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
        <div class="officials-text"><b>Authorities and Officials</b><br></div>
        <img class="logo-img" src="2.png" alt="Logo Image">
        <div class="options-slider">
            <div class="option"><img src="dash2.png" alt="Option Image"> Dashboard</div>
            <div class="option"><img src="att1.png" alt="Option Image"><a href="view_class.php">Attendance Report</a></div>

            <div class="option"><img src="log1.png" alt="Option Image">Logout</div>
            <!-- Add more options as needed -->
        </div>
    </div>
    <div class="background-page">
        <h2>Attendance Report for Week <?php echo date('Y-m-d', strtotime($startOfWeek)) . ' to ' . date('Y-m-d', strtotime($endOfWeek)); ?></h2>
        <p><b>Class: <?php echo isset($class) ? $class : "N/A"; ?>   Section: <?php echo isset($section) ? $section : "N/A"; ?></b></p>
        <canvas id="attendanceChart" width="800" height="400"></canvas>
    </div>
    <script>
        var ctx = document.getElementById('attendanceChart').getContext('2d');
        var attendanceChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                datasets: [{
                    label: 'Present',
                    data: [<?php echo $attendanceData['Monday']['present'] . ',' . $attendanceData['Tuesday']['present'] . ',' . $attendanceData['Wednesday']['present'] . ',' . $attendanceData['Thursday']['present'] . ',' . $attendanceData['Friday']['present'] . ',' . $attendanceData['Saturday']['present']; ?>, 0],
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }, {
                    label: 'Absent',
                    data: [<?php echo $attendanceData['Monday']['absent'] . ',' . $attendanceData['Tuesday']['absent'] . ',' . $attendanceData['Wednesday']['absent'] . ',' . $attendanceData['Thursday']['absent'] . ',' . $attendanceData['Friday']['absent'] . ',' . $attendanceData['Saturday']['absent']; ?>, 0],
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }
            }
        });
        function goBack() {
        window.history.back();
    }
    </script>
</body>
</html>
