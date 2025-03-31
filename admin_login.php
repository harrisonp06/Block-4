<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST['username'];
    $entered_password = $_POST['password'];

    // Prepare a query to check if the username exists
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc(); // Get the user data
        // Verify the password
        if (password_verify($entered_password, $admin['password'])) {
            echo "Login successful!";
            // You can set a session here to track logged-in users, for example:
            session_start();
            $_SESSION['username'] = $username;
            header('Location: admin.html'); // Redirect to admin dashboard
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Invalid username.";
    }

    $stmt->close();
}

$conn->close();
?>
