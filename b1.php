<?php
session_start();
include('connect.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datalegions - BEO Dashboard</title>
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

    .btn {
        background: #12171e;
        color: white;
        padding: 5px 10px;
        text-align: center;
    }

    .btn:hover{
        color:#12171e;
        background: white;
        padding: 3px 8px;
        border: 2px solid #12171e;

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

    .sidebar.active ~ .main-contents {
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

    .container {
        position: fixed;
        right: 0;
        width: 83.65vw;
        height: 100vh;
        background: #f1f1f1;
    
    }

    .container .header {
        position: relative;
        top: 0;
        right: 50;
        width: 83.67vw;
        height: 10vh;
        background: #f1f1f1;
        display: flex;
        align-items: left;
        justify-content: left;
    }

    .container .content .cards{
        padding: 20px 15px;
        display: flex;
        align-items: left;
        justify-content: left;
        flex-wrap: wrap;
    }

    .container .content .cards .card{
        width: 250px;
        height: 150px;
        background: white;
        margin: 20px 10px;
    }

    .container .content .cards .card .box{
        position: static;
        text-align: center;
        padding: 20px;
        border-radius: 8px;
        background: #FEAE49;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .container .content .cards .card .box h1{
        font-size: 16px;
        color: #555;
    }

    .container .content .cards .card .box h3{
        font-size: 16px;
        color: #555;
    }

    .container .content .cards .card .box i{
        font-size: 42px;
        color: #12171e;
        position: center;
        top: 50%;
        right: 10px;
        
    }

    .male-count, .female-count {
        font-size: 16px;
        color: #555;
    }
    /* Styling for the Footer */
    footer {
        background-color: #12171e;
        color: #fff;
        text-align: center;
        padding: 2px;
        position: fixed;
        bottom: 0;
        width: 100%;
    }

    .sidebar ul ul {
        position: relative;
        left: 260px;
        
        
    }    
</style>
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
                <p class="bold">Block Education Officer</p>
            </div>
        </div>
        <ul>
            <li>
                <a href="#">
                    <i class="bx bxs-grid-alt"></i>
                    <span class="nav-item">Dashboard</span>
                </a>
            </li>
            <li>
                
                <a href="schooldetails.php">
                    <i class="bx bx-id-card"></i>
                    <span class="nav-item">Schools</span>
                </a>
                
            </li>
            <li>
                <a href="#">
                    <i class="bx bx-user-check"></i>
                    <span class="nav-item">Policies</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bx bxs-analyse"></i>
                    <span class="nav-item">Attendance Report</span>
                </a>
            </li>
            <li>
                <a href="Settings.php">
                    <i class="bx bx-cog"></i>
                    <span class="nav-item">Settings</span>
                </a>
                
            </li>
            <li>
                <a href="\Project\Project\HomePage.php">
                    <i class="bx bx-log-out-circle"></i>
                    <span class="nav-item">Logout</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="container">
        <div class="header">
        <?php
    // Retrieve the entered name from the login page
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : 'Officer';
    ?>
    &nbsp; &nbsp;<h2 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Welcome, <?php echo $name; ?>!</h2>
        <div class="content">
            <div class="cards">
                <div class="card">
                    <div class="box">
                    <i class='bx bxs-school'></i>
                        <h1>Educational Instituions</h1>
                        <?php
                            // Count male students
                            $schools_query = "SELECT * from school_details";
                            $schools_query_run = mysqli_query($conn, $schools_query);

                            $schools_total = ($schools_query_run) ? mysqli_num_rows($schools_query_run) : 0;

                            if($schools_query_run)
                            {
                                echo '<h3 class="school-count">'.$schools_total.' </h3>';
                            }
                            else
                            {
                                echo '<h3> No Data </h3>';
                            }

                            
                        ?>
                        
                    </div>
                    <div class="icon-case">
                        <img src="" alt="">
                    </div>
                </div>
                    <div class="icon-case">
                        <img src="teachers.png" alt="">
                    </div>
                </div>
            </div>
            <div class="content-2">

            </div>
        </div>
    </div>
<footer>
    <p>DataLegions &copy; 2024. All Rights Reserved.</p>
</footer>
</body>
</html>
