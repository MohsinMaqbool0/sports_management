<?php
// Assuming you have a db_con.php file for database connection
require('./database-files/db_con.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the search term
  $searchTerm = $_POST["searchTerm"];

  // Run your query to fetch data based on the search term
  $sql = "SELECT * FROM c_student
            WHERE s_first_name LIKE '%$searchTerm%'
                OR s_last_name LIKE '%$searchTerm%'
                OR s_student_reg LIKE '%$searchTerm%'
                OR s_roll_no LIKE '%$searchTerm%'";
} else {
  // If no search query, fetch all data
  $sql = "SELECT * FROM c_student where flag='0' OR flag='1'";
}

// Execute the query
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Assign Students Equipment</title>

  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">

  <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">

  <link rel="stylesheet" href="assets/css/style.css">

  <link rel="shortcut icon" href="assets/images/favicon.png" />

</head>

<body>

  <div class="container-scroller">

    <!-- Header & Sidebar Section Start -->
    <?php
    include 'header.php';
    include 'sidebar.php';
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
                  <div class="col-md-2">
                    <h4 class="card-title">All Students</h4>
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
                  <div class="col-md-10">
                    <form class="" action="#" method="post">
                      <div class="input-group">
                        <input type="text" class="form-control" name="searchTerm" placeholder="Search..." autocomplete="off"
                          aria-label="Search" aria-describedby="search-addon">
                        <div class="input-group-append">
                          <button class="btn btn-outline-secondary" type="submit">
                            <i class="mdi mdi-magnify"></i>
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

                <?php
                // Display the fetched data within HTML
                if ($result->num_rows > 0) {
                  echo "<div class='table-responsive'>";
                  echo "<table class='table table-hover'>";
                  echo "<thead><tr><th>College ID</th><th>Name</th><th>Stream</th><th>Roll Number</th><th>Semester</th><th>Batch</th><th>Assign Equipment</th></tr></thead>";
                  echo "<tbody>";

                  while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='text-white'>{$row['s_student_reg']}</td>";
                    echo "<td>{$row['s_first_name']} {$row['s_last_name']}</td>";
                    echo "<td>{$row['s_stream']}</td>";
                    echo "<td>{$row['s_roll_no']}</td>";
                    echo "<td>{$row['s_phone_no']}</td>";
                    echo "<td>{$row['s_batch']}</td>";

                    if ($row['flag'] == 0) {
                      echo "<td>";
                      echo "<form action='./database-files/user-transaction.php' method='post'>";
                      echo "<input type='hidden' name='student_id' value='{$row['s_id']}'>";
                      echo "<button type='submit' class='d-flex align-items-center justify-content-center'><img src='assets/images/assign.gif' alt='Delete Image' style='width: 25px; height: 25px; margin-right: 0.5rem'> Assign</button>";
                      echo "</form>";
                      echo "</td>";
                    } elseif ($row['flag'] == 1) {
                      echo "<td>";
                      echo "<form action='./database-files/pending-transaction.php' method='post'>";
                      echo "<input type='hidden' name='student_id' value='{$row['s_id']}'>";
                      echo "<button type='submit' class='d-flex align-items-center justify-content-center'> <img src='assets/images/pending.gif' alt='Delete Image' style='width: 20px; height: 20px; margin-right: 0.5rem'>Pending Equipment</button>";
                      echo "</form>";
                      echo "</td>";
                    } else {
                      echo "<td>";
                      echo "<span class='text-danger'>Not Returned</span>";
                      echo "</td>";
                    }

                    echo "</tr>";
                  }

                  echo "</tbody></table>";
                  echo "</div>";
                } else {
                  echo "No records found.";
                }

                // Close the database connection
                $conn->close();
                ?>
              </div>
            </div>
          </div>
        </div>
        <!-- Main Section End -->
      </div>
    </div>


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