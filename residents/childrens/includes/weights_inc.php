<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-9">
                <h4 class="card-title">Weights</h4>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary" id="btnAddWeights" data-toggle="modal" data-target="#"><i class="fa fa-plus-circle"></i> Add New</button>
            </div>
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