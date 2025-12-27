<?php
// Include the database connection file
include('connect.php');

// Check if the state value is received
if(isset($_POST["state"])) {
    // Sanitize the received state value
    $selectedState = mysqli_real_escape_string($conn, $_POST["state"]);

    // Query to fetch districts based on the selected state
    $districtQuery = "SELECT District FROM school_details WHERE State = '$selectedState'";
    $districtResult = mysqli_query($conn, $districtQuery);

    // Check if districts are found
    if(mysqli_num_rows($districtResult) > 0) {
        // Initialize variable to store HTML options
        $options = '<option value="">Select</option>';
        // Generate HTML options for each district
        while($row = mysqli_fetch_assoc($districtResult)) {
            $options .= '<option value="'.$row["District"].'">'.$row["District"].'</option>';
        }
        // Return the generated options
        echo $options;
    } else {
        // No districts found for the selected state
        echo '<option value="">No districts found</option>';
    }
    // Query to fetch categories based on the selected state and district
   // $categoryQuery = "SELECT DISTINCT Category FROM school_details WHERE State = '$selectedState' AND District = '$selectedDistrict'";
//$categoryResult = mysqli_query($conn, $categoryQuery);
//if(mysqli_num_rows($categoryResult) > 0) {
  //  $options = '<option value="">Select</option>';
    //while($row = mysqli_fetch_assoc($categoryResult)) {
      //  $options .= '<option value="'.$row["Category"].'">'.$row["Category"].'</option>';
    //}
    //echo $options;
//} else {
  //  echo '<option value="">No categories found</option>';
//}

}
?>
