<?php

try{
		$dbname = "dbname";
		$username = "dbuser";
    $password = "dbpw";
    $servername = "localhost";
		

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
			exit();
		}else{
		    echo "connection good";
		}
		
}catch (exception $e) {
  //do nothing
}
finally {
  //optional code that always runs
}
