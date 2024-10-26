<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Add Items</title>

    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
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
                    <div class="page-header">
                        <h3 class="page-title"> Add Equipment </h3>
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
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-description"> Fill the form to add an equipment. </p>
                                    <form action="./database-files/register-equipment.php" method="post">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="itemName">Item Name</label>
                                                    <input type="text" class="form-control" id="itemName"
                                                        name="itemName" placeholder="Item Name" required autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sportCategory">Sport Category</label>
                                                    <input type="text" class="form-control" id="sportCategory"
                                                        name="sportCategory" placeholder="Sport Category" required autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="brandName">Brand Name</label>
                                                    <input type="text" class="form-control" id="brandName"
                                                        name="brandName" placeholder="Brand Name" required autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="conditionStatus">Serail ID</label>
                                                    <input type="text" class="form-control" id="serailID"
                                                        name="serailID" placeholder="Serail ID " required autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center pt-4 d-flex align-items-center justify-content-center">
                                            <button type="submit" class="btn btn-primary me-2 d-flex align-items-center"
                                                style="padding: 1rem 2rem; font-size: 1rem; border: none;"><img
                                                    src='assets/images/add.gif' alt='Delete Image'
                                                    style='width: 20px; height: 20px; margin-right: 0.5rem;'>Add</button>
                                            <button type="reset" class="btn btn-primary"
                                                style="padding: 1rem 2rem; font-size: 1rem; background-color: gray; border: none;">Reset</button>
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

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/select2/select2.min.js"></script>
    <script src="assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>

    <!-- Custom JS -->
    <script src="assets/js/file-upload.js"></script>
    <script src="assets/js/typeahead.js"></script>
    <script src="assets/js/select2.js"></script>
    <!-- End Custom JS -->

</body>

</html>