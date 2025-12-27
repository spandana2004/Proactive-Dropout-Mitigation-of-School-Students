<?php
session_start();

// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION['aadhaar'])) {
    header("Location: ../Login.php"); // Adjust the path as needed
    exit;
}

// Now you can use $_SESSION['adhaar'] in this file
$aadhar = $_SESSION['aadhaar'];

// Establish a database connection (you'll need to fill in your own credentials)
include 'connect.php';
// Retrieve the selected class and section from the form
$sql_teacher = "SELECT Class, Section FROM teacher_details WHERE Adhaar_Number = '$aadhar'";
$result_teacher = $conn->query($sql_teacher);

if ($result_teacher->num_rows > 0) {
    $row_teacher = $result_teacher->fetch_assoc();
    $teacher_class = $row_teacher['Class'];
    $teacher_section = $row_teacher['Section'];
}

$attendance_date = $_POST['attendance_date'];

// Query the database for attendance records
$sql = "SELECT * FROM attendance WHERE Class = '$teacher_class' AND Section = '$teacher_section' AND attendance_date = '$attendance_date'";
$result = $conn->query($sql);

echo "<style>
    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    .present {
        color: green;
    }

    .absent {
        color: red;
    }
</style>";

if ($result->num_rows > 0) {
    echo "<table>
        <tr>
            <th>Student Name</th>
            <th>Admission Number</th>
            <th>Attendance Date</th>
            <th>Attendance Status</th>
        </tr>";

    while ($row = $result->fetch_assoc()) {
        $statusClass = ($row['attendance_status'] == 1) ? 'present' : 'absent';
        echo "<tr>
            <td>" . $row['Name'] . "</td>
            <td>" . $row['Register_Number'] . "</td>
            <td>" . $row['attendance_date'] . "</td>            
            <td class='$statusClass'>" . ($row['attendance_status'] == 1 ? 'Present' : 'Absent') . "</td>
        </tr>";
    }

    echo "</table>";
} else {
    echo "<p>No attendance records found for the selected class and section.</p>";
}

$conn->close();
?>
