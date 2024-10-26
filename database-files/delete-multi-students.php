<?php
// Assuming you have a db_con.php file for database connection
require('db_con.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['selectedStudents']) && is_array($_POST['selectedStudents'])) {
        // Retrieve selected student IDs
        $selectedStudents = $_POST['selectedStudents'];

        // Delete the selected student records from the database
        $deleteQuery = "DELETE FROM c_student WHERE s_id IN ('" . implode("','", $selectedStudents) . "') AND flag='0'";

        // Execute the query
        $result = mysqli_query($conn, $deleteQuery);

        if (!$result) {
            // Error in query execution
            die("Error: " . mysqli_error($conn));
        }

        // Check if any rows were affected
        $affectedRows = mysqli_affected_rows($conn);

        if ($affectedRows > 0) {
            // Records deleted successfully
            session_start();
            $_SESSION['message-success'] = "Selected student records deleted successfully";
            header("Location: ../view-students.php");
            exit();
        } else {
            // No rows affected, students not found or other issues
            session_start();
            $_SESSION['message-fail'] = "Error deleting selected student records: Students not found or equipments are pending";
            header("Location: ../view-students.php");
            exit();
        }
    }
}

// Close the database connection
$conn->close();
?>
