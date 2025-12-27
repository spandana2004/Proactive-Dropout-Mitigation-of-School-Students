<?php

include 'dbcon.php';

$Class = $_POST['Class'];
$Section = $_POST['Section'];
$date = $_POST['date'];

// Assuming you have a way to get the list of students for the selected class and section
$students = $_POST['attendance'];

foreach ($students as $student_an => $attendance) {
    $student_an = $_POST['Adhaar_Number'][$student_an];
    $Name = $_POST['Name'][$student_an];
    $Register_Number = $_POST['Register_Number'][$student_an];
    $Class = $_POST['Class'][$student_an];
    $Section = $_POST['Section'][$student_an];
    $Gender = $_POST['Gender'][$student_an];
    $Caste = $_POST['Caste'][$student_an];
    $School_Code = $_POST['School_Code'][$student_an];

    $sql = "INSERT INTO attendance (Adhaar_Number, Name, Register_Number, Class, Section, attendance_status, Gender, Caste, attendance_date, School_Code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssissssss", $student_an, $Name, $Register_Number, $Class, $Section, $attendance, $Gender, $Caste, $date, $School_Code);
    $stmt->execute();
    $stmt->close();
}

$conn->close();

// Redirect to a success page or do any other necessary actions
header('Location: dashboard.php');
exit();

?>
