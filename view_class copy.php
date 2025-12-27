
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

<div class="slider-container">
<button class="back-button" onclick="goBack()">
        <box-icon name='arrow-back' color='#fff' size='md'><img src="back1.png" alt="Option Image"></box-icon>
    </button>
<div class="officials-text"><b>Principal</b><br>Attendance Report</div>
<img class="logo-img" src="2.png" alt="Logo Image">
<div class="options-slider">
    <div class="option"><img src="dash2.png" alt="Option Image"> Dashboard</div>
    <div class="option"><img src="att1.png" alt="Option Image"><a href="index.php">Attendance Dashboard</a></div>
  

    <div class="option"><img src="log1.png" alt="Option Image">Logout</div>
    <!-- Add more options as needed -->
</div>
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
                    <a href="cl.php">View All Classes</a>
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