<!-- Approach1... -->
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

        input {
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
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Principal - Attendance Dashboard</title>
</head>

<body>

    <div class="slider-container">
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

    <div class="background-page">
        <h2><b>Attendance</b></h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="class"><h4>Class:</h4></label>
        <input type="text" id="class" name="class" placeholder="Enter class">

        <label for="section"><h4>Section:</h4></label>
        <input type="text" id="section" name="section" placeholder="Enter section">

        <button type="submit">Search</button>
    </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Process the form submission
            $selectedClass = $_POST["class"];
            $selectedSection = $_POST["section"];

            // Database connection details
            $servername = "127.0.0.1";
            $username = "root"; // Empty username
            $password = ""; // Empty password
            $dbname = "search_db";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Construct the SQL query based on user input
            $sql = "SELECT `Class`, `Day`, `Attendance` FROM `commn_db` WHERE `Class` = '$selectedClass' AND `Section` = '$selectedSection'";
            $result = $conn->query($sql);
                // Check if the result set is empty (no data found)
                if ($result->num_rows === 0) {
                    echo "<h2 style='color: red;'>No data found for Class $selectedClass $selectedSection.</h2>";

                } else {
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
        
                    // Display the attendance chart
                    echo "<h3>Class $selectedClass $selectedSection</h3>";
                    echo "<canvas id='attendanceChart' width='400' height='200'></canvas>";
        
                    echo "<script>
                            var ctx = document.getElementById('attendanceChart').getContext('2d');
                            var attendanceChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: " . json_encode($labels) . ",
                                    datasets: [";
        
                    foreach ($data as $class => $attendanceData) {
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
            }
            ?>
        </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

</body>

</html>
