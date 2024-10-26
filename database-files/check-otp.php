
<?php
require_once 'db_con.php';
session_start();
 $_POST['OTP_1'];
 $_POST['OTP_2'];
 $_POST['OTP_3'];
 $_POST['OTP_4'];
 $_POST['OTP_5'];
 $_POST['OTP_6'];
 $userID= $_POST['id'];


 $otp = $_POST['OTP_1'] . $_POST['OTP_2'] . $_POST['OTP_3'] . $_POST['OTP_4'] . $_POST['OTP_5'] . $_POST['OTP_6'];
  if (isset($_POST['btn'])) {
	 	 $otpConcatenated = $_POST['OTP_1'] . $_POST['OTP_2'] . $_POST['OTP_3'] . $_POST['OTP_4'] . $_POST['OTP_5'] . $_POST['OTP_6'];

     $records = mysqli_query($conn, "SELECT * FROM faculty WHERE id ='".$userID."'");
     $r = mysqli_fetch_array($records);


		 if ($r['otp'] == $otpConcatenated) {
          ?>

          <!DOCTYPE html>
          <html lang="en">

          <head>

            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <title>New Password</title>

            <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
            <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
            <link rel="stylesheet" href="../../../assets/vendors/jvectormap/jquery-jvectormap.css">
            <link rel="stylesheet" href="../../assets/vendors/flag-icon-css/css/flag-icon.min.css">
            <link rel="stylesheet" href="../assets/vendors/owl-carousel-2/owl.carousel.min.css">
            <link rel="stylesheet" href="../../assets/vendors/owl-carousel-2/owl.theme.default.min.css">
            <link rel="stylesheet" href="../assets/css/style.css">
            <link rel="shortcut icon" href="assets/images/favicon.png" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
              integrity="sha384-Z1JAd13uiNpqUf5IepilhAtMuHQJ4q/9pa1Px59+C+HDUWYbmOSlEXc2xlM+3HxK" crossorigin="anonymous">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



          </head>

          <body>

            <div class="container-scroller">


              <!-- Main Section Start -->
              <div class="container-fluid page-body-wrapper">
                <div class="main-panel">
                  <div class="content-wrapper">
                    <div class="col-lg-12 grid-margin stretch-card">
                      <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-8">
                              <h4 class="card-title">New Password</h4>
                              <?php

                              if (isset($_SESSION['error'])) {
                                echo '<p class="warning-message alert alert-danger m-4">' . $_SESSION['error'] . '</p>';
                                // Clear the error message from the session
                                unset($_SESSION['error']);
                              }
                              ?>
                            </div>
                            <div class="col-md-4">
                              <!-- error Message -->
                            </div>
                          </div>

                          <div class="row justify-content-center">
                            <div class="col-md-6 grid-margin stretch-card pt-4">
                              <div class="card">
                                <div class="card-body border border-white">
                                  <form class="forms-sample" action="update-password.php" method="post">


                                  <div class="form-group">
                                  <label for="Current Password">Enter New Password</label>
                                  <div class="input-group">
                                  <input type="hidden" name="user-id" value="<?php echo $userID ?>">
                                  </div>
                                  <div class="form-group pass_show">
                                                  <input type="password" value="" class="form-control bg-dark" placeholder="Enter New Password" name="password">
                                              </div>
                                  </div>
                                    <!-- <label>Current Password</label> -->

                                    <div class="text-center pt-4">
                                      <button type="submit" class="btn btn-primary me-2 flex align-items-center justify-content-center"
                                        style="padding: 1rem 2rem; font-size: 1rem; border: none;"><img class="mr-2"
                                          src='../assets/images/update.gif' alt='Delete Image'
                                          style='width: 20px; height: 20px;'>Update</button>
                                    </div>
                                  </form>

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Main Section End -->
                </div>

                <!-- JavaScript Password Hide/Unhide Start -->
                <script>
                          $(document).ready(function(){
                  $('.pass_show').append('<span class="ptxt">Show</span>');
                  });
                  $(document).on('click','.pass_show .ptxt', function(){
                  $(this).text($(this).text() == "Show" ? "Hide" : "Show");
                  $(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; });
                  });

                </script>

                <!-- JavaScript Password Hide/Unhide Ends  -->

                <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
                <script src="../assets/vendors/chart.js/Chart.min.js"></script>
                <script src="../assets/vendors/progressbar.js/progressbar.min.js"></script>
                <script src="../assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
                <script src="../assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
                <script src="../assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>

                <script src="../assets/js/off-canvas.js"></script>
                <script src="..//assets/js/hoverable-collapse.js"></script>
                <script src="../assets/js/misc.js"></script>
                <script src="../assets/js/settings.js"></script>
                <script src="../assets/js/todolist.js"></script>

                <script src="../assets/js/dashboard.js"></script>

          </body>

          </html>
          <style>
            .pass_show{position: relative}

          .pass_show .ptxt {
          position: absolute;
          top: 50%;
          right: 10px;
          z-index: 1;
          color: #fff;
          margin-top: -10px;
          cursor: pointer;
          transition: .3s ease all;
          }

          .pass_show .ptxt:hover{
            color: #116f7e;
          }
            </style>
		         <!-- header("location: ../new_password.php"); -->
             <?php
		     } else {
				  session_start();
				 	$_SESSION['error'] = "You have entered wrong password!";
				  header("location:../otp.php?id=" . $userID);
		     }
 }

?>
