<?php
// Assuming you have a db_con.php file for database connection
require('db_con.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the student ID from the form
    $studentID = $_POST["studentID"];

    // Delete the student record from the database
    $deleteQuery = "DELETE FROM c_student WHERE s_id = '$studentID' AND flag='0'";

    // Execute the query
    $result = mysqli_query($conn, $deleteQuery);

    if (!$result) {
        // Error in query execution
        die("Error: " . mysqli_error($conn));
    }

    // Check if any rows were affected
    $affectedRows = mysqli_affected_rows($conn);

    if ($affectedRows > 0) {
        // Record deleted successfully
        session_start();
        $_SESSION['message-success'] = "Student record deleted successfully";
        header("Location: ../view-students.php");
        exit();
    } else {
        // No rows affected, student not found or other issues
        session_start();
        $_SESSION['message-fail'] = "Error deleting student record: Student not found or equipments are pending.";
        header("Location: ../view-students.php");
        exit();
    }
}

// Close the database connection
$conn->close();
?>
