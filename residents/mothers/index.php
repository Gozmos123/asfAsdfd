<?php
session_start();
if (!(isset($_SESSION['auth']))) {
    header('location: ../../login/');
    exit();
}
include('mothers.function.php');
include('mothers_page.php');
