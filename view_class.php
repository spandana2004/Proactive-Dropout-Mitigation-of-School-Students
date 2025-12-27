
<html>
<header>
        <h1>View Class</h1>
    </header>
    <style>
        header {
    background-color: #007BFF;
    color: #fff;
    text-align: center;
    padding: 10px;
}

.header h1 {
    margin: 0;
}
</style>
    
</html>
<?php
include 'connect.php';
session_start();

$aadhar = $_SESSION['aadhaar'];

// Retrieve teacher's class and section based on their ID
$sql_teacher = "SELECT Class, Section, Name FROM teacher_details WHERE Adhaar_Number = '$aadhar'";
$result_teacher = $conn->query($sql_teacher);

if ($result_teacher->num_rows > 0) {
    $row_teacher = $result_teacher->fetch_assoc();
    $teacher_class = $row_teacher['Class'];
    $teacher_section = $row_teacher['Section'];
    $teacher = $row_teacher['Name'];
    // Retrieve students based on the teacher's class and section
    $sql_students = "SELECT * FROM student_details WHERE Class = '$teacher_class' AND Section = '$teacher_section'";
    $result_students = $conn->query($sql_students);

    if ($result_students->num_rows > 0) {
        
        echo "<html>
                <head>
                    <style>
                    
                        table {
                            border-collapse: collapse;
                            width: 78%;
                            margin: 10 135 auto;
                        }

                        th, td {
                            border: 1px solid grey;
                            text-align: center;
                            padding: 8px;
                            font-size: 18px;
                        }
                        td:nth-child(6)
                        {
                            width: 165px;
                        }
                        td:nth-child(1)
                        {
                            width: 150px;
                        }

                        th {
                            background-color: #b3b6b7;
                        }
                    </style>
                </head>
                <body><br>
                <div style='font-size: 25px;'>
        <b>Class:</b> $teacher_class &nbsp;&nbsp; <b>Section:</b> $teacher_section
        <span style='float: right;'><b>Class Teacher:</b> $teacher</span>
      </div><br><br>";


        echo "<table>
            <tr>
                <th>Student Photo</th>
                <th>Student Name</th>
                <th>DOB</th>
                <th>Class</th>
                <th>Section</th>
                <th>Register Number</th>
            </tr>";

        // Output data of each row
        while ($row = $result_students->fetch_assoc()) {
            echo "<tr>
                <td><img src='" . $row['Image'] . "' style='width: 105px; height: 100px;' alt='Student Photo'></td>
                <td>" . $row["Name"] . "</td>
                <td>" . $row["DOB"] . "</td>
                <td>" . $row["Class"] . "</td>
                <td>" . $row["Section"] . "</td>
                <td>" . $row["Register_Number"] . "</td>
            </tr>";
        }
       

        echo "</table>
              </body>
              </html>";
              
    } else {
        echo '<script>alert("No records found"); window.location.href = "teach_dash.php";</script>';
    }
} else {
    // Handle the case where the teacher's details are not found
    echo '<script>alert("Teacher details not found"); window.location.href = "teach_dash.php";</script>';
}
echo "<style>
.go {
    background-color: #A569BD;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    cursor: pointer;
    position: fixed;
    bottom: 20px;
    right: 20px;
}
.go:hover {
    background-color: #D2B4DE;
}
</style>";

echo "<button class='go' onclick=\"window.location.href='teach_dash.php'\">Go to Dashboard</button>";
$conn->close();
?>


