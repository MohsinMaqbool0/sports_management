<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Register Students</title>

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
                        <h3 class="page-title"> Student Form</h3>
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
                                    <p class="card-description"> Fill the form to register a student. </p>
                                    <form class="forms-sample" action="./database-files/register-student.php"
                                        method="post">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sFirstName">First Name</label>
                                                    <input type="text" class="form-control" id="sFirstName"
                                                        name="sFirstName" placeholder="First Name" required autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sLastName">Last Name</label>
                                                    <input type="text" class="form-control" id="sLastName"
                                                        name="sLastName" placeholder="Last Name" required autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sRollNo">Roll Number</label>
                                                    <input type="text" class="form-control" id="sRollNo" name="sRollNo"
                                                        placeholder="Roll Number" required autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sStream">Stream</label>
                                                    <select class="form-control" id="sStream" name="sStream" required>
                                                        <option value="">--Select Stream--</option>
                                                        <option>BCA</option>
                                                        <option>BBA</option>
                                                        <option>MED</option>
                                                        <option>NON-MED</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sSemester">Semester</label>
                                                    <select class="form-control" id="sSemester" name="sSemester"
                                                        required>
                                                        <option value="">--Select Semester--</option>
                                                        <option>1st</option>
                                                        <option>2nd</option>
                                                        <option>3rd</option>
                                                        <option>4th</option>
                                                        <option>5th</option>
                                                        <option>6th</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sBatch">Batch</label>
                                                    <select class="form-control" id="sBatch" name="sBatch" required>
                                                        <option value="">--Select Batch--</option>
                                                        <option>2020</option>
                                                        <option>2021</option>
                                                        <option>2022</option>
                                                        <option>2023</option>
                                                        <option>2024</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sStudentReg">Student Registration</label>
                                                    <input type="text" class="form-control" id="sStudentReg"
                                                        name="sStudentReg" placeholder="Student Registration" required autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sPhoneNo">Phone Number</label>
                                                    <input type="tel" class="form-control" id="sPhoneNo" name="sPhoneNo"
                                                        maxlength="10" placeholder="Phone Number" required autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center pt-4 d-flex align-items-center justify-content-center">
                                            <button type="submit"
                                                class="btn btn-primary me-2 d-flex align-items-center justify-content-center"
                                                style="padding: 1rem 2rem; font-size: 1rem; border: none;"><img
                                                    src='assets/images/register.gif' alt='Delete Image'
                                                    style='width: 20px; height: 20px; margin-right: 0.5rem;'>
                                                Register</button>
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

        <script src="assets/vendors/js/vendor.bundle.base.js"></script>

        <script src="assets/vendors/select2/select2.min.js"></script>
        <script src="assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>

        <script src="assets/js/off-canvas.js"></script>
        <script src="assets/js/hoverable-collapse.js"></script>
        <script src="assets/js/misc.js"></script>
        <script src="assets/js/settings.js"></script>
        <script src="assets/js/todolist.js"></script>

        <script src="assets/js/file-upload.js"></script>
        <script src="assets/js/typeahead.js"></script>
        <script src="assets/js/select2.js"></script>

</body>

</html>