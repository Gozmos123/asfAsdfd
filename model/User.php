<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location: ../index.php');
    exit();
}
require_once __DIR__ . '/Database.php';

class User extends Database
{
    public $username;
    public $user_type;
    public $photo;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $prefix;
    public $birthdate;
    public $age;
    public $sex;
    public $civil_status;
    public $other_status;
    public $birthplace;
    public $religion;
    public $email;
    public $contact_no;
    public $purok_name;

    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        $this->con->close();
    }

    function authenticateLogin($email, $password)
    {
        $result = array();

        $query = "select username, user_type, photo, first_name, middle_name, last_name, prefix, birthdate, age, sex, civil_status, other_status, birthplace, religion, email, contact_no, purok_name from users where username=? and password=sha2(?, 512)";
        $stmt = $this->con->stmt_init();

        if ($stmt->prepare($query)) {
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $que_result = $stmt->get_result();
            if ($que_result->num_rows === 1) {
                $result = $que_result->fetch_all(MYSQLI_ASSOC);
            } else {
                $result = null;
            }
        } else {
            $result = ['request_error' => 'Failed to process request.'];
        }
        $stmt->close();

        return $result;
    }

    function getUser_ByUsername($username)
    {
        $result = array();

        $query = "select * from users where username=?";
        $stmt = $this->con->stmt_init();

        if ($stmt->prepare($query)) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $que_result = $stmt->get_result();
            if ($que_result->num_rows > 0) {
                $result = $que_result->fetch_all(MYSQLI_ASSOC);
            } else {
                $result = null;
            }
        } else {
            $result = ['request_failed' => 'Failed to process request.'];
        }
        $stmt->close();
        return $result;
    }

    function updateUserProfile()
    {
        $query = "update users set first_name=?, middle_name=?, last_name=?, prefix=?, birthdate=?, age=?, sex=?, civil_status=?, other_status=?, birthplace=?, religion=?, email=?, contact_no=?, purok_name=?, updated_at=now() where username=?";
        $stmt = $this->con->stmt_init();

        if ($stmt->prepare($query)) {
            $stmt->bind_param('sssssisssssssss', $this->first_name, $this->middle_name, $this->last_name, $this->prefix, $this->birthdate, $this->age, $this->sex, $this->civil_status, $this->other_status, $this->birthplace, $this->religion, $this->email, $this->contact_no, $this->purok_name, $this->username);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        } else {
            $stmt->close();
            $result = array('request_failed' => 'Failed to process request.');
            return $result;
            exit();
        }
    }

    function updateUserPassword($username, $password)
    {
        $query = "update users set password=sha2(?, 512), updated_at=now() where username=?";
        $stmt = $this->con->stmt_init();

        if ($stmt->prepare($query)) {
            $stmt->bind_param('ss', $password, $username);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        } else {
            $stmt->close();
            $result = array('request_failed' => 'Failed to process request.');
            return $result;
            exit();
        }
    }
}
