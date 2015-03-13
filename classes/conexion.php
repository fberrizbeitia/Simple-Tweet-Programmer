<?php 
//@session_start();

require("../config.php");

$conn = mysqli_connect($dbhost,$dbusr,$dbpass,$dbname);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

function closeConnection($conn){
	mysqli_close($conn);
}

?>