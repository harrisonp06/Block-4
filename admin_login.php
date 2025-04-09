<?php
// own code starts

include 'db_connect.php'; // Include the file to connect to the database

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check if the form was submitted

    $username = $_POST['username']; // Get the username from the form
    $entered_password = $_POST['password']; // Get the password from the form

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?"); // Prepare SQL statement to find the admin
    $stmt->bind_param("s", $username); // Bind the username to the query
    $stmt->execute(); // Execute the query
    $result = $stmt->get_result(); // Get the result set

    if ($result->num_rows > 0) { // If a user was found
        $admin = $result->fetch_assoc(); // Fetch user data as an associative array

        if (password_verify($entered_password, $admin['password'])) { // Check if entered password matches hashed one
            session_start(); // Start a new session
            $_SESSION['username'] = $username; // Store the username in the session
            header('Location: admin.html'); // Redirect to the admin dashboard
            exit(); // Ensure no further code runs after redirect
        } else {
            echo "Invalid password."; // Show error if password doesn't match
        }

    } else {
        echo "Invalid username."; // Show error if no matching user is found
    }

    $stmt->close(); // Close the prepared statement
}

$conn->close(); // Close the database connection

// own code ends
?>
