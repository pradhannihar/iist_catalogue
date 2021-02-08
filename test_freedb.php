<?php
// This code converts the databse table to json file for feeding to 
// the webpage

        $servername = 'freedb.tech';
        $username = 'freedbtech_nihar';
        $password = 'Pradhan@';
        $dbname = 'freedbtech_myDB';
        

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
	else {
        echo "Connection successful";
        }
        	
?>



