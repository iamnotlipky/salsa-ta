<?php
if (isset($response) && @$response['response'] == "negative") { ?>
  <script>
    swal('Terjadi Kesalahan!', '<?php echo $response['alert'] ?>', 'error');
  </script>
<?php } else if (isset($response) && @$response['response'] == "positive") { ?>

  <script>
    swal({
      title: "Berhasil!",
      text: "",
      type: "success",
      showCancelButton: false,
      confirmButtonText: "Konfirmasi",
      closeOnConfirm: false,
      closeOnCancel: true
    }, function(isConfirm) {
      if (isConfirm) {
        window.location.href = "<?php echo $response['redirect'] ?>";
      }
    });
  </script>

<?php } ?>