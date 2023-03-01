<?php
session_start();
if (!(isset($_SESSION['auth']))) {
    header('location: ../../login/');
    exit();
}
include('childrens.function.php');
include('childrens_page.php');