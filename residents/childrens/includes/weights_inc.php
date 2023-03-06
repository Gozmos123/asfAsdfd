<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-9">
                <h4 class="card-title">Weights</h4>
            </div>
            <?php
            if (!($_SESSION['auth'][0]['user_type'] == "user")) {
            ?>
                <div class="col-md-3">
                    <button class="btn btn-primary" id="btnAddWeights" data-toggle="modal" data-target="#modal_weight_add"><i class="fa fa-plus-circle"></i> Add New</button>
                </div>
            <?php
            }
            ?>

        </div>
        <div class="row mt-3">
            <table class="table table-responsive-sm" id="table_weights">
                <thead>
                    <tr>
                        <th scope="col">Weight (kg)</th>
                        <th scope="col">Height (cm)</th>
                        <th scope="col">Checked By</th>
                        <th scope="col">Last Taken</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once('../../model/monitoring/Weight.php');
                    $weightObj = new Weight;

                    $weights = $weightObj->getWeights_ByChildrenID($child_id);

                    if ($weights) {
                        foreach ($weights as $weight) {
                    ?>
                            <tr>
                                <td><?php echo $weight['weight']; ?></td>
                                <td><?php echo $weight['height']; ?></td>
                                <td><?php echo $weight['checked_by']; ?></td>
                                <td><?php echo $weight['date_checked']; ?></td>
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


<div class="modal fade" id="modal_weight_add" tabindex="-1" role="dialog" aria-labelledby="modalAddWeight" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddWeight"><strong>Add Weight</strong></h5>
            </div>
            <form action="" method="post" id="formAddWeight" class="needs-validation" novalidate>
                <input type="hidden" name="children_id" id="children_id" required value="<?php echo $child_id; ?>">
                <div class="modal-body">
                    <h5 id="children_name" class="mb-3"></h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="txt_weight" class="form-label">Weight (kg) *</label>
                            <input type="number" name="weight" id="txt_weight" required class="form-control" step=".01">
                        </div>
                        <div class="col-md-6">
                            <label for="txt_height" class="form-label">Height (cm) *</label>
                            <input type="number" name="height" id="txt_height" required class="form-control" step=".01">
                        </div>
                        <div class="col-md-12">
                            <label for="txt_checked_by" class="form-label">Checked By *</label>
                            <input type="text" name="checked_by" id="txt_checked_by" required class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="txt_date_checked" class="form-label">Date Checked *</label>
                            <input type="date" class="form-control" id="txt_date_checked" required value="" name="date_checked">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" id="btn_close_modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btn_add_weight" name="request_save_weight">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    txt_date_checked.max = current_date;
</script>