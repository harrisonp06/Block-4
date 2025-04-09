<?php
/* own code starts */

include 'db_connect.php'; // Include the file for database connection

// SQL query to fetch student details and their year group via a LEFT JOIN with the classes table
$query = "SELECT 
            p.p_fname, p.p_lname, p.p_address, p.medical_info, 
            p.p_dob, p.p_gender, p.admission_date,
            c.year_group
          FROM pupil p
          LEFT JOIN classes c ON p.c_id = c.c_id";

// Execute the query and store the result
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic page setup with meta tags and linked stylesheet -->
    <meta charset="UTF-8">
    <title>View Students</title>
    <link rel="stylesheet" href="display.css">
</head>
<body>

<div class="container">
    <!-- Page title for the student information view -->
    <h2>Student Information</h2>

    <!-- If student records exist, display them in a table -->
    <?php if ($result->num_rows > 0): ?>
        <table>
            <!-- Table headers -->
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Address</th>
                    <th>Medical Info</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Admission Date</th>
                    <th>Year Group</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through each row and output sanitized data -->
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['p_fname']) ?></td>
                        <td><?= htmlspecialchars($row['p_lname']) ?></td>
                        <td><?= htmlspecialchars($row['p_address']) ?></td>
                        <td><?= htmlspecialchars($row['medical_info']) ?></td>
                        <td><?= htmlspecialchars($row['p_dob']) ?></td>
                        <td><?= htmlspecialchars($row['p_gender']) ?></td>
                        <td><?= htmlspecialchars($row['admission_date']) ?></td>
                        <td><?= htmlspecialchars($row['year_group']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <!-- Message if no student records are found -->
        <p>No student records found.</p>
    <?php endif; ?>

</div>

</body>
</html>

<?php
// Close the database connection
$conn->close();

/* own code ends */
?>
