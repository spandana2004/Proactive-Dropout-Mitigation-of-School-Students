<?php
session_start();

// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION['aadhaar'])) {
    header("Location: ../Login.php"); // Adjust the path as needed
    exit;
}

// Now you can use $_SESSION['adhaar'] in this file
$aadhar = $_SESSION['aadhaar'];

include 'connect.php';
$date = $_POST['date'];

$sql_teacher = "SELECT Class, Section, School_Code FROM teacher_details WHERE Adhaar_Number = '$aadhar'";
$result_teacher = $conn->query($sql_teacher);

if ($result_teacher->num_rows > 0) {
    $row_teacher = $result_teacher->fetch_assoc();
    $Class = $row_teacher['Class'];
    $Section = $row_teacher['Section'];
    $School_Code = $row_teacher['School_Code'];
}


//if(($teacher_class == $Class) && ($teacher_section = $Section)) {
// Insert attendance into database
$sql = "INSERT INTO attendance (Adhaar_Number, Name, Register_Number, Class, Section, attendance_status, Gender, Caste, attendance_date, School_Code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

function get_students_for_class_section($Class, $Section) {
    include 'connect.php'; // Include the database connection file

    $sql = "SELECT  Adhaar_Number, School_Code, Name, Register_Number, Class, Section, Gender, Caste FROM student_details WHERE Class = ? AND Section = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $Class, $Section);
    $stmt->execute();

    $result = $stmt->get_result();
    $students = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    $conn->close();

    return $students;
}

// Assuming you have a way to get the list of students for the selected class and section
$students = get_students_for_class_section($Class, $Section);
//}
/* else {
    echo "select proper class";
    exit(0);
} */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Form</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        input[type="checkbox"] {
            margin-right: 10px;
        }

        input[type="submit"] {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <form action="submit_attendance2.php" method="post">
        <input type="hidden" name="Class" value="<?= $Class ?>">
        <input type="hidden" name="Section" value="<?= $Section ?>">
        <input type="hidden" name="date" value="<?= $date ?>">

        <table>
            <tr>
                <th>Present</th>
                <th>Absent</th>
                <th>Student Name</th>
                <th>Register Number</th>
                <th>Class</th>
                <th>Section</th>
            </tr>
            <?php foreach ($students as $student) : ?>
                <?php
                    $student_an = $student['Adhaar_Number'];
                    $Name = $student['Name'];
                    $Register_Number = $student['Register_Number'];
                    $Class = $student['Class'];
                    $Section = $student['Section'];
                    $Gender = $student['Gender'];
                    $Caste = $student['Caste'];
                    $School_Code = $student['School_Code'];
                ?>
                <tr>
                    <td>
                        <input type="radio" name="attendance[<?= $student_an ?>]" value="1">
                    </td>
                    <td>
                        <input type="radio" name="attendance[<?= $student_an ?>]" value="0">
                    </td>
                    <td>
                        <?= $Name ?>
                        <input type="hidden" name="Name[<?= $student_an ?>]" value="<?= $Name ?>">
                    </td>
                    <td>
                        <?= $Register_Number ?>
                        <input type="hidden" name="Register_Number[<?= $student_an ?>]" value="<?= $Register_Number ?>">
                    </td>
                    <td>
                        <?= $Class ?>
                        <input type="hidden" name="Class[<?= $student_an ?>]" value="<?= $Class ?>">
                    </td>
                    <td>
                        <?= $Section ?>
                        <input type="hidden" name="Section[<?= $student_an ?>]" value="<?= $Section ?>">
                    </td>
                        <input type="hidden" name="Gender[<?= $student_an ?>]" value="<?= $Gender ?>">
                        <input type="hidden" name="Caste[<?= $student_an ?>]" value="<?= $Caste ?>">
                        <input type="hidden" name="Adhaar_Number[<?= $student_an ?>]" value="<?= $student_an ?>">
                        <input type="hidden" name="School_Code[<?= $student_an ?>]" value="<?= $School_Code ?>">
                </tr>
            <?php endforeach; ?>
        </table>

        <input type="submit" value="Submit Attendance">
    </form>
</body>
</html>
