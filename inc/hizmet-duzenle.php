<?php
include 'sessions.php';
if ($_SESSION['oturum'] == "ok" && $_SESSION['username'] != "") {
    $id = $_GET['q'];
    if ($id != "") {
        include 'header.php';
        $hizmetler = $db->prepare("select * from hizmetler where id='$id'");
        $hizmetler->execute();
        $hizmet = $hizmetler->fetch(PDO::FETCH_BOTH); ?>
        <div class="page-content">
            <nav class="page-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Hizmet Düzenle</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-md-12 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title"> Hizmet Düzenle</h6>
                            <form action="../set/code.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" value="<?=$id;?>" name="id">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label">Hizmet Adı</label>
                                            <input type="text" name="ad" class="form-control"
                                                   placeholder="Hizmet Adı" required value="<?= $hizmet['ad']; ?>">
                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->
                                <div class="row mt-3">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-success submit" name="hizmetduzenle">Düzenle
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
