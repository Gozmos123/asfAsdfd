<?php
header('location: ../');
exit();
?>
<div class="col-lg-6">
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <h4 class="card-title">Civil Status</h4>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary" id="btnAddCivilStatus" data-toggle="modal" data-target="#modal_civil_status_add_new"><i class="fa fa-plus-circle"></i> Add New</button>
                </div>
            </div>
            <div class="row mt-3">
                <table class="table table-responsive-sm" id="table_civil_status">
                    <thead>
                        <tr>
                            <th scope="col">Civil Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once('../model/CivilStatus.php');
                        $civil_status = new CivilStatus;

                        $status_lists = $civil_status->getCivilStatusAll();

                        if ($status_lists) {
                            foreach ($status_lists as $status_list) {
                        ?>
                                <tr>
                                    <td><?php echo $status_list['civil_status']; ?></td>
                                    <td>
                                        <?php
                                        if (!($status_list['civil_status'] == "Other" || $status_list['civil_status'] == "Single" || $status_list['civil_status'] == "Married")) {
                                        ?>
                                            <button class="btn btn-primary" id="btn_edit_status" data-id="<?php echo $status_list['id']; ?>" data-toggle="modal" data-target="#modal_civil_status_edit"><i class="fa fa-edit"></i></button>
                                            <!-- <button class="btn btn-danger" id="btn_delete_status" data-id="<?php echo $status_list['id']; ?>"><i class="fa fa-trash"></i></button> -->
                                        <?php
                                        } else {
                                        ?>
                                            <button class="btn btn-primary"><i class="fa fa-stop"></i></button>
                                        <?php
                                        }
                                        ?>
                                    </td>
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
</div>