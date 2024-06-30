<?php

require_once "../config/config.php";
require_once "../functions/functions.php";
require_once "../functions/login.php";

if (isset($_POST['button-login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($response = $login->login($username, $password)) {
        if ($response['response'] == "positive") {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['level'] = $response['level'];
            if ($response['level'] == "Admin") {
                $response = $login->redirect("admin-panel.php");
            } else if ($response['level'] == "Manager") {
                $response = $login->redirect("manager-panel.php");
            } else if ($response['level'] == "Checker") {
                $response = $login->redirect("checker-panel.php");
            }
        }
    }
}

include "templates/login-header.php";

?>

<div class="page-wrapper-sid">
    <div class="page-content--sid">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <a href="index.php">
                            <img src="assets/img/icon/logo-sid.webp" alt="logo" class="w-75">
                        </a>
                    </div>
                    <div class="login-form">
                        <form action="" method="post">
                            <div class="form-group">
                                <label>Nama Pengguna</label>
                                <input class="au-input au-input--full" type="text" name="username" placeholder="Nama Pengguna">
                            </div>
                            <div class="form-group">
                                <label>Kata Sandi</label>
                                <input class="au-input au-input--full" type="password" name="password" placeholder="Kata Sandi">
                            </div>
                            <button type="submit" name="button-login" class="au-btn au-btn--block au-btn--green m-b-20">login</button>
                        </form>
                        <div class="copyright-sid">
                            <p>
                                Warehouse PT SID made by Aulia Salsabila
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "templates/login-footer.php"; ?>