<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <?php
                require_once('../../model/Secure.php');
                $secure_uri = Secure::encrypt('dewormings');
                ?>

                <?php
                if (!($_SESSION['auth'][0]['user_type'] == "user")) {
                ?>
                    <a href="../deworming/?add=<?php echo $secure_uri; ?>">
                        <button class="btn btn-primary" id="btn_add_new"><i class="fa fa-plus-circle"></i> Add New</button>
                    </a>
                <?php
                }
                ?>
                <h4 class="card-title mt-2">Childrens received dewormings</h4>
            </div>
        </div>
        <table class="table table-responsive-sm mt-2" id="table_dewormings">
            <thead>
                <tr>
                    <th scope="col">Photo</th>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Sex</th>
                    <th scope="col">Mother</th>
                    <th scope="col">Last Date Received</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once('../../model/distributions/Deworming.php');
                require_once('../../model/Secure.php');

                $dewormingObj = new Deworming;

                $dewormings = $dewormingObj->getDewormingsAll();

                if ($dewormings) {
                    foreach ($dewormings as $deworming) {
                ?>
                        <tr>
                            <td><img src="../../<?php echo $deworming['photo']; ?>" alt="profile" width="50px" height="50px"></td>
                            <td><?php echo ucwords($deworming['first_name'] . ' ' . $deworming['middle_name'] . ' ' . $deworming['last_name'] . ' ' . $deworming['prefix']); ?></td>
                            <td><?php echo $deworming['age']; ?></td>
                            <td><?php echo $deworming['sex']; ?></td>
                            <td><?php echo ucwords($deworming['mFirstName'] . ' ' . $deworming['mMiddleName'] . ' ' . $deworming['mLastName']); ?></td>
                            <td><?php echo $deworming['date_given']; ?></td>
                            <td>
                                <?php
                                $id = Secure::encrypt($deworming['cID']);
                                // die($id);
                                ?>
                                <a href="../../residents/childrens/?view=<?php echo $id; ?>&monitoring=deworming">
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