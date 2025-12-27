<?php
include('connect.php');
if (isset($_GET['schoolCode'])) {
    $schoolCode = $_GET['schoolCode'];
    $query = "SELECT * FROM teacher_details WHERE School_Code = '$schoolCode'";
    $result = $conn->query($query);
}
// Check if the form was submitted for updating
if (isset($_POST['submit'])) {
    $id = $_POST['Adhaar_Number'];
    $newData = [
        'Class' => $_POST['Class'],
        'Section' => $_POST['Section']
        // Add more columns as needed
    ];

    // Update data in the database
    $updateQuery = "UPDATE teacher_details SET Class = ?, Section = ? WHERE Adhaar_Number = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sss", $newData['Class'], $newData['Section'], $id);
    $stmt->execute();
}
if (isset($_POST['delete'])) {
    $id = $_POST['Adhaar_Number'];

    // Delete data from the database
    $deleteQuery = "DELETE FROM teacher_details WHERE Adhaar_Number = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("s", $id);
    $stmt->execute();
}
$searchResult = null;
if (isset($_GET['adhaar'])) {
    $schoolCode = $_GET['schoolCode'];
    $aadhaar = $_GET['adhaar'];
    $searchQuery = "SELECT * FROM teacher_details WHERE School_Code='$schoolCode' AND Adhaar_Number = '$aadhaar'";
    $searchResult = $conn->query($searchQuery);
}

$searchClass = null;
if (isset($_GET['filter_class']) && isset($_GET['filter_section'])) {
    $schoolCode = $_GET['schoolCode'];
    $filterClass = $_GET['filter_class'];
    $filterSection = $_GET['filter_section'];
    $searchQuery = "SELECT * FROM teacher_details WHERE School_Code='$schoolCode' AND Class = '$filterClass' AND Section = '$filterSection'";
    $searchClass = $conn->query($searchQuery);
}

// Retrieve data from the database
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Teacher Details</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
            background-color: #007BFF;
            color: #fff;
            padding: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left; /* Align text to the left in cells */
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:nth-child(odd) {
            background-color: #fff;
        }
        td:nth-child(1) {
    width: 115px; /* Adjust the width as needed */
        }
        td:nth-child(2) {
    width: 100px; /* Adjust the width as needed */
        }
        td:nth-child(3) {
    width: 85px;
        }
        td:nth-child(4) {
    width: 100px;
        }
        td:nth-child(5) {
    width: 100px;
        }
        td:nth-child(6) {
    width: 8%;
        }
        td:nth-child(7) {
    width: 8%;
        }
        td:nth-child(8) {
    width: 8%;
        }
        input[type="text"] {
            width: 60%; /* Adjust the width as needed */
            padding: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #27AE60;
            color: #fff;
            border: none;
            padding: 9px 24px;
            cursor: pointer;
            border-radius: 7px;
            
        }
        input[readonly] {
            background-color: #f2f2f2;
        }
        #search-form {
            margin-top: 20px;
        }

        #search-form input[type="text"] {
            width: 20%; /* Adjust the width as needed */
            padding: 5px;
            border: 1px solid #ccc;
        }

        #search-form input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 9px 16px;
            cursor: pointer;
            border-radius: 7px;
        }
        #filter-form {
    margin-top: 20px;
    float: left; /* Align to the right */
}

#filter-form select {
    height: 30px; /* Adjust the height as needed */
}

#filter-form input[type="submit"] {
    padding: 9px 16px; /* Adjust the padding as needed */
    border-radius: 7px; /* Adjust the border radius as needed */
    background-color: #007BFF;
}
#preloader{
background: black url(5.gif) no-repeat center center;
border-radius: 25px;
opacity: 0.7;
width: 99%;
height: 100%;
position: fixed;
z-index: 1000;
}
    </style>
</head>
<body>
<div id="preloader"></div>
<center><h1> Teacher Details</h1></center>
<div id="search-form">
    <form method="get" action="">
        <label for="adhaar"><font size=3.5>Search by Aadhaar Number:</font></label>
        <input type="text" name="adhaar" id="adhaar" placeholder="Enter Aadhaar Number">
        </ion-icon>
        <input type="hidden" name="schoolCode" value="<?php echo isset($_GET['schoolCode']) ? $_GET['schoolCode'] : ''; ?>">
        &nbsp;<input type="submit" value="Search">
        <!-- &nbsp;<input type="submit" name="promote" value="Promote All"> -->
        <!-- &nbsp; <input type="submit" name="update_all" value="Update All"> -->
    </form>
</div>
<div id="filter-form">
    <form method="get" action="">
        <label for="filter-class">Filter by Class:</label>
        <input type="hidden" name="schoolCode" value="<?php echo isset($_GET['schoolCode']) ? $_GET['schoolCode'] : ''; ?>">
        <select name="filter_class" id="filter-class">
            <option value="">Select</option>
            <!-- Add options for each class -->
            <option value="1">Class 1</option>
            <option value="2">Class 2</option>
            <option value="3">Class 3</option>
            <option value="4">Class 4</option>
            <option value="5">Class 5</option>
            <option value="6">Class 6</option>
            <option value="7">Class 7</option>
            <option value="8">Class 8</option>
            <option value="9">Class 9</option>
            <option value="10">Class 10</option>
            <!-- Add more options as needed -->
        </select>

        <label for="filter-section">Filter by Section:</label>
        <select name="filter_section" id="filter-section">
            <option value="">Select</option>
            <!-- Add options for each section -->
            <option value="A">Section A</option>
            <option value="B">Section B</option>
            <option value="C">Section C</option>
            <option value="D">Section D</option>
            <option value="E">Section E</option>
            <option value="F">Section F</option>
            <option value="G">Section G</option>
            <option value="H">Section H</option>
            <option value="I">Section I</option>
            <option value="J">Section J</option>
            <!-- Add more options as needed -->
        </select>
        &nbsp;
        <input type="submit" value="Apply Filter">
    </form>
</div>
<br><br><br><br><br>
<div id="table-container">
<table>
    <tr>
        <th>Name</th>
        <th>Adhaar Number</th>
        <th>Gender</th>
        <th>Class</th>
        <th>Section</th>
    </tr>
    <?php while ($row = (isset($searchResult) ? $searchResult->fetch_assoc() : ($searchClass ? $searchClass->fetch_assoc() : $result->fetch_assoc()))): ?>
        <form method="post" action="">
            <tr>
            <td><?php echo $row['Name']; ?></td>
                <td><?php echo $row['Adhaar_Number']; ?></td>

                <td><?php echo $row['Gender']; ?></td>
                <td><input type="text" name="Class" value="<?php echo $row['Class']; ?>"></td>
                <td><input type="text" name="Section" value="<?php echo $row['Section']; ?>"></td>
                <td>
                    <input type="hidden" name="Adhaar_Number" value="<?php echo $row['Adhaar_Number']; ?>"> &nbsp;
                    <input type="submit" name="submit" value="Update">
                </td>
                <td>
                <input type="submit" name="delete" value="Delete" style="background-color: #FF0000; color: #fff">
            </td>
            <td>
    <a href="view_teachers.php?Adhaar_Number=<?php echo $row['Adhaar_Number']; ?>" style="background-color: #007BFF; color: #fff; text-decoration: none; padding: 10px 27px; border-radius: 7px; font-size: 13px;">View</a>
</td>
            </tr>
        </form>
    <?php endwhile; ?>
</table>
</div>
<script>
var loader=document.getElementById("preloader");
setTimeout(function() {
    loader.style.display = "none";
}, 5000);
</script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
