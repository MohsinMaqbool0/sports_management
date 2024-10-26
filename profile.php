<?php
ob_start();



?>

<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Profile</title>

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

    <!-- Header & Sidebar Section Start -->
    <?php
    include 'header.php';
    include 'sidebar.php';
    // Assuming you have a db_con.php file for database connection
    require('./database-files/db_con.php');
    // Fetch user profile data
    $profileQuery = "SELECT * FROM faculty WHERE id = '" . $_SESSION['valid-user'] . "'";
    $profileResult = $conn->query($profileQuery);

    if ($profileResult->num_rows > 0) {
      // Fetch user data
      $profileData = $profileResult->fetch_assoc();
    }

    ?>
    <!-- Header & Sidebar Section End -->

    <!-- Main Section Start -->
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <h4 class="card-title">Profile</h4>
                  </div>
                  <div class="col-md-6">
                    <?php

                    // Check if there is a login error message in the session
                    if (isset($_SESSION['message-success'])) {
                      echo '<p class="warning-message alert alert-success">' . $_SESSION['message-success'] . '</p>';
                      // Clear the error message from the session
                      unset($_SESSION['message-success']);
                    }
                    if (isset($_SESSION['message-fail'])) {
                      echo '<p class="warning-message alert alert-danger">' . $_SESSION['message-fail'] . '</p>';
                      // Clear the error message from the session
                      unset($_SESSION['message-fail']);
                    }
                    ?>
                  </div>
                </div>

                <div class="row justify-content-center">
                  <div class="col-md-6 grid-margin stretch-card pt-4">
                    <div class="card">
                      <div class="card-body border border-white">
                        <form class="forms-sample" action="./database-files/profile-update.php" method="post">
                          <div class="form-group">
                            <label for="exampleInputUsername1">Username</label>
                            <input type="text" class="form-control bg-dark" name="username" id="exampleInputUsername1"
                              placeholder="Username"
                              value="<?php echo isset($profileData['username']) ? $profileData['username'] : ''; ?>"
                              >
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control bg-dark" name="email" id="exampleInputEmail1"
                              placeholder="Email" autocomplete="off"
                              value="<?php echo isset($profileData['email_id']) ? $profileData['email_id'] : ''; ?>"
                              >
                          </div>
                          <div class="form-group">
                            <label for="Current Password">Current Password</label>
                            <div class="input-group">
                              <input type="password" class="form-control bg-dark" name="password" id="currentPassword"
                                placeholder="Current Password" vale="" required>
                              <div class="input-group-append">
                                <span class="input-group-text" id="eyeIcon"
                                  onclick="togglePasswordVisibility('currentPassword', 'eyeIcon')">
                                  <i class="fa fa-eye" aria-hidden="true"></i>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="newpassword">New Password</label>
                            <div class="input-group">
                              <input type="password" class="form-control bg-dark" name="newPassword" id="newpassword"
                                placeholder="New Password" value="" required>
                              <div class="input-group-append">
                                <span class="input-group-text" id="eyeIcon1"
                                  onclick="togglePasswordVisibility('newpassword', 'eyeIcon1')">
                                  <i class="fa fa-eye" aria-hidden="true"></i>
                                </span>
                              </div>
                            </div>
                          </div>


                          <div class="form-group">
                            <label for="Confirm Password">Confirm Password</label>
                            <div class="input-group">
                              <input type="password" class="form-control bg-dark" name="confirmPassword"
                                id="Confirm Password" placeholder="Match Password" value="" required>
                              <div class="input-group-append">
                                <span class="input-group-text" id="eyeIcon2"
                                  onclick="togglePasswordVisibility('Confirm Password', 'eyeIcon2')">
                                  <i class="fa fa-eye" aria-hidden="true"></i>
                                </span>
                              </div>
                            </div>
                          </div>

                          <div class="text-center pt-4 d-flex align-items-center justify-content-center">
                            <button type="submit"
                              class="btn btn-primary me-2 d-flex align-items-center justify-content-center"
                              style="padding: 1rem 2rem; font-size: 1rem; border: none;"><img
                                src='assets/images/update.gif' alt='Delete Image'
                                style='width: 20px; height: 20px; margin-right: 0.5rem;'>Update</button>
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
        function togglePasswordVisibility(inputId, eyeIconId) {
          var passwordInput = document.getElementById(inputId);
          var eyeIcon = document.getElementById(eyeIconId);

          if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.innerHTML = '<i class="fa fa-eye-slash" aria-hidden="true"></i>';
          }
          else {
            passwordInput.type = 'password';
            eyeIcon.innerHTML = '<i class="fa fa-eye" aria-hidden="true"></i>';
          }
        }


      </script>

      <!-- JavaScript Password Hide/Unhide Ends  -->

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
