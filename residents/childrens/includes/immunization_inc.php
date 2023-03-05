<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-9">
                <h4 class="card-title">Immunizations</h4>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary" id="btnAddImmunizations" data-toggle="modal" data-target="#modal_immunization_add"><i class="fa fa-plus-circle"></i> Add New</button>
            </div>
        </div>
        <div class="row mt-3">
            <table class="table table-responsive-sm" id="table_immunizations">
                <thead>
                    <tr>
                        <th scope="col">Vaccine Name</th>
                        <th scope="col">Dose</th>
                        <th scope="col">Date Given</th>
                        <th scope="col">Immunization Type</th>
                        <th scope="col">Administered By</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once('../../model/monitoring/Immunization.php');
                    $immunizationObj = new Immunization;

                    $immunizations = $immunizationObj->getImmunizations_ByChildrenID($child_id);

                    if ($immunizations) {
                        foreach ($immunizations as $immunization) {
                    ?>
                            <tr>
                                <td><?php echo $immunization['vaccine_name']; ?></td>
                                <td><?php echo $immunization['dose']; ?></td>
                                <td><?php echo $immunization['date_given']; ?></td>
                                <td><?php echo $immunization['immunization_type']; ?></td>
                                <td><?php echo $immunization['administered_by']; ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- modal -->

<?php
require_once('../../model/ImmunizationType.php');
$immuneTypeObj = new ImmunizationType;
$immuneTypes = $immuneTypeObj->getImmunizationsTypeAll();
?>

<!-- modal add new -->
<div class="modal fade" id="modal_immunization_add" tabindex="-1" role="dialog" aria-labelledby="modalAddImmunization" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddImmunization"><strong>Add Immunization</strong></h5>
            </div>
            <form action="" method="post" id="formAddImmunization" class="needs-validation" novalidate>
                <input type="hidden" name="children_id" id="children_id" value="<?php echo $child_id; ?>" required>
                <div class="modal-body">
                    <h5 id="children_name" class="mb-3"></h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="txt_vaccineName" class="form-label">Vaccine Name</label>
                            <input type="text" name="vaccine_name" id="txt_vaccineName" required class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="txt_dose" class="form-label">Dose</label>
                            <input type="text" name="dose" id="txt_dose" required class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="txt_date_given" class="form-label">Date Given</label>
                            <input type="date" class="form-control" id="txt_date_given" required value="" name="date_given">
                        </div>
                        <div class="col-md-12">
                            <label for="txt_immunization_type" class="form-label">Immunization Type</label>
                            <select id="txt_immunization_type" class="form-select" required name="immunization_type">
                                <?php
                                foreach ($immuneTypes as $type) {
                                ?>
                                    <option value="<?php echo $type['immunization_type'] ?>"><?php echo $type['immunization_type'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="txt_administered_by" class="form-label">Administered By</label>
                            <input type="text" name="administered_by" id="txt_administered_by" required class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" id="btn_close_modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btn_add_immunization" name="request_save_immunization">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    txt_date_given.max = current_date;
</script>