<?php
session_start();
if (empty($_SESSION['admin_session'])) {
    header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>iCARE Apple Service Centre</title>
    <link rel="shortcut icon" href="assets/img/logoo2.jpg">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">

    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">



    <link rel="stylesheet" href="assets/css/style.css">
</head>



<body>
    <div class="main-wrapper">
        <?php include 'top.php'; ?>
        <?php include 'sidebar.php'; ?>

        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Add Shop</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="testimo.php">Add Shop</a></li>
                                <li class="breadcrumb-item active">Add Shop</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="insertshop.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Shop Information</span></h5>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Shop Name:</label>
                                                <input type="text" name="shopname" class="form-control" required
                                                    oninput="validateText(this)">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Owner Name:</label>
                                                <input type="text" name="ownername" class="form-control" required
                                                    oninput="validateText(this)">
                                            </div>
                                        </div>

                                        <script>
                                            function validateText(input) {
                                                input.value = input.value.replace(/[^a-zA-Z\s]/g, '');
                                            }
                                        </script>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Contact Number:</label>
                                                <input type="tel" name="number" class="form-control"
                                                    oninput="validateMobileNumber(this)" maxlength="10" required>
                                            </div>
                                        </div>
                                        <script>
                                            function validateMobileNumber(input) {
                                                // Remove non-digit characters
                                                input.value = input.value.replace(/\D/g, '');

                                                // Ensure only the first 10 digits are kept
                                                if (input.value.length > 10) {
                                                    input.value = input.value.slice(0, 10);
                                                }
                                            }
                                        </script>


                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Email Address:</label>
                                                <input type="email" name="email" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Shop Address:</label>
                                                <input type="text" name="address" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Shop Area Name:</label>
                                                <input type="text" name="area" class="form-control" required>
                                            </div>
                                        </div>


                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Shop opening Time and day</label>
                                                <input type="text" name="opentime" class="form-control" required>
                                            </div>
                                        </div>

                                       

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Services Offered:</label>
                                                <input type="text" name="services_offered" class="form-control"
                                                    required>
                                            </div>
                                        </div>

                                       

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>GST Number (if applicable):</label>
                                                <input type="text" name="GST_number" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Logo:</label>
                                                <input type="file" class="form-control" name="image" required>
                                            </div>
                                        </div>

                                       

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Customer Support Number:</label>
                                                <input type="text" name="customer_support_number" class="form-control"
                                                    oninput="validateMobileNumber(this)" maxlength="10" required>
                                            </div>
                                        </div>

                                       
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group position-relative">
                                                <label>Set Password:</label>
                                                <input type="password" id="password" name="password"
                                                    class="form-control" required>
                                                <button type="button" id="togglePassword"
                                                    class="btn btn-outline-secondary position-absolute"
                                                    style="top: 72%; right: 0px; transform: translateY(-50%);">
                                                    <i id="togglePasswordIcon" class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const togglePassword = document.getElementById('togglePassword');
                                                const password = document.getElementById('password');
                                                const togglePasswordIcon = document.getElementById('togglePasswordIcon');

                                                togglePassword.addEventListener('click', function() {
                                                    // Toggle the type attribute
                                                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                                                    password.setAttribute('type', type);

                                                    // Toggle the icon
                                                    togglePasswordIcon.classList.toggle('fa-eye');
                                                    togglePasswordIcon.classList.toggle('fa-eye-slash');
                                                });
                                            });
                                        </script>



                                        <div class="col-12">
                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <footer>
                <p>Copyright © 2024.</p>
            </footer>
        </div>
    </div>

    <script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
    <!-- Scripts  -->
    <script src="assets/js/jquery-3.5.1.min.js"></script>

    <script src="assets/js/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="assets/plugins/datatables/datatables.min.js"></script>

    <script src="assets/js/script.js"></script>

</body>

</html>