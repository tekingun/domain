<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

if ($_SESSION['username'] != "" && $_SESSION['oturum'] != 'ok') {

} else {
    include '../set/connect.php';
    $admin = $db->prepare("select * from kullanici where username=?");
    $admin->execute(array($_SESSION['username']));
    $adminRow = $admin->rowCount();
    if ($adminRow > 0) {
        $admin_data = $admin->fetch(PDO::FETCH_BOTH);
    } else {
        header("Location: ../login.php?q=oturum");
    }

    if ($_SESSION['username'] != $admin_data['username']) {
        header("Location: logout.php");
    } ?>
    <!DOCTYPE html>
    <html lang="tr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" type="image/png" href="" />
        <title>İş - Domain Takip Scripti</title>
        <!-- core:css -->
        <link rel="stylesheet" href="../assets/vendors/core/core.css">
        <!-- endinject -->
        <!-- plugin css for this page -->
        <link rel="stylesheet" href="../assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
        <!-- end plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="../assets/fonts/feather-font/css/iconfont.css">
        <!-- endinject -->
        <!-- Layout styles -->
        <link rel="stylesheet" href="../assets/css/demo_1/style.css">
        <!-- sweet alert -->
        <link rel="stylesheet" href="../assets/vendors/sweetalert2/sweetalert2.min.css">
    </head>
<body>
<div class="main-wrapper">
    <?php include 'sidebar.php'; ?>
    <!-- partial -->
    <div class="page-wrapper">
    <!-- partial:../partials/_navbar.html -->
    <nav class="navbar">
        <a href="#" class="sidebar-toggler">
            <i data-feather="menu"></i>
        </a>
        <div class="navbar-content">
            <ul class="navbar-nav">
                <li class="nav-item dropdown nav-profile">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="../../<?= $admin_data['resim']; ?>" width="30" height="30" alt="profile">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="profileDropdown">
                        <div class="dropdown-header d-flex flex-column align-items-center">
                            <div class="figure mb-3">
                                <img src="../../<?= $admin_data['resim']; ?>" width="80" height="80" alt="">
                            </div>
                            <div class="info text-center">
                                <p class="name font-weight-bold mb-0"><?= $admin_data['username']; ?></p>
                            </div>
                        </div>
                        <div class="dropdown-body">
                            <ul class="profile-nav p-0 pt-3">
                                <li class="nav-item">
                                    <a href="profili-duzenle.php" class="nav-link">
                                        <i data-feather="user"></i>
                                        <span>Profili Düzenle</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="logout.php" class="nav-link">
                                        <i data-feather="log-out"></i>
                                        <span>Log Out</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- partial -->
<?php } ?>