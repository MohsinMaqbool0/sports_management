<?php
// Assuming you have a db_con.php file for database connection
require('./database-files/db_con.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['selectedStudents']) && is_array($_POST['selectedStudents'])) {
    // Retrieve selected student IDs
    $selectedStudents = $_POST['selectedStudents'];

    // Delete the selected student records from the database
    $deleteQuery = "DELETE FROM c_student WHERE s_id IN ('" . implode("','", $selectedStudents) . "') AND flag='0'";
    $result = mysqli_query($conn, $deleteQuery);

    if (!$result) {
      // Error in query execution
      die("Error: " . mysqli_error($conn));
    }

    // Check if any rows were affected
    $affectedRows = mysqli_affected_rows($conn);

    if ($affectedRows > 0) {
      // Records deleted successfully
      session_start();
      $_SESSION['message-success'] = "Selected student records deleted successfully";
      header("Location: ./view-students.php");
      exit();
    } else {
      // No rows affected, students not found or other issues
      session_start();
      $_SESSION['message-fail'] = "Error deleting selected student records: Students not found or other issues.";
      header("Location: ./view-students.php");
      exit();
    }
  }
}

// Fetch all students from the database
$sql = "SELECT * FROM c_student ORDER BY s_id DESC";
$result = $conn->query($sql);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>View Students</title>

  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">

  <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <!-- <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css"> -->

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
                <form action="./database-files/delete-multi-students.php" method="post">
                  <div class='table-responsive'>
                    <table class='table table-hover'>
                      <thead>
                        <tr>
                          <th>Select</th>
                          <th>Reg ID</th>
                          <th>Name</th>
                          <th>Stream</th>
                          <th>Roll No</th>
                          <th>Phone No</th>
                          <th>Batch</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                          echo "<tr>";
                          echo "<td><input type='checkbox' name='selectedStudents[]' value='{$row['s_id']}'></td>";
                          echo "<td class='text-white'>{$row['s_student_reg']}</td>";
                          echo "<td>{$row['s_first_name']} {$row['s_last_name']}</td>";
                          echo "<td>{$row['s_stream']}</td>";
                          echo "<td>{$row['s_roll_no']}</td>";
                          echo "<td>{$row['s_phone_no']}</td>";
                          echo "<td>{$row['s_batch']}</td>";
                          echo "<td>";
                          echo "<form action='./database-files/delete-student.php' method='post'>";
                          echo "<input type='hidden' name='studentID' value='{$row['s_id']}'>";
                          echo "<button type='submit' class='bg-transparent'>
                              <img src='assets/images/delete.gif' alt='Delete Image' style='width: 20px; height: 20px;'> </button>";
                          echo "</form>";
                          echo "</td>";
                          echo "</tr>";
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="text-center m-5 d-flex align-items-center justify-content-center">
                    <button type='submit' class='btn btn-danger d-flex align-items-center justify-content-center'>
                      <img src='assets/images/Delete_button.gif' alt='Delete Image'
                        style='width: 25px; height: 25px; margin-right: 0.5rem;'> Delete All </button>
                    <div>

                </form>

              </div>
            </div>
          </div>
        </div>
        <!-- Main Section End -->
      </div>
    </div>
  </div>

  <script src="assets/vendors/js/vendor.bundle.base.js"></script>

  
  <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
  <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
  <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script> -->

  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/misc.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/todolist.js"></script>

  <!-- <script src="assets/js/dashboard.js"></script> -->

</body>

</html>