<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location: ../index.php');
    exit();
}
require __DIR__ . '/Database.php';

class User extends Database
{
    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        $this->con->close();
    }
}
