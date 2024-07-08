<?php

$rg = new lsp();
$table = "table_user";
$autokode = $rg->autokode($table, "kd_user", "US");
$data = $rg->select($table);

if (isset($_POST['btnInput'])) {
    $kd_user = $_POST['kd_user'];
    $nama_user = $_POST['nama_user'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $foto = $_FILES['foto'];
    $level = $_POST['level'];
    $redirect = "?page=data-user";


    if ($nama_user == "" || $username == "" || $password == "" || $confirm == "" || $level == "") {
        $response = ['response' => 'negative', 'alert' => 'Lengkapi Formulir!'];
    } else {
        $response = $rg->register($kd_user, $nama_user, $username, $password, $confirm, $foto, $level, $redirect);
    }
}

if (isset($_GET['delete'])) {
    $response = $rg->delete($table, "kd_user", $_GET['id'], "?page=data-user");
}

?>

<section class="au-breadcrumb m-t-75">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                        <div class="au-breadcrumb-left">
                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                <li class="list-inline-item active">
                                    <a href="#"><?= $auth['level']; ?></a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">Kelola Data User</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="statistic">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Input Data User</strong>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Kode User</label>
                                    <input style="color: red; font-weight: bold;" class="au-input au-input--full" type="text" name="kd_user" readonly value="<?= $autokode; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input class="au-input au-input--full" required type="text" name="nama_user" placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label>Nama Pengguna</label>
                                    <input class="au-input au-input--full" required type="text" name="username" placeholder="Nama Pengguna">
                                </div>
                                <div class="form-group">
                                    <label>Kata Sandi</label>
                                    <input class="au-input au-input--full" required type="password" name="password" placeholder="Kata Sandi">
                                </div>
                                <div class="form-group">
                                    <label>Konfirmasi Kata Sandi</label>
                                    <input class="au-input au-input--full" required type="password" name="confirm" placeholder="Konfirmasi Kata Sandi">
                                </div>
                                <div class="form-group">
                                    <label for="foto_karyawan" class="control-label mb-1">Foto</label>
                                    <input required type="file" name="foto" id="gambar" class="form-control-file">
                                    <div style="padding-top: 15px;">
                                        <img alt="" width="100" class="img-responsive" id="pict">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="level" class="control-label mb-1">Level</label>
                                    <select name="level" class="form-control mb-1">
                                        <option value="">Pilih Level</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Checker">Checker</option>
                                    </select>
                                </div>
                                <button name="btnInput" class="btn btn-primary m-b-20" type="submit">Konfirmasi</button>
                                <button name="btnRegister" class="btn btn-danger m-b-20" type="reset">Batal</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Data User</strong>
                        </div>
                        <div class="card-body">
                            <table id="myDataTables" class="table table-responsive table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Level</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data as $dataB) {
                                    ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $dataB['nama_user'] ?></td>
                                            <td><?= $dataB['level'] ?></td>
                                            <td><img width="60" src="img/<?= $dataB['foto_user'] ?>" alt="User"></td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <button id="btnDelete<?php echo $no; ?>" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <script src="assets/vendor/jquery-3.2.1.min.js"></script>
                                        <script>
                                            $('#btnDelete<?php echo $no; ?>').click(function(e) {
                                                e.preventDefault();
                                                swal({
                                                    title: "Hapus",
                                                    text: "Yakin Untuk menghapus?",
                                                    type: "error",
                                                    showCancelButton: true,
                                                    confirmButtonText: "Konfirmasi",
                                                    cancelButtonText: "Batal",
                                                    closeOnConfirm: false,
                                                    closeOnCancel: true
                                                }, function(isConfirm) {
                                                    if (isConfirm) {
                                                        window.location.href = "?page=data-user&delete&id=<?php echo $dataB['kd_user'] ?>";
                                                    }
                                                });
                                            });
                                        </script>
                                    <?php $no++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>