<?php

session_start();

$login = new lsp();

if ($login->sessionCheck() == "true") {
    if ($_SESSION['level'] == "Admin") {
        header("location:pageAdmin.php");
    } else if ($_SESSION['level'] == "Manager") {
        header("location:pageManager.php");
    } else if ($_SESSION['level'] == "Checker") {
        header("location:checker-panel.php");
    }
}

if (isset($_POST['button-login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($response = $login->login($username, $password)) {
        if ($response['response'] == "positive") {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['level'] = $response['level'];
            if ($response['level'] == "Admin") {
                $response = $login->redirect("pageAdmin.php");
            } else if ($response['level'] == "Manager") {
                $response = $login->redirect("pageManager.php");
            } else if ($response['level'] == "Checker") {
                $response = $login->redirect("checker-panel.php");
            }
        }
    }
}
