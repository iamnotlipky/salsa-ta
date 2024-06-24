<?php

$function = new lsp();

session_start();

$auth = $function->AuthUser($_SESSION['username']);

$response = $function->sessionCheck();
if ($response == "false") {
    header("location:index.php");
}
if (isset($_GET['logout'])) {
    $function->logout();
}
