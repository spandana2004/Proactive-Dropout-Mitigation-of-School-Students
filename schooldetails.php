<?php
// Include the database connection file
include('connect.php');

// Fetch all distinct states from the school_details table
$stateQuery = "SELECT DISTINCT State FROM sih.school_details";
$stateResult = mysqli_query($conn, $stateQuery);

// Initialize variable to hold school details
$schoolDetails = [];

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get and sanitize the selected state and district
    $selectedState = mysqli_real_escape_string($conn, $_POST['state']);
    $selectedDistrict = mysqli_real_escape_string($conn, $_POST['district']);
   $selectedCategory = mysqli_real_escape_string($conn, $_POST['category']);


// Fetch schools based on selected state, district, and category
$schoolQuery = "SELECT * FROM school_details WHERE State='$selectedState' AND District='$selectedDistrict' AND Category='$selectedCategory'";
//$schoolQuery = "SELECT * FROM school_details WHERE State='$selectedState' AND District='$selectedDistrict'";
$schoolResult = mysqli_query($conn, $schoolQuery);

// Fetch school details and store them in the variable
while ($row = mysqli_fetch_assoc($schoolResult)) {
    $schoolDetails[] = $row;
}

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Select State and District And Category</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h1>Select State and District and Category</h1>
    <form method="post" action="">
        <label for="state">Select State:</label>
        <select name="state" id="state">
            <option value="">Select</option>
            <?php while ($stateRow = mysqli_fetch_assoc($stateResult)): ?>
                <option value="<?php echo $stateRow['State']; ?>"><?php echo $stateRow['State']; ?></option>
            <?php endwhile; ?>
        </select>

        <label for="district">Select District:</label>
        <select name="district" id="district">
            <option value="">Select</option>
        </select>

        <label for="category">Select Category:</label>
            <select name="category" id="category">
             <option value="">Select</option>
                <option value="Government Aided">Government Aided</option>
                <option value="Private">Private</option>
                <option value="Government">Government</option>


            <input type="submit" name="submit" value="Search">
    </form>

    <script>
        $(document).ready(function(){
            $('#state').change(function(){
                var state = $(this).val();
                if(state && district)
                {
                    $.ajax({
                        type: 'POST',
                        url: 'getDistricts.php',
                        data: 'state='+state,
                        success: function(response){
                            $('#district').html(response);
                           
                        }
                    });


                } 
                else 
                {
                    $('#district').html('<option value="">Select</option>');
                    
                    
                }
            });
        });
    </script>
</body>
</html>



    <?php if (!empty($schoolDetails)): ?>
        <h2>Schools in <?php echo $selectedDistrict; ?>, <?php echo $selectedState; ?> :</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>School Name</th>
                    <th>School_Code</th>
                    <th>School_Email</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($schoolDetails as $school): ?>
                    <tr>
                        <td><?php echo $school['School_Name']; ?></td>
                        <td><?php echo $school['School_Code']; ?></td>
                        <td><?php echo $school['School_Email']; ?></td>
                        <td><?php echo $school['Category']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>

