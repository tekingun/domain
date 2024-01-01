<?php
include 'sessions.php';
if ($_SESSION['oturum'] == "ok" && $_SESSION['username'] != "") {
    include 'header.php'; ?>
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Müşteri Ekle</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title"> Müşteri Ekle</h6>
                        <form action="../set/code.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Müşteri Adı</label>
                                        <input type="text" name="ad" class="form-control"
                                               autocomplete="off"
                                               placeholder="Müşteri Adı" required>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Firma Adı</label>
                                        <input type="text" name="firma" class="form-control"
                                               autocomplete="off"
                                               placeholder="Firma Adı">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Müşteri Telefon Numarası</label>
                                        <input type="text" name="telefon" class="form-control"
                                               autocomplete="off"
                                               placeholder="Telefon No." required>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Müşteri Mail Adresi</label>
                                        <input type="email" name="mail" class="form-control"
                                               autocomplete="off"
                                               placeholder="Mail adresi" required>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Açıklama <small>İsteğe bağlı</small></label>
                                        <input type="text" name="aciklama" class="form-control"
                                               autocomplete="off"
                                               placeholder="Açıklama (isteğe bağlı)">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row mt-3">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-success submit" name="musteriekle">Ekle</button>
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
