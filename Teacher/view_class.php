<?php
include 'connect.php';
session_start();

$aadhar = $_SESSION['aadhaar'];

// Retrieve teacher's class and section based on their ID
$sql_teacher = "SELECT Class, Section FROM teacher_details WHERE Adhaar_Number = '$aadhar'";
$result_teacher = $conn->query($sql_teacher);

if ($result_teacher->num_rows > 0) {
    $row_teacher = $result_teacher->fetch_assoc();
    $teacher_class = $row_teacher['Class'];
    $teacher_section = $row_teacher['Section'];
    // Retrieve students based on the teacher's class and section
    $sql_students = "SELECT * FROM student_details WHERE Class = '$teacher_class' AND Section = '$teacher_section'";
    $result_students = $conn->query($sql_students);

    if ($result_students->num_rows > 0) {
        echo "<html>
                <head>
                    <style>
                        table {
                            border-collapse: collapse;
                            width: 100%;
                        }

                        th, td {
                            border: 1px solid #dddddd;
                            text-align: left;
                            padding: 8px;
                        }

                        th {
                            background-color: #f2f2f2;
                        }
                    </style>
                </head>
                <body>";

        echo "<table>
            <tr>
                <th>Name</th>
                <th>Register Number</th>
                <th>Class</th>
                <th>Section</th>
            </tr>";

        // Output data of each row
        while ($row = $result_students->fetch_assoc()) {
            echo "<tr>
                <td>" . $row["Name"] . "</td>
                <td>" . $row["Register_Number"] . "</td>
                <td>" . $row["Class"] . "</td>
                <td>" . $row["Section"] . "</td>
            </tr>";
        }

        echo "</table>
              </body>
              </html>";
    } else {
        echo "0 results";
    }
} else {
    // Handle the case where the teacher's details are not found
    echo "Teacher details not found.";
}

$conn->close();
?>


