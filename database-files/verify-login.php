<?php

require('db_con.php');

    $username = $_POST['username'];
    $passwd = $_POST['password'];

         // verifying username from database
        $verify_user=mysqli_query($conn, "SELECT * from faculty where username='".$username."'");
         $verified_user=mysqli_num_rows($verify_user);

          if($verified_user==1){

             // verifying password from database
            $verify_password=mysqli_query($conn, "SELECT * from faculty where passwd='".$passwd."'");
              $verified=mysqli_num_rows($verify_password);
                            $row = mysqli_fetch_array($verify_user);
                            $userid=$row['id'];
                            if($verified==1){
                              // Redirect on success
                              //SESSION START
                               session_start();
                               $_SESSION['valid-user']=$userid;
                               header('location:../dashboard.php');
                            }
                            else{
                              session_start();
                              $_SESSION['login-error'] = "Wrong password.";
                              header('location:../index.php');
                              exit();
                            }
          }
          else{
              session_start();
              $_SESSION['login-error'] = "Invalid Username or Password.";
              header('location:../index.php');
              exit();
          }


 ?>
