<?php
include 'connect.php';
session_start();

$aadhar = $_SESSION['aadhaar'];

// Retrieve teacher's class and section based on their ID
$sql_teacher = "SELECT td.Class, td.Section, sd.School_Name
                FROM teacher_details td
                JOIN school_details sd ON td.School_Code = sd.School_Code
                WHERE td.Adhaar_Number = '$aadhar'";

$result_teacher = $conn->query($sql_teacher);

if ($result_teacher->num_rows > 0) {
    $row_teacher = $result_teacher->fetch_assoc();
    $teacher_class = $row_teacher['Class'];
    $teacher_section = $row_teacher['Section'];
    $school = $row_teacher['School_Name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datalegions - Teacher Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .user-img {
        width: 50px;
        border-radius: 100%;
        border: 1px solid #feee;
    }

    .sidebar {
        position: absolute;
        top: 0;
        left: 0;
        height: 100vh;
        width: 250px; 
        background-color: #12171e;
        padding: .7rem .9rem;
        
    }

    .sidebar #btn {
        position: relative;
        color: #feee;
        top: .10rem;
        left: 50%;
        font-size: 1.2rem;
        line-height: 5px;
        transform: translate(-50%);
        cursor: pointer;
    }

    .sidebar.active ~ .main-content {
    left: 250px;
    width: calc(100% - 250px);

}

    .sidebar .top .logo {
        color: #fff;
        display: flex;
        height: 50px;
        width: 100%;
        align-items: center;
        pointer-events: none;
    }

    .top .logo i {
        font-size: 2rem;
        margin-right: 5px;
    }

    .user {
        display: flex;
        align-items: center;
        margin: 1rem 0;
    }

    .user p {
        color: #fff;
        margin-left: 1rem;
    }

    .bold {
        font-weight: 600;
    }

    .sidebar ul li {
        position: relative;
        list-style-type: none;
        height: 50px;
        width: 90%;
        margin: 0.8rem auto;
        line-height: 50px;
    }

    .sidebar ul li a {
        color: #fff;
        display: flex;
        align-items: center;
        text-decoration: none;
        border-radius: 0.8rem;
    }

    .sidebar ul li a:hover {
        background-color: #fff;
        color: #12171e;
        font-size: large;
    }

    .sidebar ul li a i {
        min-width: 50px;
        text-align: center;
        height: 50px;
        border-radius: 12%;
        line-height: 50px;
    }
    
    .sidebar ul li:hover .tooltip {
        opacity: 1;
    }

    .main-contents{
        position: relative;
        background-color: #eee;
        min-height: 100vh;
        top: 0;
        left: 250px;
        width: calc(100% - 250px);
        padding: 1rem;
    }

</style>
<body>
<div class="sidebar">
        <div class="top">
            <div class="logo">
                <i class="bx bxl-codepen"></i>
                <span>DataLegions</span>
            </div>
        <br><br>

        </div>
        <ul>
            <li>
                <a href="teach_dash.php">
                    <i class="bx bxs-grid-alt"></i>
                    <span class="nav-item">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="view_class.php">
                    <i class="bx bxs-bank"></i>
                    <span class="nav-item">View Class</span>
                </a>
            </li>
            <li>
                <a href="Index_teach.php">
                    <i class="bx bxs-user-pin"></i>
                    <span class="nav-item">Take Attendance</span>
                    <form action="attendance_form3.php" method="post">
                    </form>
                </a>
            </li>
            <li>
                <a href="view_attendance_index.php">
                    <i class="bx bxs-analyse"></i>
                    <span class="nav-item">View Attendance</span>
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <i class="bx bx-log-out-circle"></i>
                    <span class="nav-item">Logout</span>
                </a>
            </li>
        </ul>
    </div>
    
</body>
</html>

    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        button[name="submit"] {
    background-color: #000; /* Green background color */
    color: white; /* White text color */
    padding: 10px 20px; /* Add some padding */
    font-size: 16px; /* Increase font size */
    border: none; /* Remove border */
    border-radius: 5px; /* Add a slight border radius */
    cursor: pointer; /* Add a pointer cursor on hover */
    transition: background-color 0.3s ease; /* Smooth transition on hover */
  }

  button[name="submit"]:hover {
    background-color: #aeb6bf; /* Darker green on hover */
  }
  input[type="text"][name="class"] {
        width: 80%; /* Set the width to match the date input */
        padding: 5px; /* Add some padding for better appearance */
    }
    input[type="date"][name="date"] {
        width: 80%; /* Set the width to match the date input */
        padding: 5px; /* Add some padding for better appearance */
    }
  </style>
</head>
<body>
    <header>
        <h1>Attendance Dashboard</h1>
    </header>
    <form action="attendance_form3.php" method="post" class="attendance-form">
        
        <div class="form-group">
            <label>Class:</label>
            <br>
            <input type="text" name="class" id="class" value="<?php echo"$teacher_class"?>" readonly>
            <br>
            <br>
            <label>Section:</label>
            <br>
            <input type="text" name="class" id="class" value="<?php echo"$teacher_section"?>" readonly>
            <br>
            <br>
            <label for="dateInput">Enter Date:</label>
            <br>
            <input type="date" name="date" id="dateInput" required>
        </div>
         <br>
        <button type="submit" name="submit">Take Attendance</button>
    </form>

    <footer>
        &copy; <?php echo"$school"?>
    </footer>
</body>
</html>
