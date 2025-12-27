<?php
// Include the database connection file
include('connect.php');

// Check if the state value is received
if(isset($_POST["state"])) {
    // Sanitize the received state value
    $selectedState = mysqli_real_escape_string($conn, $_POST["state"]);
if(isset($_POST["district"])) {
        // Sanitize the received state value
        $selectedState = mysqli_real_escape_string($conn, $_POST["district"]);
    // Query to fetch districts based on the selected state
    $categoryQuery = "SELECT Category FROM school_details WHERE State = '$selectedState'&& District = '$selectedDistrict";
    $categoryResult = mysqli_query($conn, $categoryQuery);

    // Check if districts are found
    if(mysqli_num_rows($categoryResult) > 0) {
        // Initialize variable to store HTML options
        $options = '<option value="">Select</option>';
        // Generate HTML options for each district
        while($row = mysqli_fetch_assoc($categoryResult)) {
            $options .= '<option value="'.$row["Category"].'">'.$row["Category"].'</option>';
        }
        // Return the generated options
        echo $options;
    } else {
        // No districts found for the selected state
        echo '<option value="">No Category found</option>';
    }
}
}
?>