<?php
require_once('../../model/CivilStatus.php');
require_once('../../model/Religion.php');
require_once('../../model/Purok.php');

$civil_status = new CivilStatus;
$all_civil_status = $civil_status->getCivilStatusAll();

$religions = new Religion;
$all_religion = $religions->getReligionAll();

$puroks = new Purok;
$all_purok = $puroks->getPurokAll();
?>

<div class="modal fade" id="modal_edit_mother" tabindex="-1" role="dialog" aria-labelledby="modalEditMother" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditMother"><strong>Edit Mother</strong></h5>
            </div>
            <form class="needs-validation" novalidate action="index.php" method="post">
                <!-- username -->
                <input type="hidden" name="id" id="edit_id" value="" required>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="edit_first_name" required value="" name="first_name">
                            <div class="invalid-feedback">
                                Please enter first name.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="edit_middle_name" value="" name="middle_name">
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="edit_last_name" required value="" name="last_name">
                            <div class="invalid-feedback">
                                Please enter last name.
                            </div>
                        </div>
                        <input type="hidden" name="sex" value="Female" id="edit_sex" required>
                        <!-- <div class="col-md-6">
                            <label for="prefix" class="form-label">Prefix</label>
                            <input type="text" class="form-control" id="prefix" value="" placeholder="e.g. Jr." name="prefix">
                        </div> -->
                        <!-- <div class="col-md-6">
                            <label for="sex" class="form-label">Sex</label>
                            <select id="sex" class="form-select" required name="sex">
                                <option value="Female">Female</option>
                            </select>
                        </div> -->
                        <div class="col-md-6">
                            <label for="birthdate" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="edit_birthdate" required value="" name="birthdate">
                            <div class="invalid-feedback">
                                Please select a valid date.
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="birthplace" class="form-label">Place of Birth</label>
                            <input type="text" class="form-control" id="edit_birthplace" required value="" name="birthplace">
                            <div class="invalid-feedback">
                                Please enter place of birth.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="civil_status" class="form-label">Civil Status</label>
                            <select id="edit_civil_status" class="form-select" required onchange="civil_status_change()" name="civil_status">
                                <?php
                                foreach ($all_civil_status as $status) {
                                ?>
                                    <option value="<?php echo $status['civil_status'] ?>"><?php echo $status['civil_status'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6" id="otherStatus">
                            <label for="other_status" class="form-label">Other Status</label>
                            <input type="text" class="form-control" id="edit_other_status" value="" name="other_status">
                            <div class="invalid-feedback">
                                Please enter civil status.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="religion" class="form-label">Religion</label>
                            <select id="edit_religion" class="form-select" required name="religion">
                                <?php
                                foreach ($all_religion as $religion) {
                                ?>
                                    <option value="<?php echo $religion['religion_name'] ?>"><?php echo $religion['religion_name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="purok_name" class="form-label">Purok</label>
                            <select id="edit_purok_name" class="form-select" required name="purok_name">
                                <?php
                                foreach ($all_purok as $purok) {
                                ?>
                                    <option value="<?php echo $purok['purok_name'] ?>"><?php echo $purok['purok_name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit_email" value="" name="email">
                            <div class="invalid-feedback">
                                Please enter a valid email.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="contact_no" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="edit_contact_no" pattern="[0-9]{11}" value="" name="contact_no" maxlength="11">
                            <div class="invalid-feedback">
                                Please enter a valid phone number, ex: 09123456789.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" id="btn_close_modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btn_update_mother" name="request_update_mother">Update Mother</button>
                </div>
            </form>
        </div>
    </div>
</div>