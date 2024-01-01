<?php
include 'sessions.php';
if ($_SESSION['oturum'] == "ok" && $_SESSION['username'] != "") {
    include 'header.php';
    $id = $_GET['q'];
    $vhizmetler = $db->prepare("select * from vhizmetler where id='$id'");
    $vhizmetler->execute();
    $vhizmet = $vhizmetler->fetch(PDO::FETCH_BOTH);

    $hizmet = $db->query("select * from hizmetler where id='{$vhizmet['hizmet_id']}'")->fetch();
    $musteri = $db->query("select * from musteriler where id='{$vhizmet['musteri_id']}'")->fetch();
    ?>
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">İş Düzenle</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">İş Düzenle</h6>
                        <form action="../set/code.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $id; ?>">
                            <div class="row mt-4">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Hizmet Adı:</label>
                                        <select class="form-control" required name="hizmet">
                                            <option value="<?= $hizmet['id']; ?>"><?= $hizmet['ad']; ?></option>
                                            <?php
                                            $hizmetler = $db->query("select * from hizmetler where id!='{$hizmet['id']}' order by id desc")->fetchAll();
                                            foreach ($hizmetler as $hizmet) { ?>
                                                <option value="<?= $hizmet['id']; ?>"><?= $hizmet['ad']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Müşteri :</label>
                                        <select class="form-control" required name="musteri">
                                            <option value="<?= $musteri['id']; ?>"><?= $musteri['ad']; ?></option>
                                            <?php
                                            $hizmetler = $db->query("select * from musteriler where id!='{$musteri['id']}' order by id desc")->fetchAll();
                                            foreach ($hizmetler as $hizmet) { ?>
                                                <option value="<?= $hizmet['id']; ?>"><?= $hizmet['ad']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Başlangıç Tarihi :</label>
                                        <input type="date" name="baslangic_tarihi" class="form-control"
                                               value="<?= $vhizmet['baslangic_tarihi']; ?>">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Bitiş Tarihi :</label>
                                        <input type="date" name="bitis_tarihi" class="form-control"
                                               value="<?= $vhizmet['bitis_tarihi']; ?>">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row mt-3">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-success submit" name="vhizmetduzenle">Düzenle
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
