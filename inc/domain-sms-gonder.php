<?php
include 'sessions.php';
if ($_SESSION['oturum'] == "ok" && $_SESSION['username'] != "") {
    include 'header.php';
    $id = $_GET['q'];
    if ($id != "") {
        $domainler = $db->prepare("select * from domainler where id='$id'");
        $domainler->execute();
        $domain = $domainler->fetch(PDO::FETCH_BOTH);
        $musteri = $db->query("select * from musteriler where id='{$domain['musteri_id']}'")->fetch();
        $tarih1 = new DateTime($domain['bitis_tarihi']);
        $tarih2 = new DateTime(date('Y-m-d'));
        $interval = $tarih1->diff($tarih2);
        $kalansure = $interval->format('%a gün kaldı.');
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
                            <h6 class="card-title mb-5"> <?= $domain['domain']; ?> sahibine sms gönder
                                <small class="float-right"><?= $musteri['ad']; ?> Adlı Müşteri</small></h6>
                            <div class="row mb-5 mt-3">
                                <div class="col-sm-3 text-center">
                                    <label><u>Domain Bitiş Tarihi:</u></label>
                                    <label><?= $domain['bitis_tarihi']; ?></label>
                                </div>
                                <div class="col-sm-3 text-center">
                                    <label><u>Kalan Gün:</u></label>
                                    <label
                                    ><?= $kalansure; ?>
                                </div>
                                <div class="col-sm-3 text-center">
                                    <label><u>Domain SSL Durumu:</u></label>
                                    <label><?= $domain['ssl_durum'] == '1' ? '<div class="badge badge-pill badge-success">Aktif</div>' : '<div class="badge badge-pill badge-danger">Pasif</div>'; ?></label>
                                </div>
                                <div class="col-sm-3 text-center">
                                    <label><u>Domain SSL Kalan Gün:</u></label>
                                    <label><?= $domain['ssl_kalangun']; ?> Gün
                                </div>
                            </div>
                            <form action="../set/code.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="page" value="domain">
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
