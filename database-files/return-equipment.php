<?php
// Include your database connection file (db_con.php) at the beginning
require_once 'db_con.php';
// Get the date; this is the predefined function in PHP
$date = date('Y-m-d');

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // Get the form data
    $transactionId = $_POST['transactionID'];
    $studentId = $_POST['studentID'];
    $returnDate = $date;

  //   $checkRecordEquipment = "SELECT t_id FROM c_transaction WHERE t_id ='".$transactionId."'  ";
  // echo $checkRecordEquipment;
    $getData ="SELECT * FROM c_transaction_cart WHERE c_transaction_id ='".$transactionId."' ";
  // echo $getData;
    // dd();
    $result = $conn->query($getData);
    if ($result) {
        $rowCount = mysqli_num_rows($result);

        if ($rowCount > 0) {
            // Fetch data
            while ($row = $result->fetch_assoc()) {
                // Process each row of data
                // Prepare a SQL statement to update the record in the database
                $sqlUpdateTransaction = mysqli_query($conn,"UPDATE c_transaction_cart SET c_return_date ='".$returnDate."'  WHERE c_transaction_id ='".$transactionId."'");

                    // Execute the prepared statement
                    if ($sqlUpdateTransaction) {
                      //restore equipment quantity data
                       $equipmentData = "UPDATE c_equipment set flag='0' WHERE e_id='".$row['c_equipment_id']."'";
                       $resultRestore = $conn->query($equipmentData);
                    } else {
                        // Error updating record
                        session_start();
                        $_SESSION['message-fail'] = "Error: " . $stmt->error;
                        header("Location: ../dashboard.php");
                        exit();
                    }
            }

            $flagUpdate = "UPDATE c_transaction set flag='COMPLETED' WHERE t_id='".$transactionId."'";
            $flagResult = $conn->query($flagUpdate);
            $flagUpdateStudent = "UPDATE c_student set flag='0' WHERE s_id='".$studentId."'";
            $flagStudentID = $conn->query($flagUpdateStudent);

              session_start();
              $_SESSION['message-success'] = "Transaction Complete!";
              header("Location: ../equipments-retrieved.php");
              exit();
        } else {
            // No rows found
            echo "No rows found.";
        }
    } else {
        // Query execution failed
        echo "Error: " . $conn->error;
    }
    // Close the prepared statement
    $stmt->close();
} else {
    // Invalid form submission
    echo "Invalid form submission";
}
?>
