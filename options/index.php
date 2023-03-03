<?php
session_start();
if (!(isset($_SESSION['auth']))) {
    header('location: ../login/');
    exit();
} else {
    if (!($_SESSION['auth'][0]['user_type'] == "administrator")) {
        header('location: ../dashboard/');
        exit();
    }
}
include('options.function.php');
include('options_page.php');
