<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get form data for parent/guardian
    $title = empty($_POST['title']) ? NULL : $_POST['title'];
    $firstName = empty($_POST['firstName']) ? NULL : $_POST['firstName'];
    $lastName = empty($_POST['lastName']) ? NULL : $_POST['lastName'];
    $address = empty($_POST['address']) ? NULL : $_POST['address'];
    $email = empty($_POST['email']) ? NULL : $_POST['email'];
    $phone = empty($_POST['phone']) ? NULL : $_POST['phone'];
    $dob = empty($_POST['dob']) ? NULL : $_POST['dob'];
    $gender = empty($_POST['gender']) ? NULL : $_POST['gender'];
    $relationship = empty($_POST['relationship']) ? NULL : $_POST['relationship'];

    // Sanitize and get form data for pupil
    $pupilFirstName = empty($_POST['pupilFirstName']) ? NULL : $_POST['pupilFirstName'];
    $pupilLastName = empty($_POST['pupilLastName']) ? NULL : $_POST['pupilLastName'];
    $pupilAddress = empty($_POST['pupilAddress']) ? NULL : $_POST['pupilAddress'];
    $medicalInfo = empty($_POST['medicalInfo']) ? NULL : $_POST['medicalInfo'];
    $pupilDOB = empty($_POST['pupilDOB']) ? NULL : $_POST['pupilDOB'];
    $pupilGender = empty($_POST['pupilGender']) ? NULL : $_POST['pupilGender'];
    $admissionDate = empty($_POST['admissionDate']) ? NULL : $_POST['admissionDate'];

    // Start a transaction
    $conn->begin_transaction();

    try {
        // 1. Insert Parent/Guardian into `parent_guardian`
        $stmt1 = $conn->prepare("INSERT INTO parent_guardian (pg_title, pg_fname, pg_lname, pg_address, pg_email, pg_phone, pg_dob, pg_gender, relationship_to_pupil) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt1->bind_param("sssssssss", $title, $firstName, $lastName, $address, $email, $phone, $dob, $gender, $relationship);
        $stmt1->execute();
        $pg_id = $conn->insert_id; // Get the inserted parent ID
        $stmt1->close();

        // 2. Insert Pupil into `pupil`
        $stmt2 = $conn->prepare("INSERT INTO pupil (p_fname, p_lname, p_address, medical_info, p_dob, p_gender, admission_date) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt2->bind_param("sssssss", $pupilFirstName, $pupilLastName, $pupilAddress, $medicalInfo, $pupilDOB, $pupilGender, $admissionDate);

        $stmt2->execute();
        $pupil_id = $conn->insert_id; // Get the inserted pupil ID
        $stmt2->close();

        // 3. Insert into `pupil_parent` junction table
        $stmt3 = $conn->prepare("INSERT INTO pupil_parent (pg_id, p_id) VALUES (?, ?)");
        $stmt3->bind_param("ii", $pg_id, $pupil_id);
        $stmt3->execute();
        $stmt3->close();

        // Commit the transaction
        $conn->commit();

        echo "Pupil and Parent information submitted successfully!";
    } catch (Exception $e) {
        $conn->rollback(); // Undo all changes
        echo "An error occurred: " . $e->getMessage();
    }
    
}

// Close connection
$conn->close();
?>
