<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location: ../../');
    exit();
}
require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../ActivityLog.php';
require_once __DIR__ . '/Mother.php';

class Children extends Database
{
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
    public $mother_id;
    public $last_user;

    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        $this->con->close();
    }

    function getChildrensAll()
    {
        $result = array();

        $query = "select childrens.id as cID, childrens.photo as cPhoto, childrens.first_name as cFirstName, childrens.middle_name as cMiddleName, childrens.last_name as cLastName, childrens.prefix as cPrefix, childrens.birthdate as cBirthdate, childrens.age as cAge, childrens.sex as cSex, childrens.civil_status as cCivilStatus, childrens.other_status as cOtherStatus, childrens.birthplace as cBirthplace, childrens.religion as cReligion, childrens.email as cEmail, childrens.contact_no as cContactNo, childrens.purok_name as cPurokName, childrens.mother_id as cMotherID, mothers.photo as mPhoto, mothers.first_name as mFirstName, mothers.middle_name as mMiddleName, mothers.last_name as mLastName from childrens inner join mothers on childrens.mother_id=mothers.id";
        $stmt = $this->con->stmt_init();

        if ($stmt->prepare($query)) {
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

    function getChildren_ByID($id)
    {
        $result = array();

        $query = "select * from childrens where id=?";
        $stmt = $this->con->stmt_init();

        if ($stmt->prepare($query)) {
            $stmt->bind_param('i', $id);
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

    function getChildren_ByMotherID($id)
    {
        $result = array();

        $query = "select childrens.id as cID, childrens.photo as cPhoto, childrens.first_name as cFirstName, childrens.middle_name as cMiddleName, childrens.last_name as cLastName, childrens.prefix as cPrefix, childrens.birthdate as cBirthdate, childrens.age as cAge, childrens.sex as cSex, childrens.civil_status as cCivilStatus, childrens.other_status as cOtherStatus, childrens.birthplace as cBirthplace, childrens.religion as cReligion, childrens.email as cEmail, childrens.contact_no as cContactNo, childrens.purok_name as cPurokName, childrens.mother_id as cMotherID, mothers.photo as mPhoto, mothers.first_name as mFirstName, mothers.middle_name as mMiddleName, mothers.last_name as mLastName from childrens inner join mothers on childrens.mother_id=mothers.id where mothers.id=?";
        $stmt = $this->con->stmt_init();

        if ($stmt->prepare($query)) {
            $stmt->bind_param('i', $id);
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

    // save new mother
    function storeChildren()
    {
        $query = "insert into childrens (photo, first_name, middle_name, last_name, prefix, birthdate, age, sex, civil_status, other_status, birthplace, religion, email, contact_no, purok_name, mother_id, last_user)values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->con->stmt_init();

        $mothers = new Mother;
        $mother = $mothers->getMother_ByID($this->mother_id);

        if ($stmt->prepare($query)) {
            $stmt->bind_param('sssssssssssssssis', $this->photo, $this->first_name, $this->middle_name, $this->last_name, $this->prefix, $this->birthdate, $this->age, $this->sex, $this->civil_status, $this->other_status, $this->birthplace, $this->religion, $this->email, $this->contact_no, $this->purok_name, $this->mother_id, $this->last_user);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $stmt->close();

                $activity_log = new ActivityLog;
                $log = array(
                    'username' => $_SESSION['auth'][0]['username'],
                    'action' => 'Add New Children',
                    'content' => 'Name: ' . $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name . ' ' . $this->prefix . ', Birthdate: ' . $this->birthdate . ', Birthplace: ' . $this->birthplace . ', Sex: ' . $this->sex . ', Civil Status: ' . $this->civil_status . ', Other Status: ' . $this->other_status . ', Religion: ' . $this->religion . ', Purok: ' . $this->purok_name . ', Email: ' . $this->email . ', Contact Number: ' . $this->contact_no . ', Mother: ' . $mother[0]['first_name'] . ' ' . $mother[0]['middle_name'] . ' ' . $mother[0]['last_name'],
                    'changes' => ''
                );
                $activity_log->storeLog($log);
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

    // save new mother
    function updateChildren($id)
    {
        $query = "update childrens set photo=?, first_name=?, middle_name=?, last_name=?, prefix=?, birthdate=?, age=?, sex=?, civil_status=?, other_status=?, birthplace=?, religion=?, email=?, contact_no=?, purok_name=?, last_user=?, updated_at=now() where id=?";
        $stmt = $this->con->stmt_init();

        $mothers = new Mother;
        $mother = $mothers->getMother_ByID($this->mother_id);

        $children = $this->getChildren_ByID($id);

        if ($stmt->prepare($query)) {
            $stmt->bind_param('ssssssssssssssssi', $this->photo, $this->first_name, $this->middle_name, $this->last_name, $this->prefix, $this->birthdate, $this->age, $this->sex, $this->civil_status, $this->other_status, $this->birthplace, $this->religion, $this->email, $this->contact_no, $this->purok_name, $this->last_user, $id);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $stmt->close();

                $activity_log = new ActivityLog;
                $log = array(
                    'username' => $_SESSION['auth'][0]['username'],
                    'action' => 'Updated Children Information',
                    'content' => 'Name: ' . $children[0]['first_name'] . ' ' . $children[0]['middle_name'] . ' ' . $children[0]['last_name'] . ' ' . $children[0]['prefix'] . ', Birthdate: ' . $children[0]['birthdate'] . ', Birthplace: ' . $children[0]['birthplace'] . ', Sex: ' . $children[0]['sex'] . ', Civil Status: ' . $children[0]['civil_status'] . ', Other Status: ' . $children[0]['other_status'] . ', Religion: ' . $children[0]['religion'] . ', Purok: ' . $children[0]['purok_name'] . ', Email: ' . $children[0]['email'] . ', Contact Number: ' . $children[0]['contact_no'] . ', Mother: ' . $mother[0]['first_name'] . ' ' . $mother[0]['middle_name'] . ' ' . $mother[0]['last_name'],
                    'changes' => 'Name: ' . $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name . ' ' . $this->prefix . ', Birthdate: ' . $this->birthdate . ', Birthplace: ' . $this->birthplace . ', Sex: ' . $this->sex . ', Civil Status: ' . $this->civil_status . ', Other Status: ' . $this->other_status . ', Religion: ' . $this->religion . ', Purok: ' . $this->purok_name . ', Email: ' . $this->email . ', Contact Number: ' . $this->contact_no . ', Mother: ' . $mother[0]['first_name'] . ' ' . $mother[0]['middle_name'] . ' ' . $mother[0]['last_name']
                );
                $activity_log->storeLog($log);
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
