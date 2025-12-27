<?php
include('connect.php');
// Check if the form was submitted for updating
if (isset($_GET['schoolCode'])) {
    $schoolCode = $_GET['schoolCode'];
        $query = "SELECT * FROM student_details WHERE School_Code = '$schoolCode'";
    $result = $conn->query($query);
}

if (isset($_POST['submit'])) {
    $id = $_POST['Adhaar_Number'];
    $newData = [
        'Class' => $_POST['Class'],
        'Section' => $_POST['Section'],
        'Student_Status' => $_POST['Student_Status']

        // Add more columns as needed
    ];

    // Update data in the database
    $updateQuery = "UPDATE student_details SET Class = ?, Section = ?, Student_Status=? WHERE Adhaar_Number = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssss", $newData['Class'], $newData['Section'], $newData['Student_Status'], $id);
    $stmt->execute();
    if($updateQuery){
        $schoolCode = $_GET['schoolCode'];
        $redirectURL = "view1.php?schoolCode=" . $schoolCode;
        echo '<script>
            alert("Updated Successfully");
            window.location.href = "' . $redirectURL . '"; 
        </script>';
    }
}
if (isset($_POST['delete'])) {
    $id = $_POST['Adhaar_Number'];

    // Delete data from the database
    $deleteQuery = "DELETE FROM student_details WHERE Adhaar_Number = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("s", $id);
    $stmt->execute();
}
if (isset($_GET['promote'])) {
    $schoolCode = $_GET['schoolCode'];

    // Promote all students
    $promoteQuery = "UPDATE student_details SET Class = CASE WHEN Class = 10 THEN 0 ELSE Class + 1 END WHERE School_Code = '$schoolCode'";
    $conn->query($promoteQuery);

    // Redirect to the view1.php page after promoting all students
    $redirectURL = "view1.php?schoolCode=" . $schoolCode;
    echo '<script>
        alert("All students promoted successfully");
        window.location.href = "' . $redirectURL . '"; 
    </script>';
}
$searchResult = null;
if (isset($_GET['search_register_number'])) {
    $schoolCode = $_GET['schoolCode'];
    $searchRegisterNumber = $_GET['search_register_number'];
    $searchQuery = "SELECT * FROM student_details WHERE School_Code='$schoolCode' AND Register_Number = '$searchRegisterNumber'";
    $searchResult = $conn->query($searchQuery);
}

$searchClass = null;
if (isset($_GET['filter_class']) && isset($_GET['filter_section'])) {
    $schoolCode = $_GET['schoolCode'];
    $filterClass = $_GET['filter_class'];
    $filterSection = $_GET['filter_section'];
    $searchQuery = "SELECT * FROM student_details WHERE School_Code='$schoolCode' AND Class = '$filterClass' AND Section = '$filterSection'";
    $searchClass = $conn->query($searchQuery);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Student Details</title>
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
    width: 190px; /* Adjust the width as needed */
        }
        td:nth-child(2) {
    width: 140px; /* Adjust the width as needed */
        }
        td:nth-child(3) {
    width: 140px; /* Adjust the width as needed */
        }
        td:nth-child(4) {
    width: 140px;
        }
        td:nth-child(5) {
    width: 140px;
        }
        td:nth-child(6) {
    width: 160px;
        }
        td:nth-child(7) {
    width: 80px;
        }
        td:nth-child(8) {
    width: 80px;
        }
        td:nth-child(9) {
    width: 80px;
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
<center><h1> Student Details</h1></center>
<div id="search-form">
    <form method="get" action="">
        <label for="search-register-number"><font size=3.5>Search by Register Number:</font></label>
        <input type="text" name="search_register_number" id="search-register-number" placeholder="Enter Register Number">
        <input type="hidden" name="schoolCode" value="<?php echo isset($_GET['schoolCode']) ? $_GET['schoolCode'] : ''; ?>">
        &nbsp;<input type="submit" value="Search">
        &nbsp;<input type="submit" name="promote" value="Promote All">
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
<br></br>
<br></br>
<div id="table-container">
<table>
    <tr> 
        <th>Name</th>
        <th>Register Number</th>
        <th>Gender</th>
        <th>Class</th>
        <th>Section</th>
        <th>Student Status</th>
    </tr>
    <?php while ($row = (isset($searchResult) ? $searchResult->fetch_assoc() : ($searchClass ? $searchClass->fetch_assoc() : $result->fetch_assoc()))): ?>
    <form method="post" action="">
        <tr>
            
            <td><?php echo $row['Name']; ?></td>
            <td><?php echo $row['Register_Number']; ?></td>
            <td><?php echo $row['Gender']; ?></td>
            <td><input type="text" name="Class" value="<?php echo $row['Class']; ?>"></td>
            <td><input type="text" name="Section" value="<?php echo $row['Section']; ?>"></td>
            <td>
                <select name="Student_Status" style="height: 30px;">
                    <option value="Promoted" <?php echo ($row['Student_Status'] == 'Promoted') ? 'selected' : ''; ?>>Promoted</option>
                    <option value="New Admission" <?php echo ($row['Student_Status'] == 'New Admission') ? 'selected' : ''; ?>>New Admission</option>
                    <option value="TC" <?php echo ($row['Student_Status'] == 'TC') ? 'selected' : ''; ?>>TC</option>
                </select>
            </td>
            <td>
                <input type="hidden" name="Adhaar_Number" value="<?php echo $row['Adhaar_Number']; ?>">
                <input type="submit" name="submit" value="Update">
            </td>
            <td>
    <input type="submit" name="delete" value="Delete" style="background-color: #FF0000; color: #fff;">
</td>
<!-- Modified View button to redirect to a new page -->
<td>
    <a href="view_students.php?Adhaar_Number=<?php echo $row['Adhaar_Number']; ?>" style="background-color: #007BFF; color: #fff; text-decoration: none; padding: 9px 24px; border-radius: 5px; font-size: 14px;">View</a>
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
}, 3500);
</script>
</body>
</html>

<?php 
// Close the database connection
$conn->close();
?>
