<?php
/* own code starts */

include 'db_connect.php'; // Include database connection file

// SQL query to select relevant fields from parent_guardian table
$query = "SELECT 
            pg_fname, pg_lname, pg_phone, pg_email, relationship_to_pupil 
          FROM parent_guardian";

// Execute the query and store the result
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Set character encoding and page title -->
    <meta charset="UTF-8">
    <title>View Parents</title>
    <!-- Link to external stylesheet -->
    <link rel="stylesheet" href="display.css">
</head>
<body>

<div class="container">
    <!-- Page header -->
    <h2>Parent/Guardian Information</h2>

    <!-- Check if there are any results to display -->
    <?php if ($result->num_rows > 0): ?>
        <table>
            <!-- Table headers -->
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Relationship to Pupil</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through each row in the result set -->
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <!-- Display each field with HTML escaping -->
                        <td><?= htmlspecialchars($row['pg_fname']) ?></td>
                        <td><?= htmlspecialchars($row['pg_lname']) ?></td>
                        <td><?= htmlspecialchars($row['pg_phone']) ?></td>
                        <td><?= htmlspecialchars($row['pg_email']) ?></td>
                        <td><?= htmlspecialchars($row['relationship_to_pupil']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <!-- Message shown if no records found -->
        <p>No parent/guardian records found.</p>
    <?php endif; ?>
</div>

</body>
</html>

<?php
// Close the database connection
$conn->close();

/* own code ends */
?>
