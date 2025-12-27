document.getElementById('searchForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var aadharNumber = document.getElementById('aadharNumber').value;

    // Use AJAX to send Aadhar Number to server
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'get_data.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);
            if (data.error) {
                document.getElementById('result').innerHTML = data.error;
            } else {
                document.getElementById('result').innerHTML = `
                    Name: ${data.name}<br>
                    Date of Birth: ${data.dob}<br>
                    Gender: ${data.gender}
                `;
            }
        } else {
            console.error('Error:', xhr.statusText);
        }
    };

    xhr.send('aadharNumber=' + aadharNumber);
});


/*

    data <- ajax
    js value <- data

    <script>
        $_GLOBAL['Gender'] <- data
    </script>

    <input type="text" val="<?php>echo $_GLOBAL['Gender']<php>" disabled></input>

*/