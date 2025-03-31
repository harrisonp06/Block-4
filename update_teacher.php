<?php
include 'db_connect.php';
session_start();

// Protect page from unauthorized access
if (!isset($_SESSION['username'])) {
    header("Location: admin_login.html");
    exit();
}

// Fetch teachers for the dropdown
$sql_teachers = "SELECT t_id, t_fname, t_lname FROM teacher";
$teachers_result = $conn->query($sql_teachers);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $teacher_id = $_POST['teacher_id'];
    $salary = $_POST['salary'];
    $background_check = $_POST['background_check'];
    $hire_date = $_POST['hire_date'];

    // Update the existing teacher's record
    $sql_update = "UPDATE teacher 
                   SET salary = ?, background_check = ?, hire_date = ?
                   WHERE t_id = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("issi", $salary, $background_check, $hire_date, $teacher_id);

    if ($stmt->execute()) {
        echo "Teacher record updated successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $stmt->close();
}

// Fetch teacher info if one is selected
$teacher_info = null;
if (isset($_GET['teacher_id'])) {
    $teacher_id = $_GET['teacher_id'];
    $sql_teacher = "SELECT * FROM teacher WHERE t_id = ?";
    $stmt = $conn->prepare($sql_teacher);
    $stmt->bind_param("i", $teacher_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $teacher_info = $result->fetch_assoc();
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Teacher Information</title>
    <link rel="stylesheet" href="teacher_update.css">
</head>
<body>

    <h2>Update Teacher Information</h2>

    <form method="POST" action="">
        <label for="teacher_id">Select Teacher:</label>
        <select name="teacher_id" id="teacher_id" required>
            <option value="">Select a Teacher</option>
            <?php
            while ($row = $teachers_result->fetch_assoc()) {
                $selected = isset($teacher_info) && $teacher_info['t_id'] == $row['t_id'] ? 'selected' : '';
                echo "<option value='{$row['t_id']}' $selected>{$row['t_lname']}, {$row['t_fname']}</option>";
            }
            ?>
        </select><br><br>

        <label for="salary">Salary:</label>
        <input type="number" id="salary" name="salary" value="<?php echo isset($teacher_info) ? $teacher_info['salary'] : ''; ?>" required><br><br>

        <label for="background_check">Background Check:</label>
        <select name="background_check" id="background_check" required>
            <option value="1" <?php echo isset($teacher_info) && $teacher_info['background_check'] == 1 ? 'selected' : ''; ?>>Yes</option>
            <option value="0" <?php echo isset($teacher_info) && $teacher_info['background_check'] == 0 ? 'selected' : ''; ?>>No</option>
        </select><br><br>

        <label for="hire_date">Hire Date:</label>
        <input type="date" id="hire_date" name="hire_date" value="<?php echo isset($teacher_info) ? $teacher_info['hire_date'] : ''; ?>" required><br><br>

        <input type="submit" name="submit" value="Update Teacher">
    </form>

</body>
</html>

<?php
$conn->close();
?>
