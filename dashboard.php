<?php
ob_start();
// Assuming you have a db_con.php file for database connection
require('./database-files/db_con.php');

// Fetch data from the database using a JOIN query
$sql = "SELECT
            t.t_id,
            s.s_id,
            s.s_first_name,
            s.s_last_name,
            s.s_roll_no,
            s.s_stream,
            s.s_semester,
            s.s_batch,
            s.s_student_reg,
            s.s_phone_no,
            t.t_student_id
        FROM c_transaction t
        INNER JOIN c_student s ON t.t_student_id = s.s_id
        WHERE t.flag='ASSIGNED'
        ORDER BY t.t_id ASC";

$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Admin Panel</title>

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
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <h3>
                                Equipment Status
                            </h3>
                        </div>
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    // Check if there are any records
                                    if ($result->num_rows > 0) {
                                        // Display table header
                                        echo '<div class="table-responsive">';
                                        echo '<table class="table table-hover">';
                                        echo '<thead>';
                                        echo '<tr>';
                                        echo '<th> S.No. </th>';
                                        echo '<th> Student Name </th>';
                                        echo '<th> Roll No </th>';
                                        echo '<th> Registration ID </th>';
                                        echo '<th> Transaction ID </th>';
                                        echo '<th> Status </th>';
                                        echo '<th> Return </th>';
                                        echo '</tr>';
                                        echo '</thead>';
                                        echo '<tbody>';

                                        // Display data rows
                                        $counter = 1;
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<tr>';
                                            echo '<td>' . $counter . '</td>';
                                            echo '<td><span class="pl-2">' . $row['s_first_name'] . ' ' . $row['s_last_name'] . '</span></td>';
                                            echo '<td>' . $row['s_roll_no'] . '</td>';
                                            echo '<td>' . $row['s_student_reg'] . '</td>';
                                            echo '<td>' . $row['t_id'] . '</td>';

                                            // Additional query to fetch data from c_transaction_cart
                                            $innerSql = "SELECT ctc.*, ce.e_name, ce.e_category, ce.e_brand_name, ce.e_serail_id
                                                     FROM c_transaction_cart ctc
                                                     INNER JOIN c_equipment ce ON ctc.c_equipment_id = ce.e_id
                                                     WHERE ctc.c_transaction_id ='" . $row['t_id'] . "' AND ctc.c_return_date IS NULL ";

                                            $innerResult = $conn->query($innerSql);

                                            if ($innerResult->num_rows > 0) {
                                                // Assuming you only need data from the first row
                                                echo '<td>';
                                                while ($innerRow = $innerResult->fetch_assoc()) {

                                                    echo '<ul>';
                                                    // Now you can use $innerRow['column_name'] to access the additional data
                                                    echo '<li>' . $innerRow['e_name'] . ' ( ' . $innerRow['c_initail_status'] . ' )' . '</li>';
                                                    echo '<li>' . $innerRow['e_brand_name'] . ' Brand' . '</li>';
                                                    echo '<li>' . $innerRow['e_serail_id'] . ' Serial ID' . '</li>';
                                                    echo '</ul>';
                                                }
                                                echo '</td>';

                                            } else {
                                                // Handle the case where there is no matching data in c_transaction_cart
                                                echo '<td colspan="4">No additional data found</td>';
                                            }

                                            echo "<td>";
                                            echo "<form action='./database-files/return-equipment.php' method='post'>";
                                            echo "<input type='hidden' name='transactionID' value='{$row['t_id']}'>";
                                            echo "<input type='hidden' name='studentID'  value='{$row['s_id']}'>";
                                            echo "<button type='submit' class='btn btn-primary d-flex align-items-center justify-content-center' style='font-weight:500; padding: 0.9rem 0.7rem; font-size: 0.8rem; letter-spacing: 1px'> <img src='assets/images/return.gif' alt='Delete Image' style='width: 25px; height: 25px; margin-right: 0.5rem'> Return Item</button>";
                                            echo "</form>";
                                            echo "</td>";

                                            echo '</tr>';
                                            $counter++;
                                        }


                                        // Close the table
                                        echo '</tbody>';
                                        echo '</table>';
                                        echo '</div>';
                                    } else {
                                        // If no records found
                                        echo '<p>No records found.</p>';
                                    }

                                    // Close the database connection
                                    $conn->close();

                                    // Function to determine badge class based on status
                                    function getStatusBadgeClass($status)
                                    {
                                        switch ($status) {
                                            case 'GOOD':
                                                return 'badge-outline-success';
                                            case 'POOR':
                                                return 'badge-outline-warning';
                                            case 'EXCELLENT':
                                                return 'badge-outline-primary';
                                            case 'DAMAGED':
                                                return 'badge-outline-danger';
                                            default:
                                                return 'badge-outline-secondary';
                                        }
                                    }


                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main Section End -->
        </div>
    </div>


    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
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