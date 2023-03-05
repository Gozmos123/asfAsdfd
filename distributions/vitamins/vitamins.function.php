<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header("location: ../vitamins/");
    exit();
}
require __DIR__ . '/../../model/distributions/Vitamin.php';
require __DIR__ . '/../../model/Secure.php';

if (isset($_SESSION['auth'])) {

    if (isset($_POST['request_save_vitamin'])) {
        if (!(isset($_POST['selected']))) {
            echo json_encode('no_selected');
            exit();
        }
        $vitamin = new Vitamin;

        $selected_childrens = $_POST['selected'];
        $date_given = mysqli_real_escape_string($vitamin->con, $_POST['date_given']);
        $given_by = mysqli_real_escape_string($vitamin->con, $_POST['given_by']);

        $result = $vitamin->storeVitamin($selected_childrens, $date_given, $given_by);

        if (array_key_exists('request_failed', (array) $result)) {
            echo json_encode('request_failed');
            exit();
        }

        if (!($result == null)) {
            echo json_encode('true');
            exit();
        } else {
            echo json_encode("false");
            exit();
        }
        exit();
    }
} else {
    header('location: ../../login/');
    exit();
}
