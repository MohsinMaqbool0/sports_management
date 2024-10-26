<?php
// Assuming you have a database connection established
require('db_con.php');
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];



    // Validate form data (you may add more validation as needed)
    if($newPassword ==   $confirmPassword){
                session_start();
                // checking admin old password

                $profileQuery = mysqli_query($conn,"SELECT * FROM faculty WHERE id = '" . $_SESSION['valid-user'] . "' && passwd ='".$password."'");
                  $RESULT=mysqli_num_rows($profileQuery);
                          if($RESULT){
                          // Update the profile in the database
                          $updateQuery = "UPDATE faculty SET id = ?, email_id = ?, passwd = ? WHERE id = ?";

                          // Assuming you have a prepared statement
                          $stmt = $conn->prepare($updateQuery);

                          // Bind parameters
                          $stmt->bind_param("sssi", $username, $email, $newPassword,$_SESSION['valid-user']);

                          // Set the faculty ID (replace it with the actual faculty ID)
                          $facultyId = 1; // Replace with the actual faculty ID
                                        // Execute the query
                                        if ($stmt->execute()) {
                                            // Update successful
                                            session_start();
                                            $_SESSION['message-success'] = "Profile Updated successfully!";
                                            // Redirect back to the page
                                            header("Location: ../profile.php");
                                            exit();
                                        } else {
                                            // Update failed
                                            session_start();
                                            $_SESSION['message-fail'] = "Error: " . $stmt->error;
                                            header("Location: ../profile.php");
                                            exit();
                                        }
                        }// old password result closing brace

                    session_start();
                    $_SESSION['message-fail'] = "Old password does not match!";
                    header("Location: ../profile.php");
                    exit();
                  }
            else{
            session_start();
            $_SESSION['message-fail'] = "Confirm password & new password does not match!";
            header("Location: ../profile.php");
            exit();
          }
    $stmt->close();
  }
?>
