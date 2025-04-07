<?php
include 'db_connect.php';

// Query to get all parent/guardian information
$query = "SELECT 
            pg_fname, pg_lname, pg_phone, pg_email, relationship_to_pupil 
          FROM parent_guardian";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Parents</title>
    <link rel="stylesheet" href="display.css">
</head>
<body>

<div class="container">
    <h2>Parent/Guardian Information</h2>

    <?php if ($result->num_rows > 0): ?>
        <table>
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
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
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
        <p>No parent/guardian records found.</p>
    <?php endif; ?>

</div>

</body>
</html>

<?php
$conn->close();
?>
