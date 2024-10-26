<?php
// Assuming you have a database connection established
require('db_con.php');
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data

    $user_id = $_POST['user-id'];
    $password = $_POST['password'];

                    // Update the profile in the database
                    $updateQuery = mysqli_query($conn,"UPDATE faculty SET passwd = '".$password."' WHERE id ='".$user_id."'");

                      	if ($updateQuery==true) {
                                  // Update successful
                                    session_start();
                                    unset($_SESSION['user-id']);
                                   // Redirect back to the page
                                    header("Location: ../thankyou.php");
                                    exit();
                                  } else {
                                    // Update failed
                                  session_start();
                                  $_SESSION['error'] = "Something went wrong";
                                  header("Location: ../new_password.php");
                                  exit();
                        }


  }
?>
