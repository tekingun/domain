<?php
include 'sessions.php';
if ($_SESSION['oturum'] == "ok" && $_SESSION['username'] != "") {
    include 'header.php';
    $ayar = $db->query("SELECT * FROM kullanici where id=0")->fetch();
    ?>
    <head>
        <!-- plugin css for this page -->
        <link rel="stylesheet" href="../assets/vendors/jquery-tags-input/jquery.tagsinput.min.css">
    </head>
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Profili Düzenle</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title"> Profili Düzenle</h6>
                        <form action="../set/code.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" value="<?= $ayar['resim']; ?>" name="resim_eski">
                            <div class="row">
                                <div class="col-md-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">Kullanıcı Adı</h6>
                                            <div>
                                                <input type="text" name="username" value="<?= $ayar['username']; ?>"
                                                       class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">Şifre</h6>
                                            <div>
                                                <input type="password" name="password" value="<?= $ayar['password']; ?>"
                                                       class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 text-center mt-5">
                                    <button type="submit" name="profilduzenle" class="btn btn-outline-success">Güncelle
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require 'footer.php'; ?>
    <!-- plugin js for this page -->
    <script src="../assets/vendors/jquery-tags-input/jquery.tagsinput.min.js"></script>
    <!-- custom js for this page -->
    <script src="../assets/js/tags-input.js"></script>
<?php } else {
    echo "ERİŞİM İZNİ HATASI";
}