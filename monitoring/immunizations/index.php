<?php
session_start();
if (!(isset($_SESSION['auth']))) {
    header('location: ../../login/');
    exit();
}
include('immunizations.function.php');
include('immunizations_page.php');
