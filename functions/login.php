<?php

session_start();

$login = new lsp();

if ($login->sessionCheck() == "true") {
    if ($_SESSION['level'] == "Admin") {
        header("location:admin-panel.php");
    } else if ($_SESSION['level'] == "Manager") {
        header("location:manager-panel.php");
    } else if ($_SESSION['level'] == "Checker") {
        header("location:checker-panel.php");
    }
}
