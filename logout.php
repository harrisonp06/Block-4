<?php
//own code starts
session_start();
session_destroy(); // Destroy the session
header("Location: index.html"); // Redirect to the login page
exit();
//own code ends
?>