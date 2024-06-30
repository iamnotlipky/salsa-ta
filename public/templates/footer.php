<!-- Footer -->
<footer class="footer-sid print-sid">
    <p>&copy; Modern Warehouse Design By Aulia Salsabila</p>
</footer>

<!-- Jquery JS-->
<script src="assets/vendor/jquery-3.2.1.min.js"></script>

<!-- Datatables JS -->
<script src="assets/datatables/js/datatables.min.js"></script>

<!-- Bootstrap JS-->
<script src="assets/vendor/bootstrap-4.1/popper.min.js"></script>
<script src="assets/vendor/bootstrap-4.1/bootstrap.min.js"></script>

<!-- Vendor JS-->
<script src="assets/vendor/slick/slick.min.js"></script>
<script src="assets/vendor/wow/wow.min.js"></script>
<script src="assets/vendor/animsition/animsition.min.js"></script>
<script src="assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<script src="assets/vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="assets/vendor/counter-up/jquery.counterup.min.js"></script>
<script src="assets/vendor/circle-progress/circle-progress.min.js"></script>
<script src="assets/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="assets/vendor/chartjs/Chart.bundle.min.js"></script>
<script src="assets/vendor/select2/select2.min.js"></script>
<script src="assets/vendor/vector-map/jquery.vmap.js"></script>
<script src="assets/vendor/vector-map/jquery.vmap.min.js"></script>
<script src="assets/vendor/vector-map/jquery.vmap.sampledata.js"></script>
<script src="assets/vendor/vector-map/jquery.vmap.world.js"></script>

<!-- Main JS-->
<script src="assets/js/main.js"></script>
<script src="assets/js/sweetalert.min.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>

<!-- SID JS -->
<script>
    $(document).ready(function() {
        function preview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#pict').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $('#gambar').change(function() {
            preview(this);
        })
    });
</script>
<script>
    $(document).ready(function() {
        function preview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#pict2').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $('#gambar2').change(function() {
            preview(this);
        })
    });
</script>
<script>
    $(document).ready(function() {
        $('#forLogout').click(function(e) {
            e.preventDefault();
            swal({
                title: "Keluar",
                text: "Keluar dari Halaman <?= $auth['level']; ?>?",
                type: "info",
                showCancelButton: true,
                confirmButtonText: "Konfirmasi",
                cancelButtonText: "Tidak",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {
                    window.location.href = "?logout";
                }
            });
        });
    })
</script>
<script>
    $(document).ready(function() {
        $('#myDataTables').DataTable();
    });
</script>

<!-- Other Functions -->
<?php include "../functions/success-alert.php"; ?>

</body>

</html>