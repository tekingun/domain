<?php
include 'sessions.php';
if ($_SESSION['oturum'] == "ok" && $_SESSION['username'] != "") {
    include 'header.php';
    $id = $_GET['q'];
    if ($id != "") {
        $musteriler = $db->prepare("select * from musteriler where id='$id'");
        $musteriler->execute();
        $musteri = $musteriler->fetch(PDO::FETCH_BOTH);
        ?>
        <head>
            <link rel="stylesheet" href="../assets/vendors/simplemde/simplemde.min.css">
        </head>
        <div class="page-content">
            <nav class="page-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"><?= $musteri['ad']; ?> Adlı Müşteri</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-md-12 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title mb-5"> <?= $musteri['ad']; ?> Adlı Müşteri</h6>
                            <form action="../set/code.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="page" value="musteri">
                                <div class="col-md-12 mt-3">
                                    <label for="" class="col-md-2"><u>Mail Adresi:</u></label>
                                    <input type="text" name="mail" class="col-md-12 form-control"
                                           value="<?= $musteri['mail']; ?>">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="" class="col-md-2"><u>Başlık:</u></label>
                                    <input type="text" name="baslik" class="col-md-12 form-control">
                                </div>
                                <div class="email editor mt-3 mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="" class="col-md-2"><u>Mail İçeriği:</u></label>
                                            <textarea class="form-control" name="icerik" id="simpleMdeEditor"
                                                      rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-success submit"
                                                name="musteriteklimailgonder">Gönder
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
        <script src="../assets/vendors/simplemde/simplemde.min.js"></script>
        <!-- custom js for this page -->
        <script src="../assets/js/email.js"></script>
    <?php } else {

        echo "ERİŞİM İZNİ HATASI";
    }

} else {
    echo "ERİŞİM İZNİ HATASI";
}
