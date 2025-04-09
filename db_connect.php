<?php
//own code starts
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "st_alphonsus";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//own code ends
?>
