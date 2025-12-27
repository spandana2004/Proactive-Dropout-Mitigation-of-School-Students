<?php
session_start();
include('connect.php');

if (isset($_SESSION['school_name'])) {
    $schoolName = $_SESSION['school_name'];
} else {
    $schoolName = "ABC School"; // Default school name
}

$schoolCode = $_GET['schoolCode']; // Assuming schoolCode is passed in the URL
$sql = "SELECT Image_Path FROM school_details WHERE School_Code = '$schoolCode'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <title>Intermediate Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url('S.jpeg') no-repeat;
            background-size: cover;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 90%;
            padding: 10px 100px;
            opacity: 0.6;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 200;
        }

        #preloader {
            background: white url(2.gif) no-repeat center center;
            width: 100%;
            height: 100%;
            position: fixed;
            z-index: 1000;
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            padding-top: 20px;
            text-align: center;
            border-radius: 10px;
        }

        .sidebar a {
            padding: 15px 0;
            text-decoration: none;
            font-size: 18px;
            color: #818181;
            display: block;
            transition: 0.3s;
            border: 2px solid transparent;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        .sidebar a:hover {
            color: #f1f1f1;
            border-color: #f1f1f1;
        }

        .avatar-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        .avatar {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .admin-text {
            color: white;
            font-size: 16px;
        }

        .divider {
            border-top: 1px solid #818181;
            margin: 10px 0;
        }

        .content {
            margin-left: 250px;
            padding: 16px;
            display: flex;
        }

        .teacher-details-box,
.student-details-box {
    border: 2px solid white;
    border-radius: 10px;
    padding: 20px;
    width: 300px;
    margin: 20px;
    background: rgba(255, 255, 255, 0.8);
    box-sizing: border-box;
    text-align: center;
    background: #D5F5E3;
}
.student-details-box {
    margin-left: 100px; /* Adjust this value as needed for the desired gap */
}

.teacher-details-box {
    margin-left: 200px; /* Adjust this value as needed for the desired gap */
}

        .dividers {
            border-top: 12px solid grey;
            width: 50%;
            margin: 0.25px auto;
            border-radius: 10px;
        }

        .count-box {
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 500px;
            margin: 10px auto;
        }

        .count-box p {
            flex: 1;
            text-align: center;
            margin: 0;
        }

        .count-box-outline {
    border-radius: 7px;
    padding: 10px; /* Increased padding for a larger box */
    margin: 5px;
    display: flex;
    justify-content: space-around;
    width: 100%; /* Equal width for both boxes */
}

.male-count-box,
.female-count-box {
    flex: 1; /* Equal width for both boxes */
}


        .male-count-box {
            background-color: #87CEEB; /* Light Sky Blue */
        }

        .female-count-box {
            background-color: #FFB6C1; /* Light Pink */
        }
        img[src="16.png"] {
  position: relative; /* or "absolute" based on your layout needs */
  width: 140px;
  height: 100px;
  border-radius: 15px;
  margin-left: 300px;
  top: 30px; /* Adjust the value according to your needs */
  opacity: 0.8;
}

    </style>
</head>
<body>
    <div id="preloader"></div>
    <div class="sidebar">
        <div class="avatar-container">
            <img src="2.png" class="avatar">
            <div class="admin-text"><font size=4>Admin</font></div>
        </div>
        <div class="divider"></div>
        <br><br>
        <br>
        <a href="index3.php">Principal Register</a>
        <br>
        <a href="index.php">Teacher Register</a>
        <br>
        <a href="index5.php">Student Register</a>
        <br>
        <a href="check1.php?schoolName=<?php echo urlencode($schoolName); ?>">View Reg. Details</a>

        <br>
        <a href="Logout.php">Logout</a>
    </div>
     <img A src="16.png" style="width: 140px; height: 110px; border-radius: 7px">
     <?php
    if (!empty($row["Image_Path"])) {
       echo '<img src="' . $row["Image_Path"] . '" alt="School Logo" align="right" style="width: 140px; position: relative; height: 110px; border-radius: 7px; margin-right: 150px;
       top: 30px; /* Adjust the value according to your needs */
       opacity: 0.8; ">';
    } else {
    }
    ?>
    <center>
           <center> <p> <font size=20 color='white' style="margin-left: 180px;">
                Welcome</font><br><font color="blue" size=20 style="margin-left: 180px;"> <?php echo $schoolName; ?>
            </font></p></center>
    </center>
    
    <div class="content">
        <header>
            <nav class="nav">
                <!-- Your existing navigation buttons go here -->
            </nav>
        </header>
    <br>

            <?php
            // Query to get total students
            include('connect.php');
            $schoolCode = $_GET['schoolCode'];
            $totalStudentsQuery = "SELECT COUNT(*) as total FROM student_details WHERE School_Code = '$schoolCode'";

            // Query to get total male students
            $maleStudentsQuery = "SELECT COUNT(*) as maleCount FROM student_details WHERE School_Code = '$schoolCode' AND Gender = 'Male'";

            // Query to get total female students
            $femaleStudentsQuery = "SELECT COUNT(*) as femaleCount FROM student_details WHERE School_Code = '$schoolCode' AND Gender = 'Female'";

            $totalTeacherQuery = "SELECT COUNT(*) as total FROM teacher_details WHERE School_Code = '$schoolCode'";

            // Query to get total male students
            $maleTeacherQuery = "SELECT COUNT(*) as maleCount FROM teacher_details WHERE School_Code = '$schoolCode' AND Gender = 'Male'";

            // Query to get total female students
            $femaleTeacherQuery = "SELECT COUNT(*) as femaleCount FROM teacher_details WHERE School_Code = '$schoolCode' AND Gender = 'Female'";

            // Execute queries
            $totalStudentsResult = mysqli_query($conn, $totalStudentsQuery);
            $maleStudentsResult = mysqli_query($conn, $maleStudentsQuery);
            $femaleStudentsResult = mysqli_query($conn, $femaleStudentsQuery);

            $totalTeacherResult = mysqli_query($conn, $totalTeacherQuery);
            $maleTeacherResult = mysqli_query($conn, $maleTeacherQuery);
            $femaleTeacherResult = mysqli_query($conn, $femaleTeacherQuery);

            // Fetch results
            $totalStudents = mysqli_fetch_assoc($totalStudentsResult)['total'];
            $maleCount = mysqli_fetch_assoc($maleStudentsResult)['maleCount'];
            $femaleCount = mysqli_fetch_assoc($femaleStudentsResult)['femaleCount'];
            
            $totalTeachers = mysqli_fetch_assoc($totalTeacherResult)['total'];
            $maleCount1 = mysqli_fetch_assoc($maleTeacherResult)['maleCount'];
            $femaleCount1 = mysqli_fetch_assoc($femaleTeacherResult)['femaleCount'];

            ?>
            <div class="teacher-details-box">
                <img src="m.png" alt="Student Image" style="width: 100px; height: 90px; margin-bottom: 10px; margin-top: -10px;">
                <p><strong style="font-size: 20px;">Number of <br><font color="orange" size=6>Teachers</font>:</strong></p>
                <div class="dividers"></div>
                <p style="font-size: 24px; font-weight: bold;"><?php echo $totalTeachers; ?></p>

                <!-- Divider -->
                <div class="divider"></div>

                <!-- Male and Female count boxes -->
                <div class="count-box">
                    <div class="count-box-outline male-count-box">
                        <p><strong> Male:</strong>&nbsp;&nbsp;<?php echo $maleCount1; ?></p>
                    </div>
                    &nbsp;&nbsp;
                    <div class="count-box-outline female-count-box">
                        <p><strong> Female:</strong>&nbsp;&nbsp;<?php echo $femaleCount1; ?></p>
                    </div>
                </div>
            </div>


            <div class="student-details-box">
                <img src="L.png" alt="Student Image" style="width: 93px; height: 90px; margin-bottom: 10px; margin-top: -10px;">
                <p><strong style="font-size: 20px;">Number of <br><font color="coral" size=6>Students</font>:</strong></p>
                <div class="dividers"></div>
                <p style="font-size: 24px; font-weight: bold;"><?php echo $totalStudents; ?></p>

                <!-- Divider -->
                <div class="divider"></div>

                <!-- Male and Female count boxes -->
                <div class="count-box">
                    <div class="count-box-outline male-count-box">
                        <p><strong> Male:</strong>&nbsp;&nbsp;<?php echo $maleCount; ?></p>
                    </div>
                    &nbsp;&nbsp;
                    <div class="count-box-outline female-count-box">
                        <p><strong> Female:</strong>&nbsp;&nbsp;<?php echo $femaleCount; ?></p>
                    </div>
                </div>
            </div>

        <script>
            var loader = document.getElementById("preloader");
            setTimeout(function () {
                loader.style.display = "none";
            }, 5000);
        </script>
    </body>
</html>



