<?php
// Assuming you have a db_con.php file for database connection
require('./database-files/db_con.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['searchTerm'])) {
  // Get the search term
  // Get the search term
  $searchTerm = $_POST['searchTerm'];

  // Prepare a SQL statement for search
  $sql = "SELECT
                  t.t_id,
                  s.s_first_name,
                  s.s_last_name,
                  s.s_roll_no,
                  s.s_stream,
                  s.s_semester,
                  s.s_batch,
                  s.s_student_reg,
                  s.s_phone_no
              FROM c_transaction t
              INNER JOIN c_student s ON t.t_student_id = s.s_id
              WHERE t.flag ='COMPLETED'
                AND (s.s_first_name LIKE ? OR s.s_last_name LIKE ? OR s.s_student_reg LIKE ? OR s.s_roll_no LIKE ? OR s.s_batch LIKE ?)";

  // Use a prepared statement to prevent SQL injection
  $stmt = $conn->prepare($sql);

  // Bind parameters
  $searchParam = "%$searchTerm%"; // Add '%' to search for partial matches
  $stmt->bind_param("sssss", $searchParam, $searchParam, $searchParam, $searchParam, $searchParam);

  // Execute the prepared statement
  $stmt->execute();

  // Get the result
  $result = $stmt->get_result();

} else {
  // Fetch data from the database using a JOIN query
  $sql = "SELECT
              t.t_id,
              s.s_first_name,
              s.s_last_name,
              s.s_roll_no,
              s.s_stream,
              s.s_semester,
              s.s_batch,
              s.s_student_reg,
              s.s_phone_no
          FROM c_transaction t
          INNER JOIN c_student s ON t.t_student_id = s.s_id
          WHERE t.flag ='COMPLETED' order by  t.t_id  DESC";

  // Execute the query
  $result = $conn->query($sql);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Equipments Retrieved</title>

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
                  <div class="col-md-4">
                    <h4 class="card-title">Equipments Retrieved</h4>

                  </div>
                  <div class="col-md-8">
                    <form class="" action="equipments-retrieved.php" method="post">
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
                <!-- Error message  -->
                <div class="col-md-12 d-flex justify-content-center align-items-center">
                  <?php

                  // Check if there is a login error message in the session
                  if (isset($_SESSION['message-success'])) {
                    echo '<p class="warning-message alert alert-success m-4">' . $_SESSION['message-success'] . '</p>';
                    // Clear the error message from the session
                    unset($_SESSION['message-success']);
                  }
                  if (isset($_SESSION['message-fail'])) {
                    echo '<p class="warning-message alert alert-danger m-4">' . $_SESSION['message-fail'] . '</p>';
                    // Clear the error message from the session
                    unset($_SESSION['message-fail']);
                  }
                  ?>
                </div>
                <?php
                // Display the fetched data within HTML
                if ($result->num_rows > 0) {
                  echo "<div class='table-responsive'>";
                  echo "<table class='table table-hover'>";
                  echo "<thead><tr><th>College ID</th><th>Name</th><th>Stream</th><th>Roll Number</th><th>Phone Number</th><th>Batch</th><th>Equipment (Return Date)</th></tr></thead>";
                  echo "<tbody>";

                  while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='text-white'>{$row['s_student_reg']}</td>";
                    echo "<td>{$row['s_first_name']} {$row['s_last_name']}</td>";
                    echo "<td>{$row['s_stream']}</td>";
                    echo "<td>{$row['s_roll_no']}</td>";
                    echo "<td>{$row['s_phone_no']}</td>";

                    echo "<td>{$row['s_batch']}</td>";
                    // Additional query to fetch data from c_transaction_cart
                    $innerSql = "SELECT ctc.*, ce.e_name, ce.e_category, ce.e_brand_name, ce.e_serail_id
                                         FROM c_transaction_cart ctc
                                         JOIN c_equipment ce ON ctc.c_equipment_id = ce.e_id
                                         WHERE ctc.c_transaction_id ='" . $row['t_id'] . "' ";

                    $innerResult = $conn->query($innerSql);

                    if ($innerResult->num_rows > 0) {
                      // Assuming you only need data from the first row
                      echo '<td>';
                      while ($innerRow = $innerResult->fetch_assoc()) {

                        echo '<ul>';
                        // Now you can use $innerRow['column_name'] to access the additional data
                        echo '<li>' . $innerRow['e_name'] . ' ( ' . $innerRow['c_return_date'] . ' )' . '</li>';
                        echo '<li>' . $innerRow['e_serail_id'] . ' Serial ID' . '</li>';
                        echo '</ul>';
                      }
                      echo '</td>';

                    } else {
                      // Handle the case where there is no matching data in c_transaction_cart
                      echo '<td colspan="4">No additional data found</td>';
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