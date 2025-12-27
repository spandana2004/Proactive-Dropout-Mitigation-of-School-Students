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

$sql_principal = "SELECT School_Code FROM principal_details WHERE Adhaar_Number = '$aadhar'";
$result_principal = $conn->query($sql_principal);

if ($result_principal->num_rows > 0) {
    $row_principal = $result_principal->fetch_assoc();
    $School_Code = $row_principal['School_Code'];
}
// Function to calculate percentage
function calculatePercentage($present, $total) {
    if ($total == 0) {
        return 0;
    } else {
        return ($present / $total) * 100;
    }
}

// Fetch unique section values for dropdown options
$sectionQuery = "SELECT DISTINCT section FROM attendance";
$sectionResult = $conn->query($sectionQuery);


// Display form for filtering
echo "<h2>Attendance Report</h2>";
echo "<form method='get'>";
echo "<label for='class'>Select Class:</label>";
echo "<select name='class'>";
for ($i = 1; $i <= 10; $i++) {
    $selected = ($_GET['class'] == $i) ? 'selected' : '';
    echo "<option value='{$i}' $selected>Class {$i}</option>";
}
echo "</select>";

echo "<label for='section'>Select Section:</label>";
echo "<select name='section'>";
$sections = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H']; // Add more sections as needed
foreach ($sections as $sectionValue) {
    $selected = ($_GET['section'] == $sectionValue) ? 'selected' : '';
    echo "<option value='{$sectionValue}' $selected>Section {$sectionValue}</option>";
}
echo "</select>";

echo "<label for='School_code'>Select School Code:</label>";
echo "<select name='School_code'>";
while ($schoolCodeRow = $schoolCodeResult->fetch_assoc()) {
    $selected = ($_GET['School_code'] == $schoolCodeRow['School_code']) ? 'selected' : '';
    echo "<option value='{$schoolCodeRow['School_code']}' $selected>{$schoolCodeRow['School_code']}</option>";
}
echo "</select>";

echo "<input type='submit' value='Filter'>";
echo "</form>";

// Fetch data from the database with optional filters
$filterClass = isset($_GET['class']) ? $_GET['class'] : null;
$filterSection = isset($_GET['section']) ? $_GET['section'] : null;
$filterSchoolCode = isset($_GET['School_code']) ? $_GET['School_code'] : null;

$sql = "SELECT class, section, School_code,
        WEEK(`attendance_date`) as week_number,
        COUNT(*) as total,
        SUM(attendance_status = 1) as present,
        SUM(attendance_status = 0) as absent
        FROM attendance
        WHERE YEARWEEK(`attendance_date`) = YEARWEEK(NOW())";

// Add optional filters
if ($filterClass !== null) {
    $sql .= " AND class = '$filterClass'";
}

if ($filterSection !== null) {
    $sql .= " AND section = '$filterSection'";
}

if ($filterSchoolCode !== null) {
    $sql .= " AND School_code = '$filterSchoolCode'";
}

$sql .= " GROUP BY class, section, School_code, week_number";

$result = $conn->query($sql);

// Display CSS styles
echo "<style>
        body {
            background-color: #ffffff; /* White background color */
            color: #000000; /* Black text color */
            font-family: 'Arial', sans-serif; /* Set a preferred font family */
        }

        h2 {
            color: #000080; /* Navy Blue header color */
            text-align: center; /* Center the text */
            font-size: 24px; /* Set the font size to 24 pixels */
            margin-top: 20px; /* Add some top margin for spacing */
        }

        form {
            background-color: #add8e6; /* Light Blue form background color */
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }

        label {
            color: #000080; /* Navy Blue label text color */
        }

        select, input[type='submit'] {
            background-color: #000080; /* Navy Blue select and submit button background color */
            color: #ffffff; /* White text color */
            padding: 8px;
            margin-right: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        table {
            background-color: #ffffff; /* White table background color */
            color: #000000; /* Black table text color */
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid #000080; /* Navy Blue border color */
        }

        #successMessage {
            background-color: #add8e6; /* Light Blue success message background color */
            color: #000000; /* Black success message text color */
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }
    </style>";


// Display data in a table
echo "<table border='1'>
        <tr>
            <th>Class</th>
            <th>Section</th>
            <th>School Code</th>
            <th>Absent Percentage</th>
            <th>Present Percentage</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Approval Button</th>
        </tr>";

while ($row = $result->fetch_assoc()) {
    $class = $row['class'];
    $section = $row['section'];
    $schoolCode = $row['School_code'];
    $absentPercentage = calculatePercentage($row['absent'], $row['total']);
    $presentPercentage = calculatePercentage($row['present'], $row['total']);
    
    // Calculate the start date of the week
    $weekStart = new DateTime();
    $weekStart->setISODate(date('Y'), $row['week_number']);
    $startDate = $weekStart->format('Y-m-d');

    // Calculate the end date of the week (add 6 days to start date)
    $weekEnd = clone $weekStart;
    $weekEnd->add(new DateInterval('P6D'));
    $endDate = $weekEnd->format('Y-m-d');

    echo "<tr>
            <td>{$class}</td>
            <td>{$section}</td>
            <td>{$schoolCode}</td>
            <td>{$absentPercentage}%</td>
            <td>{$presentPercentage}%</td>
            <td>{$startDate}</td>
            <td>{$endDate}</td>
            <td><button onclick='approveAttendance(\"{$class}\", \"{$section}\", \"{$startDate}\")'>Approve</button></td>
          </tr>";
}

echo "</table>";

// Close connection
$conn->close();
?>
