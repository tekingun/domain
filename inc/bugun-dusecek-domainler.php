<?php
include 'sessions.php';
if ($_SESSION['oturum'] == "ok" && $_SESSION['username'] != "") {
    include 'header.php'; 
    ?>
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Bugün Düşecek Domainler</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Bugün Düşecek Domainler</h6>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Aranacak Kelime</label>
                                    <input type="text" name="arananan" id="arananTxt" class="form-control"
                                    autocomplete="off"
                                    placeholder="Örn: ticaret" required>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row mt-3">
                            <div class="col-sm-12 text-center">
                                <button type="button" onclick="ara();" class="btn btn-outline-success submit" name="domainAra">Ara</button>
                            </div>
                        </div>
                        <div id="domains" class="text-center">
                            <h6 class="control-label mt-5 d-none" id="spinnerTxt">Yükleniyor</h6>
                            <center><div class="spinner-border d-none" role="status" id="spinner"></center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require 'footer.php'; ?>
    <script type="text/javascript">
        function ara(){
            var aranan = document.getElementById('arananTxt').value;
            $.ajax({
                type: "POST",
                url: "../set/code.php",
                data: {'aranan': aranan},
                beforeSend: function()
                {
                    $('#spinner').removeClass('d-none');
                    $('#spinner').addClass('d-block');
                    $('#spinnerTxt').removeClass('d-none');
                    $('#spinnerTxt').addClass('d-block');
                },
                success: function (data) {
                    $('#domains').html(data);
                    $('#spinner').removeClass('d-block');
                    $('#spinner').addClass('d-none');
                    $('#spinnerTxt').removeClass('d-block');
                    $('#spinnerTxt').addClass('d-none');
                }
            });
        }
    </script>
<?php } else {
    echo "ERİŞİM İZNİ HATASI";
}
