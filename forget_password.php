<?php
// ob_start();



?>

<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Forget Page</title>

  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="shortcut icon" href="assets/images/favicon.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    integrity="sha384-Z1JAd13uiNpqUf5IepilhAtMuHQJ4q/9pa1Px59+C+HDUWYbmOSlEXc2xlM+3HxK" crossorigin="anonymous">

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
                    <h4 class="card-title">Forget Password</h4>
                    <?php
                    session_start();
                    if (isset($_SESSION['error'])) {
                      echo '<p class="warning-message alert alert-danger m-4">' . $_SESSION['error'] . '</p>';
                      // Clear the error message from the session
                      unset($_SESSION['error']);
                    }
                    ?>
                  </div>
                  <div class="col-md-4">
                    <!-- error message -->
                  </div>
                </div>

                <div class="row justify-content-center">
                  <div class="col-md-6 grid-margin stretch-card pt-4">
                    <div class="card">
                      <div class="card-body border border-white">
                        <form class="forms-sample" action="./database-files/forget-password.php" method="post">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control bg-dark" name="email" id="exampleInputEmail1"
                              placeholder="Enter Email Address" value="" Required autocomplete="off">
                          </div>


                          <div class="text-center pt-4 d-flex align-items-center justify-content-center">
                            <button type="submit" name="btn"
                              class="btn btn-primary me-2 d-flex align-items-center justify-content-center"
                              style="padding: 1rem 2rem; font-size: 1rem; border: none;">Send OTP<img
                                src='assets/images/sendotp.gif' alt='Send otp'
                                style='width: 20px; height: 20px; margin-left: 0.5rem;'></button>
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
    </div>

    <!-- JavaScript Password Hide/Unhide Start -->

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>

    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>

    <script src="assets/js/dashboard.js"></script>

</body>

</html>