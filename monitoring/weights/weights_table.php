<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <?php
                require_once('../../model/Secure.php');
                $secure_uri = Secure::encrypt('weights');
                ?>

                <?php
                if (!($_SESSION['auth'][0]['user_type'] == "user")) {
                ?>
                    <a href="../weights/?add=<?php echo $secure_uri; ?>">
                        <button class="btn btn-primary" id="btn_add_new"><i class="fa fa-plus-circle"></i> Add New</button>
                    </a>
                <?php
                }
                ?>

                <h4 class="card-title mt-2">Childrens Weights</h4>
            </div>
        </div>
        <table class="table table-responsive-sm mt-2" id="table_weights">
            <thead>
                <tr>
                    <th scope="col">Photo</th>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Weight (kg)</th>
                    <th scope="col">Height (cm)</th>
                    <th scope="col">Last Taken</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once('../../model/monitoring/Weight.php');
                require_once('../../model/Secure.php');

                $weightObj = new Weight;

                $weights = $weightObj->getWeightsAll();

                if ($weights) {
                    foreach ($weights as $weight) {
                ?>
                        <tr>
                            <td><img src="../../<?php echo $weight['photo']; ?>" alt="profile" width="50px" height="50px"></td>
                            <td><?php echo $weight['first_name'] . ' ' . $weight['middle_name'] . ' ' . $weight['last_name'] . ' ' . $weight['prefix']; ?></td>
                            <td><?php echo $weight['age']; ?></td>
                            <td><?php echo $weight['weight']; ?></td>
                            <td><?php echo $weight['height']; ?></td>
                            <td><?php echo $weight['date_checked']; ?></td>
                            <td>
                                <?php
                                $id = Secure::encrypt($weight['cID']);
                                // die($id);
                                ?>
                                <a href="../../residents/childrens/?view=<?php echo $id; ?>&monitoring=weights">
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