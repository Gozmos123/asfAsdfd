<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <?php
                require_once('../../model/Secure.php');
                $secure_uri = Secure::encrypt('immunizations');
                ?>

                <?php
                if (!($_SESSION['auth'][0]['user_type'] == "user")) {
                ?>
                    <a href="../immunizations/?add=<?php echo $secure_uri; ?>">
                        <button class="btn btn-primary" id="btn_add_new"><i class="fa fa-plus-circle"></i> Add New</button>
                    </a>
                <?php
                }
                ?>
                <h4 class="card-title mt-2">Childrens Immunizations</h4>
            </div>
        </div>
        <table class="table table-responsive-sm mt-2" id="table_immunizations">
            <thead>
                <tr>
                    <th scope="col">Photo</th>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Last Date Given</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once('../../model/monitoring/Immunization.php');
                require_once('../../model/Secure.php');

                $immunizationObj = new Immunization;

                $immunizations = $immunizationObj->getImmunizationsAll();

                if ($immunizations) {
                    foreach ($immunizations as $immunization) {
                ?>
                        <tr>
                            <td><img src="../../<?php echo $immunization['photo']; ?>" alt="profile" width="50px" height="50px"></td>
                            <td><?php echo ucwords($immunization['first_name'] . ' ' . $immunization['middle_name'] . ' ' . $immunization['last_name'] . ' ' . $immunization['prefix']); ?></td>
                            <td><?php echo $immunization['age']; ?></td>
                            <td><?php echo $immunization['date_given']; ?></td>
                            <td>
                                <?php
                                $id = Secure::encrypt($immunization['cID']);
                                // die($id);
                                ?>
                                <a href="../../residents/childrens/?view=<?php echo $id; ?>&monitoring=immunization">
                                    <button class="btn btn-primary" id="btn_view_children"><i class="fa fa-eye"></i> View</button>
                                </a>
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