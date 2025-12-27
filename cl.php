<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;600;700&display=swap" rel="stylesheet">
    <style>
        /* Your existing styles here... */
        body {
        font-family: "Poppins", sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        height: 100vh;
        transition: background-color 0.3s, color 0.3s;
    }
    .sidebar-toggle {
            position: fixed;
            top: 30px;
            left: 140px;
            background: none;
            border: none;
            cursor: pointer;
            z-index: 2;
            display: flex;
            align-items: center;
        }

        .sidebar-toggle-icon {
            font-size: 24px;
            color: #fff;
            margin-right: 10px;
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
            transition: margin-left 0.3s;
            border-right: 2px solid #ccc;
            position: fixed;
            top: 0;
            bottom: 0;
            overflow-y: auto;
            margin-left: -250px;
        }

        .slider-container.opened {
            margin-left: 0;
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
    .dark-theme .slider-container {
        background-color: #fff;
        color: #000;
    }

    .dark-theme .slider-container .options-slider {
        background-color: #fff;
    }

    .dark-theme .option {
        background-color: #070707;
        color: #fff;
    }

    .dark-theme .background-page {
        background-color: #000;
        color: #fff;
    }

    .light-theme .slider-container {
        background-color: #000;
        color: #fff;
    }

    .light-theme .slider-container .options-slider {
        background-color: #000;
    }

    .light-theme .option {
        background-color: #ccc;
        color: #000;
    }

    .light-theme .background-page {
        background-color: #fff;
        color: #000;
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
        .background-page {
            flex: 1;
            padding: 60px;
            transition: background-color 0.3s, color 0.3s;
            margin-left: 250px; /* Smooth transition for background and text color changes */
        }
        #attendanceChartContainer {
            max-width: 100%; /* Ensure the container fits within the available width */
            margin-bottom: 30px;
            text-align: center;
        }
        #attendanceChart {
            max-width: 100%; /* Ensure the chart fits within the container */
            margin-bottom: 30px;
        }
        .next-button {
    position: fixed;
    top: 10px;
    right: 10px;
    width: 60px;
    padding: 15px;
    background-color: #ffffff;
    border-radius: 8px;
    text-align: center;
    cursor: pointer;
    transition: background-color 0.3s;
    border: none;
    color: #fff;
    z-index: 1;
}


        .next-button:hover {
            background-color: #ddd;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Principal - Attendance Dashboard</title>
</head>

<body>
<button class="sidebar-toggle" onclick="toggleSidebar()">
        <div class="sidebar-toggle-icon">&#x2261;</div>
        Open Sidebar
    </button>

    <div class="slider-container">
        <!-- Your slider container content... -->
        <button class="back-button" onclick="goBack()">
        <box-icon name='arrow-back' color='#fff' size='md'><img src="back1.png" alt="Option Image"></box-icon>
    </button>
        <!-- Your slider container content... -->
        <div class="officials-text"><b>Principal</b><br>Attendance Dashboard</div>
<img class="logo-img" src="2.png" alt="Logo Image">
<div class="options-slider">
    <div class="option"><img src="dash2.png" alt="Option Image"> Dashboard</div>
    <div class="option"><img src="att1.png" alt="Option Image"><a href="view_class.php">Attendance Report</a></div>
  

    <div class="option"><img src="log1.png" alt="Option Image">Logout</div>
    <!-- Add more options as needed -->
</div>
</div>
    </div>

    <div class="background-page">
        <h2><b>Attendance</b></h2>
        <button class="next-button">
        <box-icon name='arrow-back' color='#fff' size='md'><a href="cl2.php"><img src="next.png" alt="Option Image"></a></box-icon>
    </button>
        <canvas id="attendanceChart" width="400" height="200"></canvas>

        <?php
        // Database connection details
        $servername = "127.0.0.1";
        $username = "root"; // Empty username
        $password = ""; // Empty password
        $dbname = "sih";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch unique sections from the database
        $sectionsQuery = ("SELECT `Section` FROM `student_details`");
        $sectionsResult = $conn->query($sectionsQuery);

        // Process data for each section
        while ($sectionRow = $sectionsResult->fetch_assoc()) {
            $section = $sectionRow['Section'];

            echo "<br><h3>Class 1 $section</h3>";
            echo "<canvas id='attendanceChart$section' width='400' height='200'></canvas>";

            // Fetch data for the specific section
            $sql = "SELECT `Class`, `Day`, `Attendance` FROM `` WHERE `Section` = '$section'";
            $result = $conn->query($sql);

            // Process data for Chart.js
            $data = [];
            $labels = [];

            while ($row = $result->fetch_assoc()) {
                $class = "Class " . $row['Class'];
                $day = $row['Day'];
                $attendance = $row['Attendance'];

                // If the day is not already in labels array, add it
                if (!in_array($day, $labels)) {
                    $labels[] = $day;
                }

                // If the class is not already in data array, add it
                if (!isset($data[$class])) {
                    $data[$class] = [
                        'Attendance 1' => [],
                        'Attendance 0' => [],
                    ];
                }

                // Assign attendance value for the specific day and class
                $data[$class]['Attendance ' . $attendance][$day][] = 1;
            }

            // JavaScript code to create a grouped bar graph using Chart.js
            echo "<script>
                var ctx$section = document.getElementById('attendanceChart$section').getContext('2d');
                var attendanceChart$section = new Chart(ctx$section, {
                    type: 'bar',
                    data: {
                        labels: " . json_encode($labels) . ",
                        datasets: [";

            foreach ($data as $class => $attendanceData) {
                $classSection = substr($class, 6);
                echo "{
                                label: '$class - Present',
                                data: " . json_encode(array_map('count', $attendanceData['Attendance 1'])) . ",
                                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            },
                            {
                                label: '$class - Absent',
                                data: " . json_encode(array_map('count', $attendanceData['Attendance 0'])) . ",
                                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            },";
            }

            echo "]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 30,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });
            </script>";
        }

        // Close the database connection
        $conn->close();

        ?>

        <p></p>
    </div>
    <script> 
            function toggleSidebar() {
            var sliderContainer = document.querySelector('.slider-container');
            sliderContainer.classList.toggle('opened');
        }
    
    function goBack() {
        window.history.back();
    }</script>
</body>

</html>
