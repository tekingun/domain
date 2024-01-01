<?php
include 'sessions.php';
if ($_SESSION['oturum'] == "ok" && $_SESSION['username'] != "") {
    include 'header.php';
    $mailBilgi = $db->query("select * from mail_ayar where id='0'")->fetch();
    ?>
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Mail Ayarları Düzenle</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title"> Mail Ayarları Düzenle</h6>
                        <form action="../set/code.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">STMP</label>
                                        <input type="text" name="smtp" class="form-control"
                                               placeholder="Örneğin: smtp.gmail.com" value="<?= $mailBilgi['smtp']; ?>"
                                               required>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">SMTP Secure</label>
                                        <input type="text" name="smtp_secure" class="form-control"
                                               placeholder="tls ya da ssl" required
                                               value="<?= $mailBilgi['smtp_secure']; ?>">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">Port</label>
                                        <input type="text" name="port" class="form-control"
                                               placeholder="587 ya da 463" required
                                               value="<?= $mailBilgi['port']; ?>">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Gönderilecek Mail Adresi</label>
                                        <input type="text" name="gonderen_mail" class="form-control"
                                               placeholder="Örneğin: mert@gmail.com"
                                               autocomplete="off"
                                               value="<?= $mailBilgi['gonderen_mail']; ?>" required>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Gönderilecek Mail Şifresi</label>
                                        <input type="password" name="gonderen_sifre" class="form-control"
                                               autocomplete="off"
                                               required value="<?= $mailBilgi['gonderen_sifre']; ?>">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row mt-3">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-success submit" name="mailayarguncelle">
                                        Düzenle
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
