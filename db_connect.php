<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "st_alphonsus_primary_school";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
