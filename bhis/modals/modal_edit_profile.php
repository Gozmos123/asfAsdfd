<?php
require_once('../model/CivilStatus.php');
require_once('../model/Religion.php');
require_once('../model/Purok.php');

$civil_status = new CivilStatus;
$all_civil_status = $civil_status->getCivilStatusAll();

$religions = new Religion;
$all_religion = $religions->getReligionAll();

$puroks = new Purok;
$all_purok = $puroks->getPurokAll();
?>

<div class="modal fade" id="modal_edit_profile" tabindex="-1" role="dialog" aria-labelledby="modalEditProfile" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditProfile"><strong>Edit Profile</strong></h5>
            </div>
            <form class="needs-validation" novalidate id="form_edit_profile" action="../functions/auth/UpdateProfile.php" method="post">
                <!-- username -->
                <input type="hidden" name="username" value="<?php echo  $_SESSION['auth'][0]['username']; ?>">

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" required value="<?php echo $user[0]['first_name']; ?>" name="first_name">
                            <div class="invalid-feedback">
                                Please enter your first name.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" value="<?php echo $user[0]['middle_name']; ?>" name="middle_name">
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" required value="<?php echo $user[0]['last_name']; ?>" name="last_name">
                            <div class="invalid-feedback">
                                Please enter your last name.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="prefix" class="form-label">Prefix</label>
                            <input type="text" class="form-control" id="prefix" value="<?php echo $user[0]['prefix']; ?>" placeholder="e.g. Jr." name="prefix">
                        </div>
                        <div class="col-md-6">
                            <label for="sex" class="form-label">Sex</label>
                            <select id="sex" class="form-select" required name="sex">
                                <option value="Male" <?php if (strtolower($user[0]['sex']) == "male") echo 'selected="selected"'; ?>>Male</option>
                                <option value="Female" <?php if (strtolower($user[0]['sex']) == "female") echo 'selected="selected"'; ?>>Female</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="birthdate" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="birthdate" required value="<?php echo $user[0]['birthdate']; ?>" name="birthdate">
                            <div class="invalid-feedback">
                                Please select a valid date.
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="birthplace" class="form-label">Place of Birth</label>
                            <input type="text" class="form-control" id="birthplace" required value="<?php echo $user[0]['birthplace']; ?>" name="birthplace">
                            <div class="invalid-feedback">
                                Please enter your place of birth.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="civil_status" class="form-label">Civil Status</label>
                            <select id="civil_status" class="form-select" required onchange="civil_status_change()" name="civil_status">
                                <?php
                                foreach ($all_civil_status as $status) {
                                ?>
                                    <option value="<?php echo $status['civil_status'] ?>" <?php if (strtolower($user[0]['civil_status']) == strtolower($status['civil_status'])) echo 'selected="selected"'; ?>><?php echo $status['civil_status'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6" id="otherStatus">
                            <label for="other_status" class="form-label">Other Status</label>
                            <input type="text" class="form-control" id="other_status" value="<?php echo $user[0]['other_status']; ?>" name="other_status">
                            <div class="invalid-feedback">
                                Please enter your civil status.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="religion" class="form-label">Religion</label>
                            <select id="religion" class="form-select" required name="religion">
                                <?php
                                foreach ($all_religion as $religion) {
                                ?>
                                    <option value="<?php echo $religion['religion_name'] ?>" <?php if (strtolower($user[0]['religion']) == strtolower($religion['religion_name'])) echo 'selected="selected"'; ?>><?php echo $religion['religion_name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="purok_name" class="form-label">Purok</label>
                            <select id="purok_name" class="form-select" required name="purok_name">
                                <?php
                                foreach ($all_purok as $purok) {
                                ?>
                                    <option value="<?php echo $purok['purok_name'] ?>" <?php if (strtolower($user[0]['purok_name']) == strtolower($purok['purok_name'])) echo 'selected="selected"'; ?>><?php echo $purok['purok_name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6" id="otherStatus">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="<?php echo $user[0]['email']; ?>" name="email">
                            <div class="invalid-feedback">
                                Please enter a valid email.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="contact_no" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="contact_no" pattern="[0-9]{11}" value="<?php echo $user[0]['contact_no']; ?>" name="contact_no">
                            <div class="invalid-feedback">
                                Please enter a valid phone number, ex: 09123456789.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" id="btn_close_edit_profile">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btn_update_profile" name="request_update_profile">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>