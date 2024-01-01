<?php
include 'sessions.php';
if ($_SESSION['oturum'] == "ok" && $_SESSION['username'] != "") {
    include 'header.php'; ?>
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Alan Adı Ekle</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Alan Adı Ekle</h6>
                        <form action="../set/code.php" method="POST" enctype="multipart/form-data">
                            <div class="row mt-4">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Müşteri :</label>
                                        <div class="row">
                                            <select class="form-control col-md-9 sbBoxm" required name="musteri">
                                                <option value="">MÜŞTERİ SEÇİNİZ</option>
                                                <?php
                                                $hizmetler = $db->query("select * from musteriler order by id desc")->fetchAll();
                                                foreach ($hizmetler as $hizmet) { ?>
                                                    <option value="<?= $hizmet['id']; ?>"><?= $hizmet['ad']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="col-md-1"></div>
                                            <input type="button"  class="gizlidivBtn btn btn-secondary btn-xs col-md-2" onclick="divGizleGoster();" 
                                            value="Kayıtlı Olmayan Müşteri">
                                        </div>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="gizlidiv d-none">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Müşteri Adı</label>
                                            <input type="text" name="m_ad" class="form-control m_ad"
                                            autocomplete="off"
                                            placeholder="Müşteri Adı">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Firma Adı</label>
                                            <input type="text" name="m_firma" class="form-control"
                                            autocomplete="off"
                                            placeholder="Firma Adı">
                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Müşteri Telefon Numarası</label>
                                            <input type="text" name="m_telefon" class="form-control"
                                            autocomplete="off"
                                            placeholder="Telefon No.">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Müşteri Mail Adresi</label>
                                            <input type="email" name="m_mail" class="form-control"
                                            autocomplete="off"
                                            placeholder="Mail adresi">
                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label">Açıklama <small>İsteğe bağlı</small></label>
                                            <input type="text" name="m_aciklama" class="form-control"
                                            autocomplete="off"
                                            placeholder="Açıklama (isteğe bağlı)">
                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Alan Adı :</label>
                                        <input type="text" name="domain" class="form-control" autocomplete="off" required>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row mt-3">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-success submit" name="domainekle">Ekle
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
    <script type="text/javascript">
        function divGizleGoster(){
            if($('.gizlidiv').hasClass('d-none')){
                $('.gizlidiv').removeClass('d-none');
                $('.gizlidiv').addClass('d-block');
                $('.gizlidivBtn').val("Gizle");
                $('.m_ad').prop('required',true);
                $('.m_telefon').prop('required',true);
                $('.m_mail').prop('required',true);
                $('.sbBoxm').prop('required',false);
            } else {
                $('.gizlidiv').removeClass('d-block');
                $('.gizlidiv').addClass('d-none');
                $('.gizlidivBtn').val("Kayıtlı Olmayan Müşteri");
                $('.m_ad').prop('required',false);
                $('.m_telefon').prop('required',false);
                $('.m_mail').prop('required',false);
                $('.sbBoxm').prop('required',true);
            }
        }
    </script>
<?php } else {
    echo "ERİŞİM İZNİ HATASI";
}
