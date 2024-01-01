<?php
include 'sessions.php';
if ($_SESSION['oturum'] == "ok" && $_SESSION['username'] != "") {
    include 'header.php';
    $smsBilgi = $db->query("select * from sms_ayar where id='0'")->fetch();
    ?>
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">SMS Ayarları Düzenle</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title"> SMS Ayarları Düzenle</h6>
                        <form action="../set/code.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Başlık <small>Firma tarafından size tanımlanan başlıktır.</small></label>
                                        <input type="text" name="baslik" class="form-control"
                                               placeholder="Örneğin: MERTKILIC" value="<?=$smsBilgi['baslik'];?>" required>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Api Key</label>
                                        <input type="password" name="apikey" class="form-control"
                                               placeholder="" required value="<?=$smsBilgi['apikey'];?>">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row mt-3">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-success submit" name="smsayarguncelle">Düzenle</button>
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
