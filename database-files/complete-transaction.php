<?php
require_once 'db_con.php';
      if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['condition'])) {

            $transactionID = $_POST['transaction_id'];
            $checkInnerData = "SELECT ce.e_serail_id
                         FROM c_transaction_cart ctc
                         INNER JOIN c_equipment ce ON ctc.c_equipment_id = ce.e_id
                         WHERE ctc.c_transaction_id ='".$transactionID."' AND ctc.c_return_date IS NULL ";

            $innerResult = $conn->query($checkInnerData);

            if ($innerResult->num_rows > 0) {
            $getStudentID =mysqli_query($conn,"SELECT t_student_id FROM c_transaction WHERE t_id='".$transactionID."'");

            $RESULT=mysqli_num_rows($getStudentID);
            if($RESULT){
              $row = mysqli_fetch_assoc($getStudentID);
              $studentID = $row['t_student_id'];
              // Unset the session variable after processing the form
              $flagUpdate = "UPDATE c_transaction set flag='ASSIGNED' WHERE t_id='".$transactionID."'";
              $flagResult = $conn->query($flagUpdate);

              $flagUpdateStudent = "UPDATE c_student set flag='3' WHERE s_id='".$studentID."'";
              $flagStudentID = $conn->query($flagUpdateStudent);

                session_start();
                $_SESSION['message-success'] = "Equipments Assigend !";
                header("Location: ../dashboard.php");
                unset($_SESSION['transaction-id']);
                exit();
            }
            session_start();
            $_SESSION['message-fail'] = "Something went wrong !";
            header("Location: ../assign-equipment.php");

            exit();


      }
      else{
        session_start();
        $_SESSION['message-fail'] = "Studend have 0 equipment assigned!";
        header("Location: ../assign-equipment.php");
      }
  }//REQUEST_METHOD Closing brace


?>
