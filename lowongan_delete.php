<?php  
	require_once 'dbconnect.php';
	$id = $_GET["id"];
	$query = "DELETE FROM lowongan WHERE id=$id";
	mysqli_query($conn, $query);
	header("Location:lowongan_index.php");
?>