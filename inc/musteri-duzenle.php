<?php
include 'sessions.php';
if ($_SESSION['oturum'] == "ok" && $_SESSION['username'] != "") {
    $id = $_GET['q'];
    if ($id != "") {
        include 'header.php';
        $musteriler = $db->prepare("select * from musteriler where id='$id'");
        $musteriler->execute();
        $musteri = $musteriler->fetch(PDO::FETCH_BOTH); ?>
        <div class="page-content">
            <nav class="page-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Müşteri Düzenle</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-md-12 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title"> Müşteri Düzenle</h6>
                            <form action="../set/code.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" value="<?=$id;?>" name="id">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Müşteri Adı</label>
                                            <input type="text" name="ad" class="form-control"
                                                   placeholder="Müşteri Adı" required value="<?= $musteri['ad']; ?>">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Firma Adı</label>
                                            <input type="text" name="firma" class="form-control"
                                                   placeholder="Firma Adı" value="<?= $musteri['firma']; ?>">
                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Müşteri Telefon Numarası</label>
                                            <input type="text" name="telefon" class="form-control"
                                                   placeholder="Telefon No." required
                                                   value="<?= $musteri['telefon']; ?>">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Müşteri Mail Adresi</label>
                                            <input type="email" name="mail" class="form-control"
                                                   placeholder="Mail adresi" required value="<?= $musteri['mail']; ?>">
                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label">Açıklama <small>İsteğe bağlı</small></label>
                                            <input type="text" name="aciklama" class="form-control"
                                                   placeholder="Açıklama (isteğe bağlı)"
                                                   value="<?= $musteri['aciklama']; ?>">
                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->
                                <div class="row mt-3">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-success submit" name="musteriduzenle">Düzenle
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
