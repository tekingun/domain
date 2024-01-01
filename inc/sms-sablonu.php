<?php
include 'sessions.php';
if ($_SESSION['oturum'] == "ok" && $_SESSION['username'] != "") {
    include 'header.php';
    $sablon = $db->query("select * from sablonlar where id='0'")->fetch();
    ?>
    <head>
        <style>
            hr {
                color: #d3d3d3;
                width: 90%;
            }
        </style>
    </head>
    <div class="page-content">
        <div class="float-right">
            <button type="button" class="btn btn-primary float-right btn-xs" data-toggle="modal"
                    data-target="#exampleModal">
                Sözlük için tıklayınız
            </button>
        </div>
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">SMS Şablonu</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title mb-5"> SMS Şablonu Düzenle</h6>

                        <div class="col-md-12">
                            <label>Bu şablon alan adları için hazırlanmıştır. Şablonda kullanım için ilgili değişkenler
                                tanımlanmıştır.
                                Eksik ya da hatalı girilmesi halinde çalışmayacaktır.</label>
                        </div>
                        <form action="../set/code.php" method="POST" enctype="multipart/form-data">
                            <div class="email editor mt-3 mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="col-md-2"><u>SMS Şablonu:</u></label>
                                        <textarea class="form-control" name="sms_sablon" id="simpleMdeEditor"
                                                  rows="5"><?=$sablon['sms_sablon'];?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-success submit"
                                            name="smssablonkaydet">Kaydet
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sözlük</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <label for="">Müşteri Adı Soyad:</label>
                            <label for="">{musteri}</label>
                        </div>
                        <hr>
                        <div class="col-md-12 text-center">
                            <label for="">Domain:</label>
                            <label for="">{domain}</label>
                        </div>
                        <hr>
                        <div class="col-md-12 text-center">
                            <label for="">Bitiş Tarihi:</label>
                            <label for="">{bitis}</label>
                        </div>
                        <hr>
                        <div class="col-md-12 text-center">
                            <label for="">Kalan Gün:</label>
                            <label for="">{kalan_gun}</label>
                        </div>
                        <hr>
                        <div class="col-md-12 text-center">
                            <label for="">SSL Durumu:</label>
                            <label for="">{ssl_durum}</label>
                        </div>
                        <hr>
                        <div class="col-md-12 text-center">
                            <label for="">SSL Kalan Gün:</label>
                            <label for="">{ssl_kalangun}</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>
    <?php require 'footer.php'; ?>
<?php } else {
    echo "ERİŞİM İZNİ HATASI";
}

