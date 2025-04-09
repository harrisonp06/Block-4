<?php
//own code starts
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
include 'db_connect.php';

// Fetch list of teachers for the dropdown
$sql_teachers = "SELECT t_id, t_fname, t_lname FROM teacher";
$teachers_result = $conn->query($sql_teachers);

// Fetch the list of year groups (for dropdown) — could be hardcoded or fetched from the database
$year_groups = ["Reception", "Year 1", "Year 2", "Year 3", "Year 4", "Year 5", "Year 6"];

// If form is submitted, update the existing class with the new data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Get the form data
    $year_group = $_POST['year_group'];
    $class_name = $_POST['c_name'];
    $teacher_id = $_POST['teacher_id'];  // Teacher ID selected by the admin (t_id)
    $capacity = $_POST['capacity'];

    // SQL to update the class based on the selected year_group
    $sql_update = "UPDATE classes 
                   SET c_name = '$class_name', t_id = '$teacher_id', capacity = '$capacity'
                   WHERE year_group = '$year_group'";

    if ($conn->query($sql_update) === TRUE) {
        echo "<p class='success-message'>Class updated successfully!</p>";
    } else {
        echo "<p class='error-message'>Error: " . $sql_update . "<br>" . $conn->error . "</p>";
    }
}

// Fetch the existing class info based on the selected year group
$class_info = null;
if (isset($_GET['year_group'])) {
    $year_group = $_GET['year_group'];

    $sql_class = "SELECT * FROM classes WHERE year_group = '$year_group'";
    $class_result = $conn->query($sql_class);
    
    if ($class_result->num_rows > 0) {
        $class_info = $class_result->fetch_assoc();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Update Class</title>
    <link rel="stylesheet" href="classes.css">
</head>
<body>

    <h2>Admin - Update Class</h2>

    <!-- Form to Update Existing Class -->
    <h3>Update Class Information</h3>
    <form method="POST" action="">
        <label for="year_group">Select Year Group:</label>
        <select name="year_group" id="year_group" required>
            <option value="">Select Year Group</option>
            <?php
            // Display year groups in the dropdown
            foreach ($year_groups as $year) {
                echo "<option value='" . $year . "'" . (isset($class_info) && $class_info['year_group'] == $year ? ' selected' : '') . ">" . $year . "</option>";
            }
            ?>
        </select><br><br>

        <label for="c_name">Class Name:</label>
        <input type="text" id="c_name" name="c_name" value="<?php echo isset($class_info) ? $class_info['c_name'] : ''; ?>" required><br><br>

        <label for="teacher_id">Select Teacher:</label>
        <select name="teacher_id" id="teacher_id" required>
            <option value="">Select a Teacher</option>
            <?php
            // Display the teacher options (concatenating first and last names)
            if ($teachers_result->num_rows > 0) {
                while ($row = $teachers_result->fetch_assoc()) {
                    $selected = (isset($class_info) && $class_info['t_id'] == $row['t_id']) ? 'selected' : '';
                    echo "<option value='" . $row['t_id'] . "' $selected>" . $row['t_fname'] . " " . $row['t_lname'] . "</option>";
                }
            } else {
                echo "<option>No teachers available</option>";
            }
            ?>
        </select><br><br>

        <label for="capacity">Capacity:</label>
        <input type="number" id="capacity" name="capacity" value="<?php echo isset($class_info) ? $class_info['capacity'] : ''; ?>" required><br><br>

        <input type="submit" name="submit" value="Update Class">
    </form>

    <!-- Display the table of classes -->
    <h3>Classes List</h3>
    <table>
        <thead>
            <tr>
                <th>Year Group</th>
                <th>Class Name</th>
                <th>Teacher</th>
                <th>Capacity</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // SQL to fetch all classes excluding c_id
            $sql_classes = "SELECT c.year_group, c.c_name, t.t_fname, t.t_lname, c.capacity
                            FROM classes c
                            JOIN teacher t ON c.t_id = t.t_id";
            $classes_result = $conn->query($sql_classes);
            
            // Display the classes in the table
            if ($classes_result->num_rows > 0) {
                while ($row = $classes_result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['year_group'] . "</td>
                            <td>" . $row['c_name'] . "</td>
                            <td>" . $row['t_fname'] . " " . $row['t_lname'] . "</td>
                            <td>" . $row['capacity'] . "</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No classes found</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>

<?php
// Close the database connection
$conn->close();

//own code ends
?>
