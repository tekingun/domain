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
                                <input type="hidden" name="musteri_tel" value="<?= $musteri['telefon']; ?>">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label">SMS İçeriği</label>
                                            <textarea name="musteriteklisms" id="" class="form-control"
                                                      rows="4"></textarea>
                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->
                                <div class="row mt-3">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-success submit"
                                                name="musteriteklismsgonder">Gönder
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
    <?php } else {

        echo "ERİŞİM İZNİ HATASI";
    }

} else {
    echo "ERİŞİM İZNİ HATASI";
}
