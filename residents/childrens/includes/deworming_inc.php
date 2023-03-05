<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-9">
                <h4 class="card-title">Deworming</h4>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary" id="btnAddDeworming" data-toggle="modal" data-target="#"><i class="fa fa-plus-circle"></i> Add New</button>
            </div>
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