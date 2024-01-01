<?php
include 'sessions.php';
if ($_SESSION['oturum'] == "ok" && $_SESSION['username'] != "") {
    include 'header.php'; ?>
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">İş Ekle</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">İş Ekle</h6>
                        <form action="../set/code.php" method="POST" enctype="multipart/form-data">
                            <div class="row mt-4">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Hizmet Adı:</label>
                                        <select class="form-control" required name="hizmet">
                                            <option value="">HİZMET SEÇİNİZ</option>
                                            <?php
                                            $hizmetler = $db->query("select * from hizmetler order by id desc")->fetchAll();
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
                                            <option value="">MÜŞTERİ SEÇİNİZ</option>
                                            <?php
                                            $hizmetler = $db->query("select * from musteriler order by id desc")->fetchAll();
                                            foreach ($hizmetler as $hizmet) { ?>
                                                <option value="<?= $hizmet['id']; ?>"><?= $hizmet['ad']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Başlangıç Tarihi :</label>
                                        <input type="date" name="baslangic_tarihi" class="form-control" value="<?=date('Y-m-d');?>">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Bitiş Tarihi :</label>
                                        <input type="date" name="bitis_tarihi" class="form-control" value="<?=date('Y-m-d');?>">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row mt-3">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-success submit" name="vhizmetekle">Ekle
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
