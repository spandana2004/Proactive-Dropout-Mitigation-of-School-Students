<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Legions</title>
<style>
  body {
    margin: 0;
    padding: 0;
    font-family: 'Helvetica', sans-serif;
    background-attachment: fixed;
  }
  header {
    background-color: #5DADE2;
    opacity: 0.87;
    padding: 20px;
    text-align: center;
    color: #eeeeee;
  }
  h1 {
    font-size: 25px;
    color: black;
    padding-bottom: 0px;
    padding-top: 0px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
  }
  h2 {
    font-size: 18px;
    color: black;
    padding-top: 0px;
    padding-bottom: 0px;
    text-shadow: 1px 2px 2px rgba(0, 0, 0, 0.25);
  }
  .logo {
    position: absolute;
    top: 20px;
    left: 20px;
  }
  .p1 {
    color: #FFF;
    font-size: 20px;
  }
  .container {
    max-width: 570px;
    margin: 0 auto;
    padding: 20px;
    background-color: #A9CCE3;
    border-radius: 15px;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
  }

  img {
    height: 300px; /* Set the desired height for your images */
  }
</style>
<style>
  body {
    text-align: center;
  }
  .padd {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
  }
  .con {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0px;
  }
  .logo {
    max-width: 100px;
    margin: 0 20px;
  }
  .partition {
    border-left: 1px solid #000;
    height: 100px;
    margin: 0 20px;
  }
  .login {
  width: 115px;
  height: 40px;
  background: #7FB3D5;
  border: 2px solid black;
  border-radius: 10px;
  cursor: pointer;
  font-size: 15px;
  color: white; /* Fix typo: Change font-color to color */
  transition: background 0.3s ease; /* Add transition for a smooth color change */
  text-decoration: none;
  color: #013948;
  font-weight: bold;
} 

.login:hover {
  background: white; /* Change the background color to white on hover */
  color: black; /* Change text color on hover */
}
  .toggle-button {
    background: none;
    border: none;
    font-size: 30px;
    cursor: pointer;
    color: white;
  }
