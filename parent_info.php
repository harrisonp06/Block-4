<!-- own code starts -->
<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get form data for parent/guardian
    $title = empty($_POST['title']) ? NULL : $_POST['title'];
    $firstName = empty($_POST['firstName']) ? NULL : $_POST['firstName'];
    $lastName = empty($_POST['lastName']) ? NULL : $_POST['lastName'];
    $address = empty($_POST['address']) ? NULL : $_POST['address'];
    $email = empty($_POST['email']) ? NULL : filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = empty($_POST['phone']) ? NULL : filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
    $dob = empty($_POST['dob']) ? NULL : $_POST['dob'];  // Make sure date format is correct
    $gender = empty($_POST['gender']) ? NULL : $_POST['gender'];
    $relationship = empty($_POST['relationship']) ? NULL : $_POST['relationship'];

    // Sanitize and get form data for pupil
    $pupilFirstName = empty($_POST['pupilFirstName']) ? NULL : $_POST['pupilFirstName'];
    $pupilLastName = empty($_POST['pupilLastName']) ? NULL : $_POST['pupilLastName'];
    $pupilAddress = empty($_POST['pupilAddress']) ? NULL : $_POST['pupilAddress'];
    $medicalInfo = empty($_POST['medicalInfo']) ? NULL : $_POST['medicalInfo'];
    $pupilDOB = empty($_POST['pupilDOB']) ? NULL : $_POST['pupilDOB'];  // Ensure proper date format
    $pupilGender = empty($_POST['pupilGender']) ? NULL : $_POST['pupilGender'];
    $admissionDate = empty($_POST['admissionDate']) ? NULL : $_POST['admissionDate'];

    // Get the selected year group from the form
    $yearGroup = empty($_POST['year-group']) ? NULL : $_POST['year-group'];

    // Map the selected year group to c_id
    switch ($yearGroup) {
        case "Reception":
            $c_id = 1;
            break;
        case "Year 1":
            $c_id = 2;
            break;
        case "Year 2":
            $c_id = 3;
            break;
        case "Year 3":
            $c_id = 4;
            break;
        case "Year 4":
            $c_id = 5;
            break;
        case "Year 5":
            $c_id = 6;
            break;
        case "Year 6":
            $c_id = 7;
            break;
        default:
            $c_id = NULL;
            break;
    }

    // Start a transaction
    $conn->begin_transaction();

    try {
        //Insert Parent/Guardian into `parent_guardian`
        $stmt1 = $conn->prepare("INSERT INTO parent_guardian (pg_title, pg_fname, pg_lname, pg_address, pg_email, pg_phone, pg_dob, pg_gender, relationship_to_pupil) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt1->bind_param("sssssssss", $title, $firstName, $lastName, $address, $email, $phone, $dob, $gender, $relationship);
        $stmt1->execute();
        $pg_id = $conn->insert_id; // Get the inserted parent ID
        $stmt1->close();

        //Insert Pupil into `pupil` (including c_id)
        $stmt2 = $conn->prepare("INSERT INTO pupil (p_fname, p_lname, p_address, medical_info, p_dob, p_gender, admission_date, c_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt2->bind_param("sssssssi", $pupilFirstName, $pupilLastName, $pupilAddress, $medicalInfo, $pupilDOB, $pupilGender, $admissionDate, $c_id);

        $stmt2->execute();
        $pupil_id = $conn->insert_id; // Get the inserted pupil ID
        $stmt2->close();

        //Insert into `pupil_parent` junction table
        $stmt3 = $conn->prepare("INSERT INTO pupil_parent (pg_id, p_id) VALUES (?, ?)");
        $stmt3->bind_param("ii", $pg_id, $pupil_id);
        $stmt3->execute();
        $stmt3->close();

        //Commit the transaction
        $conn->commit();

        echo "Pupil and Parent information submitted successfully!";
    } catch (Exception $e) {
        $conn->rollback(); // Undo all changes if an error occurs
        echo "An error occurred: " . $e->getMessage();
    }
    
}

// Close connection
$conn->close();
?>
<!-- own code ends -->
