<?php
// Assuming you have a db_con.php file for database connection
require('./database-files/db_con.php');


// Check if a search query is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the search term
    $searchTerm = $_POST["searchTerm"];

    // Run your query to fetch data based on the search term
    $sql = "SELECT * FROM c_equipment
            WHERE e_name LIKE '%$searchTerm%'
               OR e_category LIKE '%$searchTerm%'
               OR e_brand_name LIKE '%$searchTerm%'";
} else {
    // If no search query, fetch all data
    $sql = "SELECT * FROM c_equipment where flag='0'";
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

    <title>Assign Equipment</title>

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
                <?php
                if (isset($_SESSION['transaction-id'])) {
                    ?>
                    <div class="content-wrapper">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4 class="card-title">Assign Equipments Now</h4>

                                        </div>
                                        <div class="col-md-5">
                                            <form class="" action="assign-equipment.php" method="post">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="searchTerm"
                                                        placeholder="Search..." aria-label="Search"
                                                        aria-describedby="search-addon">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="submit">
                                                            <i class="mdi mdi-magnify"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-5">
                                            <form class="" action="./database-files/complete-transaction.php" method="post">
                                                <div class="input-group">
                                                    <input type='hidden' name='transaction_id'
                                                        value='<?php echo $_SESSION['transaction-id'] ?>'>
                                                    <!-- Add the input field for the condition -->
                                                    <input type='hidden' name='condition' value='complete'
                                                        placeholder='Enter Condition'>
                                                    <div class="input-group-append pt-4 pb-4">
                                                        <button class="btn btn-outline-secondary ps-3 pe-3 pt-2 pb-2"
                                                            type="submit">
                                                            <img src='assets/images/complete.png' alt='Delete Image'
                                                                style='width: 25px; height: 25px; margin-right: 0.5rem;'>
                                                            Complete Assign
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- Message -->
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
                                    </div>


                                    <?php
                                    // Display the fetched data within HTML
                                    if ($result->num_rows > 0) {
                                        echo "<div class='table-responsive'>";
                                        echo "<table class='table table-hover'>";
                                        echo "<thead><tr><th>ID</th><th>Name</th><th>Brand Name</th><th>Condition of Equipment</th><th>Add</th></tr></thead>";
                                        echo "<tbody>";

                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>{$row['e_serail_id']}</td>";
                                            echo "<td>{$row['e_name']}</td>";
                                            echo "<td>{$row['e_brand_name']}</td>";
                                            echo "<td>";
                                            if ($row['flag'] == 0) {
                                                echo "<form action='./database-files/store-records-transaction.php' method='post'>";

                                                echo "<select name='condition' required class='js-example-basic-single bg-dark text-white text-center' style='width:100%'>";
                                                echo "<option value='' disabled selected>--Select Condition--</option>";
                                                echo "<option value='EXCELLENT'>EXCELLENT</option>";
                                                echo "<option value='GOOD'>Good</option>";
                                                echo "<option value='POOR'>POOR</option>";
                                                echo "<option value='DAMAGED'>DAMAGED</option>";
                                                echo "</select>";
                                                echo "<input type='hidden' name='serial_id' value='{$row['e_id']}'>";
                                                echo "<input type='hidden' name='transaction_id' value='{$_SESSION['transaction-id']}'>";
                                                echo "<td>";
                                                echo "<button type='submit' class='btn btn-primary me-2 d-flex align-items-center justify-content-center' style='padding: 1rem 2rem; font-size: 1rem; border: none;'><img src='assets/images/add.gif' alt='Add Image' style='width: 20px; height: 20px; margin-right:0.5rem'>Add</button>";
                                                echo "</td>";
                                                echo "</form>";
                                            } else {
                                            }

                                            echo "</tr>";

                                        }

                                    }
                                    // Close the database connection
                                    $conn->close();
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Main Section End -->
                    <?php
                } else {

                    echo $_SESSION['transaction-id'];
                    ?>
                    <div class="content-wrapper">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4 class="card-title">Assign Student First</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }

                ?>
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