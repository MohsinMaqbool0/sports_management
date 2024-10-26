<?php
// Assuming you have a db_con.php file for database connection
require('db_con.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sFirstName = $_POST["sFirstName"];
    $sLastName = $_POST["sLastName"];
    $sRollNo = $_POST["sRollNo"];
    $sStream = $_POST["sStream"];
    $sSemester = $_POST["sSemester"];
    $sBatch = $_POST["sBatch"];
    $sStudentReg = $_POST["sStudentReg"];
    $sPhoneNo = $_POST["sPhoneNo"];

    // Check if the student registration already exists
    $checkQuery = "SELECT COUNT(*) AS count FROM c_student WHERE s_student_reg = '$sStudentReg'";
    $result = $conn->query($checkQuery);

    if ($result) {
        $row = $result->fetch_assoc();
        $count = $row['count'];

        if ($count > 0) {
            // Student registration already exists, redirect with an error message
            session_start();
            $_SESSION['message-fail'] = "Student with registration number '$sStudentReg' already exists. Please use a different registration number.";
            header("Location: ../register-student.php");
            exit();
        } else {
            // Student registration is unique, proceed with insertion
            $sql = "INSERT INTO c_student (s_first_name, s_last_name, s_roll_no, s_stream, s_semester, s_batch, s_student_reg, s_phone_no)
                    VALUES ('$sFirstName', '$sLastName', '$sRollNo', '$sStream', '$sSemester', '$sBatch', '$sStudentReg', '$sPhoneNo')";

            if ($conn->query($sql) === TRUE) {
                // Redirect on success
                session_start();
                $_SESSION['message-success'] = "Record inserted successfully";
                header("Location: ../register-student.php");
                exit();
            } else {
                // Error in inserting data
                session_start();
                $_SESSION['message-fail'] = "Error: " . $sql . "<br>" . $conn->error;
                header("Location: ../register-student.php");
                exit();
            }
        }
    } else {
        // Error in the database query
        session_start();
        $_SESSION['message-fail'] = "Error checking student registration number.";
        header("Location: ../register-student.php");
        exit();
    }
}

// Close the database connection
$conn->close();
?>
