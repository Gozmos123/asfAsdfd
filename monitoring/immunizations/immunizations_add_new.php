<div class="d-lg-flex align-items-center justify-content-between mb-2">
    <h1 class="h3 mb-3 text-gray-800">Choose Children</h1>
</div>
<table id="table_childrens" class="table table-responsive-sm">
    <thead>
        <tr>
            <th scope="col">Action</th>
            <th scope="col">Name</th>
            <th scope="col">Age</th>
            <th scope="col">Sex</th>
            <th scope="col">Mother</th>
        </tr>
    </thead>
    <tbody id="">
        <?php
        require_once('../../model/monitoring/Immunization.php');

        $immunizationObj = new Immunization;

        $immunizations = $immunizationObj->getChildrens_Filter();

        if ($immunizations) {
            foreach ($immunizations as $immunization) {
        ?>
                <tr>
                    <td>
                        <button class="btn btn-primary" data-id="<?php echo $immunization['id']; ?>" id="btnAddImmunization" data-toggle="modal" data-target="#modal_immunization_add"><i class="fa fa-plus-circle"></i> Add Immunization</button>
                    </td>
                    <td><?php echo $immunization['name']; ?></td>
                    <td><?php echo $immunization['age']; ?></td>
                    <td><?php echo $immunization['sex']; ?></td>
                    <td><?php echo $immunization['mother']; ?></td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>

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
            <form action="javascript:void(0);" method="post" id="formAddImmunization">
                <input type="hidden" name="children_id" id="children_id" required>
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
                    <button class="btn btn-secondary" type="button" id="btn_close_modal" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btn_add_immunization">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const current_date = new Date().toLocaleDateString('fr-ca');
    txt_date_given.max = current_date;
</script>