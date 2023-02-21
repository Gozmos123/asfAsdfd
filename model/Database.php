<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location: ../index.php');
    exit();
}

class Database
{
    private $host = "localhost";
    private $user = "bhis_user";
    private $password = "user_BHIS_2023";
    private $dbname = "bhis";
    // private $port = 3306;
    // private $socket = "";
    public $con = "";

    function __construct()
    {
        $this->con = new mysqli($this->host, $this->user, $this->password, $this->dbname)
            or die('Could not connect to the database server' . mysqli_connect_error());
    }
}
