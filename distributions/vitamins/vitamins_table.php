<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <?php
                require_once('../../model/Secure.php');
                $secure_uri = Secure::encrypt('vitamins');
                ?>

                <?php
                if (!($_SESSION['auth'][0]['user_type'] == "user")) {
                ?>
                    <a href="../vitamins/?add=<?php echo $secure_uri; ?>">
                        <button class="btn btn-primary" id="btn_add_new"><i class="fa fa-plus-circle"></i> Add New</button>
                    </a>
                <?php
                }
                ?>
                <h4 class="card-title mt-2">Childrens received vitamins</h4>
            </div>
        </div>
        <table class="table table-responsive-sm mt-2" id="table_vitamins">
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
                require_once('../../model/distributions/Vitamin.php');
                require_once('../../model/Secure.php');

                $vitamin = new Vitamin;

                $vitaminLists = $vitamin->getVitaminsAll();

                if ($vitaminLists) {
                    foreach ($vitaminLists as $vitaminList) {
                ?>
                        <tr>
                            <td><img src="../../<?php echo $vitaminList['photo']; ?>" alt="profile" width="50px" height="50px"></td>
                            <td><?php echo $vitaminList['first_name'] . ' ' . $vitaminList['middle_name'] . ' ' . $vitaminList['last_name'] . ' ' . $vitaminList['prefix']; ?></td>
                            <td><?php echo $vitaminList['age']; ?></td>
                            <td><?php echo $vitaminList['sex']; ?></td>
                            <td><?php echo $vitaminList['mFirstName'] . ' ' . $vitaminList['mMiddleName'] . ' ' . $vitaminList['mLastName']; ?></td>
                            <td><?php echo $vitaminList['date_given']; ?></td>
                            <td>
                                <?php
                                $id = Secure::encrypt($vitaminList['cID']);
                                // die($id);
                                ?>
                                <a href="../../residents/childrens/?view=<?php echo $id; ?>&monitoring=vitamins">
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