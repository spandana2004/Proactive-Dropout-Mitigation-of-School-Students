

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;600;700&display=swap" rel="stylesheet">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    body {
        font-family: "Poppins", sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        height: 100vh;
        transition: background-color 0.3s, color 0.3s;
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
        width: 260px; 
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

    .sidebar ul li {
        position: relative;
        list-style-type: none;
        height: 50px;
        width: 90%;
        margin: 0.8rem auto;
        line-height: 30px;
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

    .background-page {
        flex: 1;
        padding: 60px;
        transition: background-color 0.3s, color 0.3s;
        margin-left: 250px; /* Smooth transition for background and text color changes */
    }
    
    .view-class-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Adjust the height as needed */
}


.view-class-box {
    background-color: #F4D03F;
    /* light yellow color */
    width: 500px; /* Adjust the width as needed */
    height: 350px; /* Adjust the height as needed */
    padding: 20px;
    border-radius: 10px;
    position: relative; /* Make it a positioned container */
    display: flex;
    flex-direction: column;
    align-items: center;
}

.view-class-button {
    width: 220px;
    padding: 15px;
    background-color: #070707;
    margin-top: auto; /* Push the button to the bottom */
    border-radius: 8px;
    text-align: center;
    cursor: pointer;
    transition: background-color 0.3s;
    border: none;
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    align-self: flex-end;
}

.view-class-box p {
    text-align: center; /* Center-align the text */
    margin-bottom: 20px; /* Add margin to separate from the image and button */
}


.view-class-button:hover {
    background-color: #ddd;
}
.centered-image {
    display: block;
    margin: 0 auto; /* Center horizontally */
    margin-bottom: 20px; /* Add margin to separate the image from the button */
    max-width: 150px; /* Adjust the maximum width as needed */
    max-height: 150px; /* Adjust the maximum height as needed */
}
.view-class-button a {
    text-decoration: none; /* Remove the default underline for the link */
    color: #fff; /* Set the link color */
}
.dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 8px;
            top: 100%; /* Position below the parent */
            left: 0;
        }

        .dropdown-content a {
            color: #070707;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown.active .dropdown-content {
            display: block;
        }



</style>
<title>Principal - Attendance Dashboard - Attendance Report</title>
</head>
<body>
    <div class="sidebar">
        <ul>
            <li>
                <a href="\Project\Project\principal_dashboard1.php">
                    <i class="bx bxs-grid-alt"></i>
                    <span class="nav-item">Dashboard</span>
                </a>
            </li>
            <li>
                
                <a href="check1.php">
                    <i class="bx bx-id-card"></i>
                    <span class="nav-item">Students</span>
                </a>
                
            </li>
            <li>
                <a href="check1.php">
                    <i class="bx bx-user-check"></i>
                    <span class="nav-item">Teachers</span>
                </a>
            </li>
            <li>
                <a href="\Project\Project\principal_approval.php">
                    <i class="bx bxs-analyse"></i>
                    <span class="nav-item">Attendance Approval</span>
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

<div class="background-page">
<h2><b>View Attendance</b></h2>
    <div class="view-class-container">
        <div class="view-class-box">
            <img class="centered-image" src="vc2.png" alt="Centered Image">
            <p>Total Number of Classes: 10</p>
            
            <!-- Dropdown for View Class -->
            <div class="dropdown" id="viewClassDropdown">
            <button class="view-class-button" onclick="toggleDropdown()">View Class</button>
                <div class="dropdown-content">
                    <a href="view_all.php">View All Classes</a>
                    <a href="duse.php">Search Class and Section</a>
                </div>
            </div>
            <!-- End of Dropdown for View Class -->

        </div>
    </div>
<!-- Content of the right side background page goes here -->

<p></p>
</div>
<script>
 function goBack() {
        window.history.back();
    }
    function toggleDropdown() {
        var dropdown = document.getElementById("viewClassDropdown");
        dropdown.classList.toggle("active");
    }
    window.onclick = function(event) {
        if (!event.target.matches('.view-class-button')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('active')) {
                    openDropdown.classList.remove('active');
                }
            }
        }
    }
    </script>




</body>
</html>