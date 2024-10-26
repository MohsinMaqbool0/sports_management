<?php
	require_once 'db_con.php';
	if(isset($_POST['btn']))
	{

			$checkUser=mysqli_query($conn, "SELECT * from faculty where email_id='".$_POST['email']."' ");
			if ($checkUser === false) {
			// Query execution failed
				die("Error: " . mysqli_error($conn));
				session_start();
				$_SESSION['error'] = "Something wents wrong!";
				header("location:../forget_password.php");
			}
			// Fetch the user data
 			$verify = mysqli_fetch_array($checkUser);


       if ($verify)
	  {
         require 'PHPMailerAutoload.php';
         require('credential.php');
         $otp=rand(100000,900000);
         // echo $otp;
        $result=mysqli_query($conn, "Update faculty set otp='$otp' where id='$verify[id]' ");
        	if ($result==true) {

          $mail = new PHPMailer;

          // // $mail->SMTPDebug = 3;                               // Enable verbose debug output

          $mail->isSMTP();
          $mail->isSMTP(); // $mail->Body = $body; etc
          $mail->SMTPOptions = array(
              'ssl' => array(
                  'verify_peer' => false,
                  'verify_peer_name' => false,
                  'allow_self_signed' => true
              )
          );                               // Set mailer to use SMTP
          $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
          $mail->SMTPAuth = true;                               // Enable SMTP authentication
          $mail->Username = EMAIL;                 // SMTP username
          $mail->Password = PASS;                           // SMTP password
          $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
          $mail->Port = 587;                                    // TCP port to connect to

          $mail->setFrom(EMAIL, 'Sports Management ');
          $mail->addAddress($verify['email_id']);     // Add a recipient

          $mail->addReplyTo(EMAIL);
          $mail->isHTML(true);                                  // Set email format to HTML


           $subject = "Registration..!";

              $message = "<h3><b> Hello ".$verify['username']."</b><h3>";
              $message.="<h4> YOUR OTP<b> ".$otp."</b> Please dont share with anyone!<h4>";

          $mail->Subject = $subject;
          $mail->Body    = $message;
          $mail->AltBody = '';

          $mail->send();


           header("location: ../otp.php?id=" . $verify['id']);
       	}//result brace close


			}//verify brace close
   else
	 {
		 session_start();
		 $_SESSION['error'] = "Something wents wrong!";
		 header("location:../forget_password.php");
	 }


}
 ?>
