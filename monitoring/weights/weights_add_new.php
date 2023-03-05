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
        require_once('../../model/monitoring/Weight.php');

        $weightObj = new Weight;

        $weights = $weightObj->getChildrens_Filter();

        if ($weights) {
            foreach ($weights as $weight) {
        ?>
                <tr>
                    <td>
                        <button class="btn btn-primary" data-id="<?php echo $weight['id']; ?>" id="btnAddWeight" data-toggle="modal" data-target="#modal_weight_add"><i class="fa fa-plus-circle"></i> Add Weight</button>
                    </td>
                    <td><?php echo $weight['name']; ?></td>
                    <td><?php echo $weight['age']; ?></td>
                    <td><?php echo $weight['sex']; ?></td>
                    <td><?php echo $weight['mother']; ?></td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>


<!-- modal add new -->
<div class="modal fade" id="modal_weight_add" tabindex="-1" role="dialog" aria-labelledby="modalAddWeight" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddWeight"><strong>Add Weight</strong></h5>
            </div>
            <form action="javascript:void(0);" method="post" id="formAddWeight">
                <input type="hidden" name="children_id" id="children_id" required>
                <div class="modal-body">
                    <h5 id="children_name" class="mb-3"></h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="txt_weight" class="form-label">Weight (kg)</label>
                            <input type="number" name="weight" id="txt_weight" required class="form-control" step=".01">
                        </div>
                        <div class="col-md-6">
                            <label for="txt_height" class="form-label">Height (cm)</label>
                            <input type="number" name="weight" id="txt_height" required class="form-control" step=".01">
                        </div>
                        <div class="col-md-12">
                            <label for="txt_checked_by" class="form-label">Checked By</label>
                            <input type="text" name="checked_by" id="txt_checked_by" required class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="txt_date_checked" class="form-label">Date Checked</label>
                            <input type="date" class="form-control" id="txt_date_checked" required value="" name="date_checked">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" id="btn_close_modal" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btn_add_weight">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const current_date = new Date().toLocaleDateString('fr-ca');
    txt_date_checked.max = current_date;
</script>