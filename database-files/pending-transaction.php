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
             unset($_SESSION['transaction-id']);
            // verifying student ID from database
           $verify_student=mysqli_query($conn, "SELECT * from c_student where s_id='".$studentId."'");
           $verified_student=mysqli_num_rows($verify_student);

           if($verified_student){



                //GET transaction ID of student assigned Equipments
                 $sqlGetIDTransaction = "SELECT t_id FROM c_transaction WHERE t_student_id ='" . $studentId . "' AND flag='PENDING' ";
                 // Execute the query
                 $resultID = $conn->query($sqlGetIDTransaction);
                 $row = $resultID->fetch_assoc();
                 session_start();
                 $_SESSION['transaction-id'] = $row['t_id'];

                 header("Location: ../assign-equipment.php");


           }
           else{
             session_start();
             $_SESSION['message-fail'] = "Student Not Found!";

             // Redirect back to the page
             header("Location: ../user-equipment.php");
             exit();
           }
        }

}
// Close the database connection
$conn->close();
?>
