<?php
include 'sessions.php';
if ($_SESSION['oturum'] == "ok" && $_SESSION['username'] != "") {
    include 'header.php'; ?>
    <div class="page-content">

        <div class="float-right">
            <a class="btn btn-primary float-right" href="v-hizmet-ekle.php">Ekle
            </a>
        </div>
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">İş Listesi</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">İş Listesi</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr class="text-center">
                                    <th>Hizmet Adı</th>
                                    <th>Müşteri Adı / Firma Adı</th>
                                    <th>Hizmet Başlangıç / Bitiş Tarihi</th>
                                    <th>Kalan Gün</th>
                                    <th>İşlem</th>
                                    <th>Sil</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $vhizmetler = $db->prepare("select * from vhizmetler order by id desc");
                                $vhizmetler->execute();
                                while ($vhizmet = $vhizmetler->fetch(PDO::FETCH_BOTH)) {
                                    $tarih1 = new DateTime($vhizmet['bitis_tarihi']);
                                    $tarih2 = new DateTime($vhizmet['baslangic_tarihi']);
                                    $interval = $tarih1->diff($tarih2);
                                    $musteriBilgisi = $db->query("select * from musteriler where id='{$vhizmet['musteri_id']}'")->fetch();
                                    $hizmetBilgisi = $db->query("select * from hizmetler where id='{$vhizmet['hizmet_id']}'")->fetch();
                                    ?>
                                    <tr class="gradeX text-center">
                                        <td><?= $hizmetBilgisi['ad']; ?></td>
                                        <td><?= $musteriBilgisi['ad'] . " / " . $musteriBilgisi['firma']; ?></td>
                                        <td><?= $vhizmet['baslangic_tarihi'] . " / " . $vhizmet['bitis_tarihi']; ?></td>
                                        <td><?= $interval->format('%a gün kaldı.'); ?></td>

                                        <td class="text-center">
                                            <!-- Default dropleft button -->
                                            <div class="btn-group dropleft">
                                                <button type="button" class="btn btn-secondary dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    İşlem
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                       href="v-hizmet-sms-gonder.php?q=<?= $vhizmet['id']; ?>">SMS
                                                        Gönder</a>
                                                    <a class="dropdown-item"
                                                       href="v-hizmet-mail-gonder.php?q=<?= $vhizmet['id']; ?>">Mail
                                                        Gönder</a>
                                                    <a class="dropdown-item"
                                                       href="v-hizmet-duzenle.php?q=<?= $vhizmet['id']; ?>">Düzenle</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:void(0);" onclick="vhizmetsil('<?= $vhizmet[0]; ?>')"
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
    <script type="text/javascript">
        function vhizmetsil(id) {
            Swal.fire({
                title: 'Hizmeti Sil',
                text: "Hizmeti silmek istediğinize emin misiniz?",
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
                        data: {'id': id, 'vhizmetsil': 'vhizmetsil'},
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
