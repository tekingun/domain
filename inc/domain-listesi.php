<?php
include 'sessions.php';
if ($_SESSION['oturum'] == "ok" && $_SESSION['username'] != "") {
    include 'header.php'; ?>
    <div class="page-content">

        <div class="float-right">
            <a class="btn btn-primary float-right" href="domain-ekle.php">Ekle
            </a>
        </div>
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Domain Listesi</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Domain Listesi</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr class="text-center">
                                    <th>Domain Adı</th>
                                    <th>Müşteri Adı / Firma Adı</th>
                                    <th>Bitiş Tarihi / Kalan Gün</th>
                                    <th>SSL Durumu / Kalan Gün</th>
                                    <th>İşlem</th>
                                    <th>Sil</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $domains = $db->prepare("select * from domainler order by id desc");
                                $domains->execute();
                                while ($domain = $domains->fetch(PDO::FETCH_BOTH)) {
                                    $musteriBilgisi = $db->query("select * from musteriler where id='{$domain['musteri_id']}'")->fetch();
                                    $tarih1 = new DateTime(date('Y-m-d'));
                                    $tarih2 = new DateTime($domain['bitis_tarihi']);
                                    $interval = $tarih1->diff($tarih2);
                                    ?>
                                    <tr class="gradeX text-center">
                                        <td><?= $domain['domain']; ?></td>
                                        <td>
                                            <?= $musteriBilgisi['ad']; ?>
                                            <?php if ($musteriBilgisi['firma'] != "") {
                                                echo " / " . $musteriBilgisi['firma'];
                                            }; ?>
                                        </td>
                                        <td>
                                            <?= $domain['bitis_tarihi']; ?>
                                            /
                                            <?= $interval->format('%a gün kaldı.'); ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($domain['ssl_durum'] == '1') {
                                                echo '<div class="badge badge-pill badge-success ml-auto">Aktif</div> ' . " - " . '<div class="badge badge-pill badge-success ml-auto">' . $domain['ssl_kalangun'] . ' Gün</div>';
                                            } else {
                                                echo '<div class="badge badge-pill badge-danger ml-auto">Pasif</div> ' . " / " . $domain['ssl_kalangun'] . " Gün";
                                            } ?>
                                        </td>

                                        <td class="text-center">
                                            <div class="btn-group dropleft">
                                                <button type="button" class="btn btn-secondary dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    İşlem
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                       href="domain-sms-gonder.php?q=<?= $domain['id']; ?>">SMS
                                                        Gönder</a>
                                                    <a class="dropdown-item"
                                                       href="domain-mail-gonder.php?q=<?= $domain['id']; ?>">Mail
                                                        Gönder</a>
                                                    <a class="dropdown-item"
                                                       href="domain-duzenle.php?q=<?= $domain['id']; ?>">Düzenle</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:void(0);" onclick="domainsil('<?= $domain[0]; ?>')"
                                               class="btn btn-danger mb-1 mb-md-0">
                                                Sil
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <div class="modal fade" id="exampleModal-ekle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Domain ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../set/code.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <p class="mb-3 mt-2">Domain Adı</p>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="domain">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <p class="mb-3 mt-2">Firma Adı</p>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="firma_adi">
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="form-check form-check-flat form-check-primary">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="durum">
                                        Durum
                                        <i class="input-frame"></i></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                        <button type="submit" name="domainekle" class="btn btn-success">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function domainsil(id) {
            Swal.fire({
                title: 'Domaini Sil',
                text: "Domaini silmek istediğinize emin misiniz?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet, sil',
                cancelButtonText: 'Hayır, silme'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '../set/code.php',
                        method: 'post',
                        data: {'id': id, 'domainsil': 'domainsil'},
                        success: function (e) {
                            if (e == 1) {
                                window.location = "?q=ok";
                            } else {
                                window.location = "?q=no";
                            }
                        }
                    });
                }
            })
        }
    </script>
    <?php include 'footer.php';
} else {
    echo "ERİŞİM İZNİ HATASI";
}
