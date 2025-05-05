<?php
session_start();
require '../conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pass']) && isset($_POST['cpass'])) {
    $pass = trim($_POST['pass']);
    $cpass = trim($_POST['cpass']);

    if (empty($pass)) {
        echo "<script>alert('Password cannot be empty!');location.replace('forgot.php')</script>";
    } else {
        if ($pass === $cpass) {
            $hashPass = password_hash($pass, PASSWORD_BCRYPT);
            $stmt = $conn->prepare("UPDATE admin SET pass=? WHERE id=?");
            $admin_id = 1; // Replace with actual admin ID or session value
            $stmt->bind_param("si", $hashPass, $admin_id);

            if ($stmt->execute()) {
                echo "<script>alert('Password has been changed!');location.replace('index.php')</script>";
            } else {
                echo "<script>alert('Something went wrong. Please try again later.');location.replace('forgot.php')</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Passwords do not match!');location.replace('forgot.php')</script>";
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ganraj Travels - Login Admin Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Stylesheets -->
    <link rel="icon" type="image/png" href="favicon.ico" />
    <link rel="stylesheet" type="text/css" href="login_files/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="login_files/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="login_files/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="login_files/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="login_files/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="login_files/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="login_files/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="login_files/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="login_files/css/util.css">
    <link rel="stylesheet" type="text/css" href="login_files/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('login_files/images/bg-01.jpg');">
            <div class="wrap-login100 p-t-30 p-b-50">
                <span class="login100-form-title p-b-41">
                    Change Password
                </span>
                <form class="form-horizontal form-material" method="post">
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0" style="color:white;font-size: 20px;">Enter Password</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="password" required name="pass" placeholder="Create New Password" class="form-control p-1 border-dark border-1 input_password">
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0" style="color:white;font-size: 20px;">Repeat Password</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="password" required name="cpass" placeholder="Repeat New Password" class="form-control p-1 border-dark border-1 input_password">
                        </div>
                    </div>
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" id="show_pass" onclick="togglePasswordVisibility()">
                        <label class="form-check-label user-select-none" for="show_pass" style="color:white;font-size: 20px;">Show Password</label>
                    </div>
                    <button type="submit" class="btn text-white btn-success w-100">Change Password</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="login_files/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="login_files/vendor/animsition/js/animsition.min.js"></script>
    <script src="login_files/vendor/bootstrap/js/popper.js"></script>
    <script src="login_files/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="login_files/vendor/select2/select2.min.js"></script>
    <script src="login_files/vendor/daterangepicker/moment.min.js"></script>
    <script src="login_files/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="login_files/vendor/countdowntime/countdowntime.js"></script>
    <script src="login_files/js/main.js"></script>

    <script>
        function togglePasswordVisibility() {
            const inputs = document.querySelectorAll('.input_password');
            inputs.forEach(input => {
                if (input.type === 'password') {
                    input.type = 'text';
                } else {
                    input.type = 'password';
                }
            });
        }
    </script>
</body>

</html>
