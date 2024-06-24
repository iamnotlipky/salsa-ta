<?php
function set_flash_message($type, $message)
{
    $_SESSION['flash_message'] = [
        'type' => $type,
        'message' => $message
    ];
}

function display_flash_message()
{
    if (isset($_SESSION['flash_message'])) {
        $type = $_SESSION['flash_message']['type'];
        $message = $_SESSION['flash_message']['message'];

        echo "<div class='alert alert-{$type}'>{$message}</div>";

        unset($_SESSION['flash_message']);
    }
}
