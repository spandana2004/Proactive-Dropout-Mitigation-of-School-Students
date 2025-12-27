<?php
include('connect.php');

if (isset($_GET['Adhaar_Number'])) {
    $adhaarNumber = $_GET['Adhaar_Number'];

    // Fetch the student details based on the Aadhaar Number
    $viewQuery = "SELECT * FROM student_details WHERE Adhaar_Number = ?";
    $stmt = $conn->prepare($viewQuery);
    $stmt->bind_param("s", $adhaarNumber);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No student found with the given Aadhaar Number.";
        exit();
    }
} else {
    echo "Aadhaar Number not provided.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <style>
     body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 800px;
            backdrop-filter: blur(50px);
            margin: 0; /* Remove default body margin */
        }

        .container {
            background-color: #fff;
            position: absolute;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 600px;
            height: 1110px;
            top: 4%;
            left: 30%; /* Center the container */
        }

        .header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .profile {
            text-align: center;
            padding: 20px;
            font-weight: bold;
        }

        img {
            width: 110px;
            height: 115px;
            object-fit: cover;
            margin-bottom: 10px;
            border: 1px solid #000;
            border-radius: 5px;
        }

        .details {
            padding: 20px;
        }

        .field {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .field label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .field p {
            margin: 0;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Student Details</h2>
    </div>
    
    <div class="profile">
        <!-- Display student photo if available -->
            <label>Student Photo</label>
            <br><br>
            <img src="<?php echo $row['Image']; ?>" style="width: 120px; height: 115px;" alt="Student Photo">
       
    </div>

    <div class="details">

<div class="field">
        <label>Name:</label>
        <p><?php echo $row['Name']; ?></p>
    </div>

    <div class="field">
        <label>Register Number:</label>
        <p><?php echo $row['Register_Number']; ?></p>
    </div>
    <div class="field">
        <label>School Code:</label>
        <p><?php echo $row['School_Code']; ?></p>
    </div>

    <div class="field">
        <label>Aadhaar Number:</label>
        <p><?php echo $row['Adhaar_Number']; ?></p>
    </div>

    <div class="field">
        <label>Date of Birth:</label>
        <p><?php echo $row['DOB']; ?></p>
    </div>
    <div class="field">
        <label>Class:</label>
        <p><?php echo $row['Class']; ?></p>
    </div>
    <div class="field">
        <label>Section:</label>
        <p><?php echo $row['Section']; ?></p>
    </div>

    <div class="field">
        <label>Gender:</label>
        <p><?php echo $row['Gender']; ?></p>
    </div>

    <div class="field">
        <label>Caste:</label>
        <p><?php echo $row['Caste']; ?></p>
    </div>
    <div class="field">
        <label>Parent's Annual Salary:</label>
        <p>₹<?php echo $row['Income']; ?></p>
    </div>
    <div class="field">
        <label>Email:</label>
        <p><?php echo $row['Email_Id']; ?></p>
    </div>

    <div class="field">
        <label>Student Status:</label>
        <p><?php echo $row['Student_Status']; ?></p>
    </div>
</div>
</div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
