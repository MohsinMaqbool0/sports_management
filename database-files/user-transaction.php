<?php
require_once 'db_con.php';

// Get the date; this is the predefined function in PHP
$date = date('Y-m-d');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form is submitted


        // Get the selected student ID
        $studentId = $_POST['student_id'];

        // Validate if values are not empty or null
        if (empty($studentId)) {
            // Set an error message
            session_start();
            $_SESSION['message-fail'] = "Error: Id is invalid";

            // Redirect back to the page
            header("Location: ../user-equipment.php");
            exit();
        }
        else{
            // verifying student ID from database
           $verify_student=mysqli_query($conn, "SELECT * from c_student where s_id='".$studentId."'");
           $verified_student=mysqli_num_rows($verify_student);
           if($verified_student){
             // $registerDate = $date;

             // Serialize the array before storing it in the database
             // $serializedEquipmentIds = implode(',', $equipmentIds);

             // Prepare a SQL statement
             $sqlInsertTransaction = "INSERT INTO c_transaction (t_student_id) VALUES (?)";

             // Use a prepared statement to prevent SQL injection
             $stmt = $conn->prepare($sqlInsertTransaction);

             // Bind parameters
             $stmt->bind_param("i", $studentId);

             // Execute the prepared statement
             $success = $stmt->execute();

             // Close the prepared statement
             $stmt->close();
             unset($_SESSION['transaction-id']);
             // Check the success status and redirect accordingly
             if ($success) {
                //GET transaction ID of student assigned Equipments
                 $sqlGetIDTransaction = "SELECT t_id FROM c_transaction WHERE t_student_id ='" . $studentId . "' AND flag='PENDING' ";
                 // Execute the query
                 $resultID = $conn->query($sqlGetIDTransaction);
                 $row = $resultID->fetch_assoc();
                 session_start();
                 $_SESSION['transaction-id'] = $row['t_id'];
                  // Update the student's flag directly in the SQL query
                 $sqlUpdateStudent = "UPDATE c_student SET flag='1' WHERE s_id = '" . $studentId . "'";

                 // Execute the query
                 if (mysqli_query($conn, $sqlUpdateStudent)) {
                     // Success
                     echo "Flag updated successfully in c_student.";
                 } else {
                     // Error
                     echo "Error: " . mysqli_error($conn);
                 }
                 header("Location: ../assign-equipment.php");

             } else {
                 session_start();
                 $_SESSION['message-fail'] = "Error: " . $stmt->error;
                 header("Location: ../user-transaction.php");
                 exit();
             }

           }
           else{
             session_start();
             $_SESSION['message-fail'] = "Student Not Found!";

             // Redirect back to the page
             header("Location: ../user-equipment.php");
             exit();
           }
        }


    //  else {
    //     echo "Please select at least one equipment and a student.";
    // }

}
// Close the database connection
$conn->close();
?>
