<?php
require_once 'db_con.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form is submitted

    // Get the data
    $equipmentId = $_POST['serial_id'];
    $condition = $_POST['condition'];
    $transactionID = $_POST['transaction_id'];

    // Get the current date
    $startDate = date('Y-m-d');

    // Prepare a SQL statement
    $sqlInsertCart = "INSERT INTO c_transaction_cart (c_equipment_id, c_initail_status, c_start_date,c_transaction_id) VALUES (?, ?, ?, ?)";

    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare($sqlInsertCart);

    // Bind parameters
    $stmt->bind_param("sssi", $equipmentId, $condition, $startDate,$transactionID);

    // Execute the prepared statement
    if ($stmt->execute()) {
      //update equipment flag
       $equipmentData = "UPDATE c_equipment set flag='1' WHERE e_id='".$equipmentId."'";

       $flagData = $conn->query($equipmentData);

      session_start();
      $_SESSION['message-success'] = "Equipment assigned to student!";
      // Redirect back to the page
      header("Location: ../assign-equipment.php");
      exit();
    } else {
      session_start();
      $_SESSION['message-fail'] =  "Error: " . $stmt->error;

      // Redirect back to the page
      header("Location: ../assign-equipment.php");
      exit();

    }

    // Close the prepared statement
    $stmt->close();

    // Close the database connection
    $conn->close();
}
?>
