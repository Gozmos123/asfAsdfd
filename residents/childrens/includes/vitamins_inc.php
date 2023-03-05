<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-9">
                <h4 class="card-title">Vitamins</h4>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary" id="btnAddVitamin" data-toggle="modal" data-target="#"><i class="fa fa-plus-circle"></i> Add New</button>
            </div>
        </div>
        <div class="row mt-3">
            <table class="table table-responsive-sm" id="table_vitamins">
                <thead>
                    <tr>
                        <th scope="col">Date Given</th>
                        <th scope="col">Given By</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once('../../model/distributions/Vitamin.php');
                    $vitaminObj = new Vitamin;

                    $vitamins = $vitaminObj->getVitamins_ByChildrenID($child_id);

                    if ($vitamins) {
                        foreach ($vitamins as $vitamin) {
                    ?>
                            <tr>
                                <td><?php echo $vitamin['date_given']; ?></td>
                                <td><?php echo $vitamin['given_by']; ?></td>
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