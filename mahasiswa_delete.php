<?php  
	require_once 'dbconnect.php';
	$nim = $_GET["nim"];
	$query = "DELETE FROM users WHERE nim=$nim";
	mysqli_query($conn, $query);
	header("Location:mahasiswa_index.php");
?>