<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header("location: ../options/");
    exit();
}

require __DIR__ . '/../model/CivilStatus.php';
require __DIR__ . '/../model/ImmunizationType.php';
require __DIR__ . '/../model/Purok.php';
require __DIR__ . '/../model/Religion.php';

if (isset($_SESSION['auth'])) {
    if (isset($_POST['request_civil_status'])) {
        $object = new CivilStatus;

        $id = mysqli_real_escape_string($object->con, $_POST['id']);

        $result = $object->getCivilStatus_ByID($id);

        if (is_array($result) && array_key_exists('request_failed', (array)$result)) {
            echo json_encode('request_failed');
            exit();
        }

        if ($result) {
            $data = array();
            foreach ($result as $row) {
                $data = $row;
            }
            echo json_encode($data);
            exit();
        } else {
            echo json_encode('false');
            exit();
        }
    }

    if (isset($_POST['request_immunization_type'])) {
        $object = new ImmunizationType;

        $id = mysqli_real_escape_string($object->con, $_POST['id']);

        $result = $object->getImmunizationsType_ByID($id);

        if (is_array($result) && array_key_exists('request_failed', (array)$result)) {
            echo json_encode('request_failed');
            exit();
        }

        if ($result) {
            $data = array();
            foreach ($result as $row) {
                $data = $row;
            }
            echo json_encode($data);
            exit();
        } else {
            echo json_encode('false');
            exit();
        }
    }

    if (isset($_POST['request_religion'])) {
        $object = new Religion;

        $id = mysqli_real_escape_string($object->con, $_POST['id']);

        $result = $object->getReligion_ByID($id);

        if (is_array($result) && array_key_exists('request_failed', (array)$result)) {
            echo json_encode('request_failed');
            exit();
        }

        if ($result) {
            $data = array();
            foreach ($result as $row) {
                $data = $row;
            }
            echo json_encode($data);
            exit();
        } else {
            echo json_encode('false');
            exit();
        }
    }

    if (isset($_POST['request_purok'])) {
        $object = new Purok;

        $id = mysqli_real_escape_string($object->con, $_POST['id']);

        $result = $object->getPurok_ByID($id);

        if (is_array($result) && array_key_exists('request_failed', (array)$result)) {
            echo json_encode('request_failed');
            exit();
        }

        if ($result) {
            $data = array();
            foreach ($result as $row) {
                $data = $row;
            }
            echo json_encode($data);
            exit();
        } else {
            echo json_encode('false');
            exit();
        }
    }

    if (isset($_POST['civil_status_exist'])) {
        $object = new CivilStatus;

        $value = mysqli_real_escape_string($object->con, $_POST['value']);

        $result = $object->civilStatus_Exist($value);

        if (is_array($result) && array_key_exists('request_failed', (array)$result)) {
            echo json_encode('request_failed');
            exit();
        }

        if ($result) {
            echo json_encode('true');
            exit();
        } else {
            echo json_encode('false');
            exit();
        }
    }

    if (isset($_POST['immunizationType_exist'])) {
        $object = new ImmunizationType;

        $value = mysqli_real_escape_string($object->con, $_POST['value']);

        $result = $object->immunizationType_Exist($value);

        if (is_array($result) && array_key_exists('request_failed', (array)$result)) {
            echo json_encode('request_failed');
            exit();
        }

        if ($result) {
            echo json_encode('true');
            exit();
        } else {
            echo json_encode('false');
            exit();
        }
    }

    if (isset($_POST['religion_exist'])) {
        $object = new Religion;

        $value = mysqli_real_escape_string($object->con, $_POST['value']);

        $result = $object->religion_Exist($value);

        if (is_array($result) && array_key_exists('request_failed', (array)$result)) {
            echo json_encode('request_failed');
            exit();
        }

        if ($result) {
            echo json_encode('true');
            exit();
        } else {
            echo json_encode('false');
            exit();
        }
    }

    if (isset($_POST['purok_exist'])) {
        $object = new Purok;

        $value = mysqli_real_escape_string($object->con, $_POST['value']);

        $result = $object->purok_Exist($value);

        if (is_array($result) && array_key_exists('request_failed', (array)$result)) {
            echo json_encode('request_failed');
            exit();
        }

        if ($result) {
            echo json_encode('true');
            exit();
        } else {
            echo json_encode('false');
            exit();
        }
    }

    // add civil status
    if (isset($_POST['request_add_civil_status'])) {
        $object = new CivilStatus;

        $civil_status = ucwords(mysqli_real_escape_string($object->con, $_POST['civil_status']));
        $result = $object->storeCivilStatus($civil_status);

        if (is_array($result) && array_key_exists('request_failed', (array)$result)) {
            echo json_encode('request_failed');
            exit();
        }

        if ($result) {
            echo json_encode('true');
            exit();
        } else {
            echo json_encode('false');
            exit();
        }
    }

    // update civil status
    if (isset($_POST['request_update_civil_status'])) {
        $object = new CivilStatus;

        $id = mysqli_real_escape_string($object->con, $_POST['id']);
        $civil_status = mysqli_real_escape_string($object->con, $_POST['civil_status']);

        $values = array(
            'id' => $id,
            'civil_status' => ucwords($civil_status)
        );

        $result = $object->updateCivilStatus($values);

        if (is_array($result) && array_key_exists('request_failed', (array)$result)) {
            echo json_encode('request_failed');
            exit();
        }

        if ($result) {
            echo json_encode('true');
            exit();
        } else {
            echo json_encode('false');
            exit();
        }
    }

    // add immunetype
    if (isset($_POST['request_add_immune'])) {
        $object = new ImmunizationType;

        $immune_type = ucwords(mysqli_real_escape_string($object->con, $_POST['immune_type']));

        $result = $object->store($immune_type);

        if (is_array($result) && array_key_exists('request_failed', (array)$result)) {
            echo json_encode('request_failed');
            exit();
        }

        if ($result) {
            echo json_encode('true');
            exit();
        } else {
            echo json_encode('false');
            exit();
        }
    }

    // update immuneitype
    if (isset($_POST['request_update_immune'])) {
        $object = new ImmunizationType;

        $id = mysqli_real_escape_string($object->con, $_POST['id']);
        $immune_type = mysqli_real_escape_string($object->con, $_POST['immune_type']);

        $values = array(
            'id' => $id,
            'immunization_type' => ucwords($immune_type)
        );

        $result = $object->update($values);

        if (is_array($result) && array_key_exists('request_failed', (array)$result)) {
            echo json_encode('request_failed');
            exit();
        }

        if ($result) {
            echo json_encode('true');
            exit();
        } else {
            echo json_encode('false');
            exit();
        }
    }

    // add religion
    if (isset($_POST['request_add_religion'])) {
        $object = new Religion;

        $religion = ucwords(mysqli_real_escape_string($object->con, $_POST['religion_name']));

        $result = $object->store($religion);

        if (is_array($result) && array_key_exists('request_failed', (array)$result)) {
            echo json_encode('request_failed');
            exit();
        }

        if ($result) {
            echo json_encode('true');
            exit();
        } else {
            echo json_encode('false');
            exit();
        }
    }

    // update religion
    if (isset($_POST['request_update_religion'])) {
        $object = new Religion;

        $id = mysqli_real_escape_string($object->con, $_POST['id']);
        $religion = mysqli_real_escape_string($object->con, $_POST['religion_name']);

        $values = array(
            'id' => $id,
            'religion_name' => ucwords($religion)
        );

        $result = $object->update($values);

        if (is_array($result) && array_key_exists('request_failed', (array)$result)) {
            echo json_encode('request_failed');
            exit();
        }

        if ($result) {
            echo json_encode('true');
            exit();
        } else {
            echo json_encode('false');
            exit();
        }
    }

    // add purok
    if (isset($_POST['request_add_purok'])) {
        $object = new Purok;

        $purok_name = ucwords(mysqli_real_escape_string($object->con, $_POST['purok_name']));

        $result = $object->store($purok_name);

        if (is_array($result) && array_key_exists('request_failed', (array)$result)) {
            echo json_encode('request_failed');
            exit();
        }

        if ($result) {
            echo json_encode('true');
            exit();
        } else {
            echo json_encode('false');
            exit();
        }
    }

    // update purok
    if (isset($_POST['request_update_purok'])) {
        $object = new Purok;

        $id = mysqli_real_escape_string($object->con, $_POST['id']);
        $purok_name = mysqli_real_escape_string($object->con, $_POST['purok_name']);

        $values = array(
            'id' => $id,
            'purok_name' => ucwords($purok_name)
        );

        $result = $object->update($values);

        if (is_array($result) && array_key_exists('request_failed', (array)$result)) {
            echo json_encode('request_failed');
            exit();
        }

        if ($result) {
            echo json_encode('true');
            exit();
        } else {
            echo json_encode('false');
            exit();
        }
    }
} else {
    header("location: ../login/");
    exit();
}
