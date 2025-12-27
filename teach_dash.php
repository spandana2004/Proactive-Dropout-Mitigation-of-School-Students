<?php
session_start();
include('connect.php');

if (!isset($_SESSION['aadhaar'])) {
    echo "Error: Aadhaar not set in session";
}

$aadhaar = $_SESSION['aadhaar'];

$result = mysqli_query($conn, "SELECT Name FROM teacher_details WHERE Adhaar_Number = '$aadhaar'");

if (!$result || mysqli_num_rows($result) === 0) {
    echo "Error fetching teacher information";
} else {
    $row = mysqli_fetch_assoc($result);
    $teacherName = $row['Name'];
    // echo "Teacher's Name: " . $teacherName;
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

<style>
    body
    {
        max-height: 100vh;
    }
    * .loading_div {
      background-image: url("./assets/images/loading-min.gif");
      background-repeat: no-repeat;
      height: 100px;
      width:  100px;
      background-size: 100px 100px;
    }
    #outer {
      padding-top: 20vh;
      width: 100%;
      text-align: center;
    }
    .grecaptcha-badge {
      display: none;
    }
    #inner {
      display: inline-block;
    }
    #preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 999999;
    background: white;
}
#loader {
    display: block;
    position: relative;
    left: 52%;
    top: 50%;
    width: 80px;
    height: 80px;
    margin: -75px 0 0 -75px;
    border-radius: 50%;
    border: 3px solid transparent;
    border-top-color: #FB792B;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
}
#loader:before {
    content: "";
    position: absolute;
    top: 5px;
    left: 5px;
    right: 5px;
    bottom: 5px;
    border-radius: 50%;
    border: 3px solid transparent;
    border-top-color: #213D77;
    -webkit-animation: spin 3s linear infinite;
    animation: spin 3s linear infinite;
}
#loader:after {
    content: "";
    position: absolute;
    top: 15px;
    left: 15px;
    right: 15px;
    bottom: 15px;
    border-radius: 50%;
    border: 3px solid transparent;
    border-top-color: #2394F2;
    -webkit-animation: spin 1.5s linear infinite;
    animation: spin 1.5s linear infinite;
}
@-webkit-keyframes spin {
    0%   {
        -webkit-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        transform: rotate(360deg);
    }
  }
  @keyframes spin {
      0%   {
          -webkit-transform: rotate(0deg);
          -ms-transform: rotate(0deg);
          transform: rotate(0deg);
      }
      100% {
          -webkit-transform: rotate(360deg);
          -ms-transform: rotate(360deg);
          transform: rotate(360deg);
      }
  } 
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
.sidebar.slide {
    transition: left 0.3s ease;
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

    .pie-chart-container {
        background-color: #f0ebeb;
        border: 1px solid #ddd;
        border-radius: 15px;
        padding: 20px;
        margin: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* New CSS for the pie chart canvas */
    *#studentPieChart {
        width: 70%;
        max-width: 300px;
        margin: 0 auto;
    } 
</style>
</head>
<body>
    <div class="sidebar">
        <div class="top">
            <div class="logo">
                <i class="bx bxl-codepen"></i>
                <span>DataLegions</span>
            </div>
        

        </div>
        <div class="user">
            <img src="2.png" alt="me" class="user-img">
            <div>
            <p class="bold"><?php echo $teacherName; ?></p>

            </div>
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
    <div class="main-contents">
        <h1>Welcome!</h1>
        <div class="pie-chart-container">
            <h2>Total Students</h2>
            <p>There are <span id="totalStudents">100</span> students in the class.</p>
            <canvas id="studentPieChart"></canvas>
        </div>
    </div>
    <div id="outer"
      <div id="inner">
        <div id="preloader">
          <div id="loader"></div>
        </div>
      </div>
    </div>
    <script>
    var loader=document.getElementById("preloader");
setTimeout(function() {
    loader.style.display = "none";
},5000);

 

    const totalStudents = 100;
    document.getElementById("totalStudents").textContent = totalStudents;

    const ctx = document.getElementById('studentPieChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Present', 'Absent'],
            datasets: [{
                data: [80, totalStudents - 80],
                backgroundColor: ['#36A2EB', '#FF6384'],
                borderWidth: 0
            }]
        },
        options: {
            cutout: '80%',
        }
    });
</script>

</body>
</html> 
<!--
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Teacher Dashboard</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            overflow-x: hidden;
        }

        .dashboard-container {
            display: flex;
        }

        .sidebar {
            width: 250px;
            height: 100%;
            background: black;
            color: #fff;
            position: fixed;
            transition: width 0.5s;
        }

        .collapsed {
            width: 60px !important;
        }

        .sidebar:hover {
            width: 250px;
        }

        .sidebar-header {
            padding: 10px;
            text-align: center;
            background: #34495e;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .menu-btn {
            font-size: 20px;
            background: none;
            border: none;
            color: #ecf0f1;
            cursor: pointer;
            padding: 10px;
        }

        .user-info {
            text-align: center;
            padding: 10px 0;
            border-bottom: 1px solid #2c3e50;
        }

        .user-info h3 {
            margin: 0;
            color: #ecf0f1;
            font-size: 14px;
        }

        .nav {
            list-style: none;
            padding: 0;
            margin: 10px 0;
        }

        .nav li {
            padding: 15px;
            text-align: center;
            border: 2px solid white;
            border-radius: 5px;
            margin: 5px;
        }

        .nav a {
            text-decoration: none;
            color: #ecf0f1;
            display: block;
            transition: background 0.3s;
        }

        .nav a:hover {
            background: #34495e;
        }

        .content {
            flex: 1;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .chart-container {
            background-color: #ecf0f1;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        #pieChart {
            max-width: 300px;
            max-height: 300px;
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                Data Legions
                <button class="menu-btn" onclick="toggleSidebar()">☰</button>
            </div>
            <div class="user-info">
                <p>Teacher Name</p>
            </div>
            <ul class="nav">
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">View Class</a></li>
                <li><a href="#">Take Attendance</a></li>
                <li><a href="#">View Attendance</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div>

        <div class="content">
            <div class="chart-container">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Placeholder data for the pie chart
        const data = {
            labels: ['Present', 'Absent'],
            datasets: [{
                data: [75, 25],
                backgroundColor: ['#36A2EB', '#FF6384'],
            }]
        };

        const config = {
            type: 'doughnut',
            data: data,
        };

        // Create the pie chart
        const ctx = document.getElementById('pieChart').getContext('2d');
        new Chart(ctx, config);

        // Toggle sidebar visibility
        const sidebar = document.getElementById('sidebar');
        document.addEventListener('DOMContentLoaded', () => {
            sidebar.style.width = '250px';
        });

        function toggleSidebar() {
            sidebar.classList.toggle('collapsed');
        }
    </script>
</body>
</html>
    -->




