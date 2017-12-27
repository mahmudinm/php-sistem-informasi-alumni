<?php

$db_host = "localhost";
$db_name = "sistem_informasi_alumni";
$db_user = "root";
$db_pass = "";

$pathUpload = "c:/xampp/htdocs/webProgramming/sistemInformasiAlumni/upload/";
$pathUrl = "http://localhost/webProgramming/sistemInformasiAlumni/";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

