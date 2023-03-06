<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location: ../../');
    exit();
}
require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../ActivityLog.php';

class Mother extends Database
{
    public $photo;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $birthdate;
    public $age;
    public $sex;
    public $civil_status;
    public $highest_educ_attainment;
    public $birthplace;
    public $religion;
    public $email;
    public $contact_no;
    public $purok_name;
    public $last_user;

    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        $this->con->close();
    }

    function getMothersAll()
    {
        $result = array();

        $query = "select * from mothers";
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

    function getMother_ByID($id)
    {
        $result = array();

        $query = "select * from mothers where id=?";
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
    function storeMother()
    {
        $query = "insert into mothers (photo, first_name, middle_name, last_name, birthdate, age, sex, civil_status, highest_educ_attainment, birthplace, religion, email, contact_no, purok_name, last_user)values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->con->stmt_init();

        if ($stmt->prepare($query)) {
            $stmt->bind_param('sssssisssssssss', $this->photo, $this->first_name, $this->middle_name, $this->last_name, $this->birthdate, $this->age, $this->sex, $this->civil_status, $this->highest_educ_attainment, $this->birthplace, $this->religion, $this->email, $this->contact_no, $this->purok_name, $this->last_user);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $stmt->close();

                $activity_log = new ActivityLog;
                $log = array(
                    'username' => $_SESSION['auth'][0]['username'],
                    'action' => 'Add New Mother',
                    'content' => 'Name: ' . $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name . ', Birthdate: ' . $this->birthdate . ', Birthplace: ' . $this->birthplace . ', Sex: ' . $this->sex . ', Civil Status: ' . $this->civil_status . ', Highest Education Attainment: ' . $this->highest_educ_attainment . ', Religion: ' . $this->religion . ', Purok: ' . $this->purok_name . ', Email: ' . $this->email . ', Contact Number: ' . $this->contact_no,
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
    function updateMother($id)
    {
        $query = "update mothers set photo=?, first_name=?, middle_name=?, last_name=?, birthdate=?, age=?, sex=?, civil_status=?, highest_educ_attainment=?, birthplace=?, religion=?, email=?, contact_no=?, purok_name=?, last_user=?, updated_at=now() where id=?";
        $stmt = $this->con->stmt_init();

        $mother = $this->getMother_ByID($id);

        if ($stmt->prepare($query)) {
            $stmt->bind_param('sssssisssssssssi', $this->photo, $this->first_name, $this->middle_name, $this->last_name, $this->birthdate, $this->age, $this->sex, $this->civil_status, $this->highest_educ_attainment, $this->birthplace, $this->religion, $this->email, $this->contact_no, $this->purok_name, $this->last_user, $id);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $stmt->close();

                $activity_log = new ActivityLog;
                $log = array(
                    'username' => $_SESSION['auth'][0]['username'],
                    'action' => 'Updated Mother Information',
                    'content' => 'Name: ' . $mother[0]['first_name'] . ' ' . $mother[0]['middle_name'] . ' ' . $mother[0]['last_name'] . ', Birthdate: ' . $mother[0]['birthdate'] . ', Birthplace: ' . $mother[0]['birthplace'] . ', Sex: ' . $mother[0]['sex'] . ', Civil Status: ' . $mother[0]['civil_status'] . ', Highest Educational Attainment: ' . $mother[0]['highest_educ_attainment'] . ', Religion: ' . $mother[0]['religion'] . ', Purok: ' . $mother[0]['purok_name'] . ', Email: ' . $mother[0]['email'] . ', Contact Number: ' . $mother[0]['contact_no'],
                    'changes' => 'Name: ' . $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name . ', Birthdate: ' . $this->birthdate . ', Birthplace: ' . $this->birthplace . ', Sex: ' . $this->sex . ', Civil Status: ' . $this->civil_status . ', Highest Educational Attainment: ' . $this->highest_educ_attainment . ', Religion: ' . $this->religion . ', Purok: ' . $this->purok_name . ', Email: ' . $this->email . ', Contact Number: ' . $this->contact_no
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
