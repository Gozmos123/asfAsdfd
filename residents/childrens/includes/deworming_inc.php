<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-9">
                <h4 class="card-title">Deworming</h4>
            </div>
            <?php
            if (!($_SESSION['auth'][0]['user_type'] == "user")) {
            ?>

                <div class="col-md-3">
                    <button class="btn btn-primary" id="btnAddDeworming" data-toggle="modal" data-target="#modal_deworming_add"><i class="fa fa-plus-circle"></i> Add New</button>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="row mt-3">
            <table class="table table-responsive-sm" id="table_deworming">
                <thead>
                    <tr>
                        <th scope="col">Place Given</th>
                        <th scope="col">Date Given</th>
                        <th scope="col">Given By</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once('../../model/distributions/Deworming.php');
                    $dewormingObj = new Deworming;

                    $dewormings = $dewormingObj->getDewormings_ByChildrenID($child_id);

                    if ($dewormings) {
                        foreach ($dewormings as $deworming) {
                    ?>
                            <tr>
                                <td><?php echo $deworming['place_given']; ?></td>
                                <td><?php echo $deworming['date_given']; ?></td>
                                <td><?php echo $deworming['given_by']; ?></td>
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

<div class="modal fade" id="modal_deworming_add" tabindex="-1" role="dialog" aria-labelledby="modalAddDeworming" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddDeworming"><strong>Add Deworming</strong></h5>
            </div>
            <form action="" method="post" id="formAddDeworming" class="needs-validation" novalidate>
                <input type="hidden" name="selected[]" id="children_id" required value="<?php echo $child_id; ?>">
                <div class="modal-body">
                    <h5 id="children_name" class="mb-3"></h5>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="txt_place_given" class="form-label">Place Given</label>
                            <input type="text" name="place_given" id="txt_place_given" required class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="txt_date_given" class="form-label">Date Checked</label>
                            <input type="date" class="form-control" id="txt_date_given" required value="" name="date_given">
                        </div>
                        <div class="col-md-12">
                            <label for="txt_given_by" class="form-label">Checked By</label>
                            <input type="text" name="given_by" id="txt_given_by" required class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" id="btn_close_modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btn_add_deworming" name="request_save_deworming">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    txt_date_given.max = current_date;
</script>