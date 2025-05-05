<style>
    .header-left {
    display: flex;
    align-items: center;
    padding: 20px; /* Increase padding for larger header */
}

.large-logo {
    width: 120px; /* Adjust width for larger logo */
    height: auto; /* Maintain aspect ratio */
}

.small-logo {
    width: 80px; /* Adjust width for small logo */
    height: auto; /* Maintain aspect ratio */
    display: none; /* Hide by default */
}

@media (max-width: 768px) {
    .large-logo {
        display: none; /* Hide the large logo on smaller screens */
    }

    .small-logo {
        display: block; /* Show the small logo on smaller screens */
    }
}

</style>

<?php
if (empty($_SESSION['admin_session'])) {
header('Location:login.php');

}
include_once '../dbconnection.php';
?>
<div class="header">
    <div class="header-left">
        <a href="index.php" class="logo">
            <img src="assets/img/logoo2.jpg" alt="Logo">
        </a>
        <a href="index.php" class="logo logo-small">
            <img src="assets/img/logoo2.jpg" alt="Logo" width="60" height="30">
        </a>
    </div>
    <a href="javascript:void(0);" id="toggle_btn">
        <i class="fas fa-align-left"></i>
    </a>

    <a class="mobile_btn" id="mobile_btn">
        <i class="fas fa-bars"></i>
    </a>
    <ul class="nav user-menu">
        <li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <span class="user-img">
                    <div class="avatar">
                        <?php $string= $_SESSION['admin_session']['username'];
                                      $firstLetter = substr($string, 0, 1);  ?>
                        <span class="avatar-title rounded-circle border border-white"><?php echo $firstLetter; ?></span>
                    </div>
                </span>
            </a>
            <div class="dropdown-menu">
                <div class="user-header">
                    <div class="avatar avatar-sm">
                        <div class="avatar">
                            <span
                                class="avatar-title rounded-circle border border-white"><?php  echo $firstLetter;?></span>

                        </div>
                    </div>
                    <div class="user-text">
                        <h6><?php echo $_SESSION['admin_session']['username'] ?></h6>
                        <p class="text-muted mb-0">Administrator</p>
                    </div>
                </div>

                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </li>
    </ul>
</div>