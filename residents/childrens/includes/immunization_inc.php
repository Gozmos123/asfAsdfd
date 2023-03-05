<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-9">
                <h4 class="card-title">Immunizations</h4>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary" id="btnAddImmunizations" data-toggle="modal" data-target="#"><i class="fa fa-plus-circle"></i> Add New</button>
            </div>
        </div>
        <div class="row mt-3">
            <table class="table table-responsive-sm" id="table_weights">
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