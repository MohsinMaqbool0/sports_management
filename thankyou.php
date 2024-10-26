<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Thankyou Page</title>

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

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
                    <h4 class="card-title">Thank You Page</h4>

                  </div>
                  <div class="col-md-4">
                    <!-- error Message -->
                  </div>
                </div>

                <div class="row justify-content-center">
                  <div class="col-md-6 grid-margin stretch-card pt-4">
                    <div class="card">

                      <div class="card col-md-12 bg-white shadow-md p-5">
                        <div class="mb-4 text-center">
                          <img src="assets/images/thankyou.png">
                        </div>
                        <div class="text-center">
                          <h1 class="text-dark pt-4 pb-4">Password Changed Successfully</h1>
                          <a href="index.php"
                            class="btn btn-primary me-2 d-flex align-items-center justify-content-center"
                            style="padding: 1rem 2rem; font-size: 1rem; border: none;"><img src='assets/images/home.png'
                              alt='Delete Image' style='width: 20px; height: 20px; margin-right: 0.5rem;'>Login Now</a
                            href="index.php">
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
    </div>
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