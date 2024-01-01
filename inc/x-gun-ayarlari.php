<?php
include 'sessions.php';
if ($_SESSION['oturum'] == "ok" && $_SESSION['username'] != "") {
    include 'header.php'; 
    $xgun = $db->query("select * from xgun where id='0'")->fetch();
    ?>
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">X Gün Kaldığında SMS - Mail Gönder</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title"> X Gün Kaldığında SMS - Mail Gönder</h6>
                        <form action="../set/code.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Kaç Gün Kaldığında SMS Gönderilsin?</label>
                                        <input type="number" name="sms_xgun" class="form-control"
                                        autocomplete="off"
                                        value="<?=$xgun['sms_xgun'];?>" 
                                        placeholder="5" required>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Kaç Gün Kaldığında Mail Gönderilsin?</label>
                                        <input type="number" name="mail_xgun" class="form-control"
                                        autocomplete="off"
                                        value="<?=$xgun['mail_xgun'];?>" 
                                        placeholder="14" required>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->

                            <div class="row mt-5">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-5 text-center">
                                            <label for="sms_g" class="control-label mt-2">SMS Gönderilsin mi?</label>
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="checkbox" name="sms_g" id="sms_g" class="form-control" <?=$xgun['sms_g'] == 'on' ? 'checked' : ''; ?>>
                                        </div>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-5 text-center">
                                            <label for="mail_g" class="control-label mt-2">Mail Gönderilsin mi?</label>
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="checkbox" id="mail_g" name="mail_g" class="form-control" <?=$xgun['mail_g'] == 'on' ? 'checked' : ''; ?>>
                                        </div>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row mt-3">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-success submit" name="xgunduzenle">Düzenle</button>
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
