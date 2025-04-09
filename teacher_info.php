<?php
// own code starts
include 'db_connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form data
    $title = empty($_POST['title']) ? NULL : $_POST['title'];
    $firstName = $_POST['firstName'];
    $lastName = empty($_POST['lastName']) ? NULL : $_POST['lastName']; // Set to NULL if empty
    $address = empty($_POST['address']) ? NULL : $_POST['address'];
    $phone = empty($_POST['phone']) ? NULL : $_POST['phone'];
    $dob = empty($_POST['dob']) ? NULL : $_POST['dob'];
    $gender = empty($_POST['gender']) ? NULL : $_POST['gender'];
    $email = empty($_POST['email']) ? NULL : $_POST['email'];
    $subject = empty($_POST['subject']) ? NULL : $_POST['subject'];

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO teacher (t_title, t_fname, t_lname, t_address, t_phone, t_dob, t_gender, t_email, subject) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind the parameters (no need to bind salary and background check as they are NULL by default)
    $stmt->bind_param("sssssssss", $title, $firstName, $lastName, $address, $phone, $dob, $gender, $email, $subject);

    // Execute the query
    if ($stmt->execute()) {
        echo "Teacher information submitted successfully!";
    } else {
        // Log the error to a log file
        $error_message = "Error: " . $stmt->error;
        error_log($error_message, 3, "error_log.txt");  // Logs the error in 'error_log.txt'

        // Optionally, you can display a generic error message to the user
        echo "An error occurred. Please try again later.";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();

error_reporting(E_ALL);
ini_set('display_errors', 1);


//own code ends
?>

