<?php
include 'sessions.php';
if ($_SESSION['oturum'] == "ok" && $_SESSION['username'] != "") {
    include 'header.php'; ?>
    <div class="page-content">

        <div class="float-right">
            <a href="hizmet-ekle.php" class="btn btn-primary float-right">Ekle
            </a>
        </div>
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Hizmet Listesi</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Hizmet Listesi</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr class="text-center">
                                    <th>Hizmet Adı</th>
                                    <th>Düzenle</th>
                                    <th>Sil</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $hizmetler = $db->prepare("select * from hizmetler order by id desc");
                                $hizmetler->execute();
                                while ($hizmet = $hizmetler->fetch(PDO::FETCH_BOTH)) {
                                    ?>
                                    <tr class="gradeX text-center">
                                        <td><?= $hizmet['ad']; ?></td>

                                        <td class="text-center">
                                            <a href="hizmet-duzenle.php?q=<?= $hizmet['id']; ?>"
                                               class="btn btn-primary">
                                                Düzenle
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:void(0);" onclick="hizmetsil('<?= $hizmet[0]; ?>')"
                                               class="btn btn-danger mb-1 mb-md-0">
                                                Sil
                                            </a>
                                        </td>
                                    </tr>
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
                                <p class="mb-3 mt-2">Hizmet Adı</p>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="ad">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                        <button type="submit" name="hizmetekle" class="btn btn-success">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function hizmetsil(id) {
            Swal.fire({
                title: 'Hizmet Sil',
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
                        data: {'id': id, 'hizmetsil': 'hizmetsil'},
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
