<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h4 class="card-title mt-2">Add New Dewormings for Children</h4>
            </div>
            <form action="javascript:void(0);" method="post" class="row" id="formAddDeworming">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="place_given" class="form-label">Place Given</label>
                        <input type="text" class="form-control" id="place_given" required value="" name="place_given">
                    </div>
                    <div class="col-md-3">
                        <label for="date_given" class="form-label">Date Given (MM/DD/YYYY)</label>
                        <input type="date" class="form-control" id="date_given" required value="" name="date_given">
                    </div>
                    <div class="col-md-4">
                        <label for="given_by" class="form-label">Given By</label>
                        <input type="text" class="form-control" id="given_by" required value="" name="given_by">
                    </div>
                </div>
                <div class="row g-3">
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
                            require_once('../../model/distributions/Deworming.php');

                            $dewormingObj = new Deworming;

                            $dewormings = $dewormingObj->getChildrens_Filter();

                            if ($dewormings) {
                                foreach ($dewormings as $deworming) {
                            ?>
                                    <tr>
                                        <td class="text-center">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="is_selected" name="is_selected[]" value="<?php echo $deworming['id']; ?>">
                                            </div>
                                        </td>
                                        <td><?php echo $deworming['name']; ?></td>
                                        <td><?php echo $deworming['age']; ?></td>
                                        <td><?php echo $deworming['sex']; ?></td>
                                        <td><?php echo $deworming['mother']; ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <button type="submit" class="btn btn-primary" name="request_save_deworming" id="btnSave"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const current_date = new Date().toLocaleDateString('fr-ca');
    date_given.max = current_date;
</script>