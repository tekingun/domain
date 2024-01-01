
</div>
</div>

<!-- core:js -->
<script src="../assets/vendors/core/core.js"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<script src="../assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="../assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<!-- end plugin js for this page -->
<!-- inject:js -->
<script src="../assets/vendors/feather-icons/feather.min.js"></script>
<script src="../assets/js/template.js"></script>
<!-- endinject -->
<!-- custom js for this page -->
<script src="../assets/js/data-table.js"></script>
<!-- end custom js for this page -->
</body>
</html>
<!-- plugin js for this page -->
<script src="../assets/vendors/sweetalert2/sweetalert2.min.js"></script>
<script src="../assets/vendors/promise-polyfill/polyfill.min.js"></script> <!-- Optional:  polyfill for ES6 Promises for IE11 and Android browser -->
<!-- custom js for this page -->
<script src="../assets/js/sweet-alert.js"></script>
<?php if (@$_GET['q'] == "bos") { ?>
    <script>
        Swal.fire(
            'Oops !',
            'Boş alan bırakmayınız !',
            'error'
        )
    </script>
<?php } else if (@$_GET['q'] == 'ok') { ?>
    <script>
        Swal.fire(
            'Başarılı',
            'İşlem başarılı !',
            'success'
        )
    </script>
<?php } else if (@$_GET['q'] == 'no') { ?>
    <script>
        Swal.fire(
            'Oops !',
            'Yolunda gitmeyen bir şeyler var ! İşlemi tekrar deneyiniz.',
            'error'
        )
    </script>
<?php } ?>