</style>
<style>
  .loading_div {
    background-image: url("./assets/images/loading-min.gif");
    background-repeat: no-repeat;
    height: 100px;
    width: 100px;
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
    opacity: 0.9;
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
    0% {
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
    0% {
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
  .slider {
    width: 100%;
    overflow: hidden;
    position: relative;
  }

  .slides {
    display: flex;
    transition: transform 1s ease-in-out;
  }

  .slide {
    width: 100%;
    height: 100vh;
  }
  .feature-box-container {
  display: flex;
  justify-content: space-around;
  margin-top: 30px;
  flex-wrap: wrap;

}
.feature-box {
      width: 350px;
      height: 400px;
      text-align: center;
      padding: 20px;
      border-radius: 10px;
      text-align: center;
      margin: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .feature-box p {
  text-align: justify;
}

    .yellow-box {
      background-color: #fff176; /* Light Yellow */
    }

    .pink-box {
      background-color: #f48fb1; /* Pink */
    }

    .green-box {
      background-color: #a5d6a7; /* Green */
    }
    .footer {
            text-align: center;
            background-color: #AAB7B8;
            color: #fff;
            padding: 10px 0;
        }
        .dropdown {
      position: relative;
      display: inline-block;
    }

    /* Style for the dropdown button */
    .login-btn {
      padding: 10px;
      font-size: 16px;
      border: none;
      cursor: pointer;
    }

    /* Style for the dropdown content */
    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      border-radius: 8px;
      min-width: 160px;
      box-shadow: grey;
      z-index: 1;
    }

    /* Style for the dropdown options */
    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
      border-radius: 5px;
    
    }

    /* Change color on hover */
    .dropdown-content a:hover {
      background-color: #d0d3d4;
    }

    /* Show the dropdown content when the button is clicked */
    .dropdown:hover .dropdown-content {
      display: block;
      border-radius: 8px;
    }
</style>
</head>
<body>
  <header>
    <div class="logo"><img src="16.png" style="width: 140px; height: 120px; border-radius: 15px border: 1px solid black"></div>
    <h1> Department of School Education and Literacy<br></h1>
    <div class="padd">
      <h2>Ministry of Education <br> Government of India</h2>
      <img src="19.png" style="width: 50px; height: 80px;" alt="Logo 1"></h2>
      <div class="partition"></div>
      <img src="21.png" style="width: 100px; height: 100px; border-radius: 15px" alt="Logo 2"></div>
    <div class="con">
      <div class="logo1">
        <img src="20.jpg" style="width: 140px; height: 110px; border-radius: 15px" alt="Logo 1">
      </div>
      <div class="partition"></div>
      <div class="logo2">
        <img src="17.png" style="width: 160px; height: 110px; border-radius: 15px" alt="Logo 2">
      </div>
    </div>
  </header>
  <style>
    p {
      font-size: 5;
      color: black;
    }
  </style>
  <br><br>
  <div class="container">
    <!-- Your content goes here -->
      <button class="login" onclick="window.location.href='About_us.html'">About </a></button>&nbsp; &nbsp;
      <button class="login" onclick="window.location.href='Contact_Us.html'">Contact Us</a></button> &nbsp; &nbsp;
      <div class="dropdown">
  <button class="login">Login</button>&nbsp; &nbsp;
  <div class="dropdown-content">
    <a href="School_log.php">School Login</a>
    <a href="Login.php">Staff Login</a>
  </div>
</div>
      <button class="login" onclick="window.location.href='Verify.php'">Register</a></button></p>
  </div>
  <br>
  <h1>Features</h1>
  <div class="feature-box-container">
    <div class="feature-box yellow-box">
      <h2>Predictive Dropout Analysis</h2>
      <p>Our platform integrates sophisticated algorithms that delve deep into various student-related data points, including attendance patterns, academic performance, and behavioral indicators. By analyzing these factors comprehensively, we can accurately predict potential student dropouts. This predictive capability enables educational institutions to take proactive measures, such as personalized interventions, counseling, and additional support, to address underlying issues and prevent students from disengaging. In doing so, schools can foster a supportive environment that prioritizes the success and well-being of every student.</p>
    </div>

    <div class="feature-box pink-box">
      <h2>Comprehensive Attendance Management</h2>
      <p>With a user-friendly dashboard designed for seamless interaction, our system revolutionizes attendance management in educational institutions. Schools can effortlessly register both teachers and students, providing a centralized platform for attendance tracking. Real-time alerts for irregularities ensure that potential issues are addressed promptly. This comprehensive approach to attendance management not only streamlines administrative processes but also contributes to a more organized and efficient learning environment. It empowers educators with the tools needed to identify trends and make data-driven decisions for improved student engagement.</p>
    </div>

    <div class="feature-box green-box">
      <h2>Data-Driven Decision Support</h2>
      <p>Our platform goes beyond traditional data analysis by providing educational stakeholders with in-depth analytics and actionable insights. By leveraging data from various sources, including attendance records, academic performance, and demographic information, the platform enables informed decision-making. Higher Authorities, administrators, and policymakers can use these insights to implement targeted strategies, allocate resources effectively, and tailor educational programs to meet the specific needs of students. This data-driven approach becomes a cornerstone for enhancing overall educational planning, resulting in positive outcomes for both students and educational institutions.</p>
    </div>
    <br>
  </div>
  <h1>Registered Schools</h1>
  <br>
  <div class="slider">
    <div class="slides">
      <div class="slide">
        <img src="NPS.jpg" alt="Slide 1">&nbsp; &nbsp;<br></br><br>
        <img src="EWPS.avif" alt="Slide 3" style="width: 410px; height: 300px; float: left;">
      </div>
      <div class="slide">
        <img src="GPS.jpg" alt="Slide 2">
      </div>
      <div class="slide">
        <img src="KV.jpg" alt="Slide 3">
      </div>
    </div>
  </div>
  <div id="outer">
    <div id="inner">
      <div id="preloader">
        <div id="loader"></div>
      </div>
    </div>
  </div>
  <div class="footer">
        <p>&copy; 2024 Data Legions. All rights reserved.</p>
    </div>
  <script>
    var loader = document.getElementById("preloader");
    setTimeout(function () {
      loader.style.display = "none";
    }, 4500);
  </script>
</body>
</html>
