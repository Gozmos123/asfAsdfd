<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <a href="../mothers/" class="btn btn-secondary mb-3">Mothers</a>
            </div>
            <h4 class="card-title">
                <?php
                require_once('../../model/residents/Mother.php');
                require_once('../../model/residents/Children.php');
                require_once('../../model/Secure.php');

                $mothers = new Mother;
                $children = new Children;
                $childrens;
                $requested_specific = false;

                if (isset($_REQUEST['q'])) {
                    $id = Secure::decrypt($_REQUEST['q']);

                    $mother = $mothers->getMother_ByID($id);

                    // checkifmother exist
                    if ($mother) {
                        $requested_specific = 'child_list';
                        echo 'Childrens of ' . $mother[0]['first_name'] . ' ' . $mother[0]['middle_name'] . ' ' . $mother[0]['last_name'];
                        $childrens = $children->getChildren_ByMotherID($id);
                    } else {
                        $childrens = $children->getChildrensAll();
                    }
                } else {
                    $childrens = $children->getChildrensAll();
                }
                ?>
            </h4>
        </div>
        <table class="table table-responsive-sm" id="table_childrens">
            <thead>
                <tr>
                    <th scope="col">Photo</th>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Sex</th>
                    <th scope="col">Mother</th>
                    <th scope="col">Purok</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($childrens) {
                    foreach ($childrens as $children) {
                ?>
                        <tr>
                            <td><img src="../../<?php echo $children['cPhoto']; ?>" alt="profile" width="50px" height="50px"></td>
                            <td><?php echo $children['cFirstName'] . ' ' . $children['cMiddleName'] . ' ' . $children['cLastName'] . ' ' . $children['cPrefix']; ?></td>
                            <td><?php echo $children['cAge']; ?></td>
                            <td><?php echo $children['cSex']; ?></td>
                            <td><?php echo $children['mFirstName'] . ' ' . $children['mMiddleName'] . ' ' . $children['mLastName']; ?></td>
                            <td><?php echo $children['cPurokName']; ?></td>
                            <td>
                                <input type="hidden" name="m_id" id="m_id" value="<?php echo $children['cMotherID'] ?>">
                                <?php
                                $child_id = Secure::encrypt($children['cID']);
                                ?>
                                <a href="../childrens/?view=<?php echo $child_id; ?>&monitoring=all">
                                    <button class="btn btn-primary" id="btn_view_children"><i class="fa fa-eye"></i> View</button>
                                </a>
                                <button class="btn btn-primary" id="btn_edit_children" data-id="<?php echo $children['cID']; ?>" data-toggle="modal" data-target="#modal_edit_children"><i class="fa fa-edit"></i> Edit</button>
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