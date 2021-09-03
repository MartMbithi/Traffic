<?php
/*
 * Created on Fri Sep 03 2021
 *
 * Mart Developers Inc
 * https://martdev.info
 * martdevelopers254@gmail.com
 * +254 740 847 563 / +254 737 229 776
 *
 * The MIT License (MIT)
 * Copyright (c) 2021 Devlan Inc
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial
 * portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
 * TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
session_start();
require_once('../config/checklogin.php');
require_once('../config/config.php');
require_once('../config/codeGen.php');
checklogin();

/* Add  */
if (isset($_POST['add'])) {
    $offence_id = $sys_gen_id;
    $offence_date = $_POST['offence_date'];
    $offence_location  = $_POST['offence_location'];
    $offence_rule_id  = $_POST['offence_rule_id'];
    $offence_motorist_id  = $_POST['offence_motorist_id'];
    $offence_vehicle_type  = $_POST['offence_vehicle_type'];
    $offence_vehicle_registration  = $_POST['offence_vehicle_registration'];
    $offence_report  = $_POST['offence_report'];
    $offence_officer_id  = $_POST['offence_officer_id'];

    $query = "INSERT INTO offences (offence_id, offence_date, offence_location, offence_rule_id, offence_motorist_id, 
     offence_vehicle_type, offence_vehicle_registration, offence_report, offence_officer_id)
      VALUES(?,?,?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        'sssssssss',
        $offence_id,
        $offence_date,
        $offence_location,
        $offence_rule_id,
        $offence_motorist_id,
        $offence_vehicle_type,
        $offence_vehicle_registration,
        $offence_report,
        $offence_officer_id
    );
    $stmt->execute();
    if ($stmt) {
        $success = "Traffic Offense Added";
    } else {
        $info = "Please Try Again Or Try Later";
    }
}

/* Update  */
if (isset($_POST['update'])) {
    $offence_id = $_POST['offence_id'];
    $offence_date = $_POST['offence_date'];
    $offence_location  = $_POST['offence_location'];
    $offence_vehicle_registration  = $_POST['offence_vehicle_registration'];
    $offence_report  = $_POST['offence_report'];

    $query = "UPDATE offences SET offence_date =?, offence_location =?, offence_vehicle_registration =?, offence_report =? WHERE offence_id =?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        'sssss',
        $offence_date,
        $offence_location,
        $offence_vehicle_registration,
        $offence_report,
        $offence_id
    );
    $stmt->execute();
    if ($stmt) {
        $success = "Traffic Offense Updated";
    } else {
        $info = "Please Try Again Or Try Later";
    }
}

/* Delete  */
if (isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    $adn = "DELETE FROM  offences WHERE offence_id = ? ";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $delete);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = "Deleted" && header("refresh:1; url=admin_offences");
    } else {
        $info = "Please Try Again Or Try Later";
    }
}
require_once('../partials/head.php');
?>

<body>
    <!-- .app -->
    <div class="app">
        <!-- .app-header -->
        <?php require_once('../partials/header.php'); ?>
        <!-- .app-aside -->
        <?php require_once('../partials/aside.php'); ?>
        <!-- .app-main -->
        <main class="app-main">
            <!-- .wrapper -->
            <div class="wrapper">
                <!-- .page -->
                <div class="page">
                    <!-- .page-inner -->
                    <div class="page-inner">
                        <!-- .page-title-bar -->
                        <header class="page-title-bar">
                            <!-- page title stuff goes here -->
                            <h1 class="page-title"> Traffic Offences </h1>
                        </header><!-- /.page-title-bar -->
                        <!-- .page-section -->
                        <div class="page-section">
                            <!-- .section-block -->
                            <!-- grid column -->
                            <div class="text-right">
                                <a href="#add_modal" class="btn btn-outline-primary" data-toggle="modal">
                                    Add Traffic Offence
                                </a>
                                <hr>
                            </div>
                            <!-- Add Modal -->
                            <div class="modal fade" id="add_modal">
                                <div class="modal-dialog  modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Fill All Fields </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" enctype="multipart/form-data" role="form">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="">Motorist Name</label>
                                                            <select id="bss1" name="offence_motorist_id" class="form-control" data-toggle="selectpicker" data-width="100%">
                                                                <?php
                                                                $ret = "SELECT * FROM motorist ";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($motorist = $res->fetch_object()) { ?>
                                                                    <option value="<?php echo $motorist->motorist_id; ?>"><?php echo $motorist->motorist_full_name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Vehicle Type</label>
                                                            <select id="bss1" name="offence_vehicle_type" class="form-control" data-toggle="selectpicker" data-width="100%">
                                                                <?php
                                                                $ret = "SELECT * FROM vehicle_types ";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($of = $res->fetch_object()) { ?>
                                                                    <option value="<?php echo $of->vehicle_type_id; ?>"><?php echo $of->vehicle_type_name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label for="">Traffic Rule</label>
                                                            <select id="bss1" name="offence_rule_id" class="form-control" data-toggle="selectpicker" data-width="100%">
                                                                <?php
                                                                $ret = "SELECT * FROM traffic_rules ";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($of = $res->fetch_object()) { ?>
                                                                    <option value="<?php echo $of->rule_id; ?>"><?php echo $of->rule_name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="">Officer Name</label>
                                                            <select id="bss1" name="offence_officer_id" class="form-control" data-toggle="selectpicker" data-width="100%">
                                                                <?php
                                                                $ret = "SELECT * FROM officer";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($of = $res->fetch_object()) { ?>
                                                                    <option value="<?php echo $of->officer_id; ?>"><?php echo $of->officer_full_name . ' ' . $of->officer_staff_no; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Date Recorded</label>
                                                            <input type="date" required name="offence_date" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Vehicle Registration</label>
                                                            <input type="text" required name="offence_vehicle_registration" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="">Location</label>
                                                            <input type="text" required name="offence_location" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="">Offence Report</label>
                                                            <textarea type="text" rows="10" required name="offence_report" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="submit" name="add" class="btn btn-primary">Add Offense</button>
                                                </div>
                                                <br>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                            <div class="section-block">
                                <div class="row">
                                    <div class="col-12 col-lg-12 col-xl-12">
                                        <!-- .card -->
                                        <div class="card card-fluid">
                                            <!-- .card-body -->
                                            <div class="card-body">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Date Recorded </th>
                                                            <th>Location</th>
                                                            <th>Motorist</th>
                                                            <th>Vehicle</th>
                                                            <th>Officer Recorded</th>
                                                            <th>Manage</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $ret = "SELECT * FROM offences o
                                                     INNER JOIN motorist m ON o.offence_motorist_id = m.motorist_id
                                                     INNER JOIN officer f ON  o.offence_officer_id  = f.officer_id
                                                     INNER JOIN vehicle_types vt ON o.offence_vehicle_type = vt.vehicle_type_id";
                                                        $stmt = $mysqli->prepare($ret);
                                                        $stmt->execute(); //ok
                                                        $res = $stmt->get_result();
                                                        while ($offence = $res->fetch_object()) {
                                                        ?>
                                                            <tr>
                                                                <th><?php echo $offence->offence_date; ?></th>
                                                                <th><?php echo $offence->offence_location; ?></th>
                                                                <th>
                                                                    Name: <?php echo $offence->motorist_full_name; ?><br>
                                                                    Email: <?php echo $offence->motorist_email; ?><br>
                                                                    Phone: <?php echo $offence->motorist_mobile; ?> <br>
                                                                </th>
                                                                <th>
                                                                    <?php echo $offence->vehicle_type_name; ?><br>
                                                                    License: <?php echo $offence->offence_vehicle_registration; ?>
                                                                </th>
                                                                <th>
                                                                    Name: <?php echo $offence->officer_full_name; ?><br>
                                                                    Staff No: <?php echo $offence->officer_staff_no; ?>
                                                                </th>
                                                                <td>
                                                                    <a data-toggle="modal" href="#u-<?php echo $offence->offence_id; ?>" class="btn btn-sm btn-icon btn-secondary"><i class="fa fa-eye"></i>
                                                                        <span class="sr-only">view</span>
                                                                    </a>
                                                                    <!-- Update Modal -->
                                                                    <div class="modal fade" id="u-<?php echo $offence->offence_id; ?>">
                                                                        <div class="modal-dialog  modal-xl">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title">Offence Report </h4>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p>
                                                                                        <?php echo $offence->offence_report; ?>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Report -->
                                                                    <a data-toggle="modal" href="#update-<?php echo $offence->offence_id; ?>" class="btn btn-sm btn-icon btn-secondary"><i class="fa fa-pencil-alt"></i>
                                                                        <span class="sr-only">Edit</span>
                                                                    </a>
                                                                    <!-- Update Modal -->
                                                                    <div class="modal fade" id="update-<?php echo $offence->offence_id; ?>">
                                                                        <div class="modal-dialog  modal-xl">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title">Fill All Fields </h4>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form method="post" enctype="multipart/form-data" role="form">
                                                                                        <div class="card-body">offence_id
                                                                                            <div class="row">
                                                                                                <div class="form-group col-md-6">
                                                                                                    <label for="">Date Recorded</label>
                                                                                                    <input type="date" value="<?php echo $offence->offence_date; ?>" required name="offence_date" class="form-control">
                                                                                                    <input type="hidden" value="<?php echo $offence->offence_id; ?>" required name="offence_id" class="form-control">
                                                                                                </div>
                                                                                                <div class="form-group col-md-6">
                                                                                                    <label for="">Vehicle Registration</label>
                                                                                                    <input type="text" required value="<?php echo $offence->offence_vehicle_registration; ?>" name="offence_vehicle_registration" class="form-control">
                                                                                                </div>
                                                                                                <div class="form-group col-md-12">
                                                                                                    <label for="">Location</label>
                                                                                                    <input type="text" value="<?php echo $offence->offence_location; ?>" required name="offence_location" class="form-control">
                                                                                                </div>
                                                                                                <div class="form-group col-md-12">
                                                                                                    <label for="">Offence Report</label>
                                                                                                    <textarea type="text" rows="10" required name="offence_report" class="form-control"><?php echo $offence->offence_report; ?></textarea>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="text-right">
                                                                                            <button type="submit" name="update" class="btn btn-primary">Update Offense</button>
                                                                                        </div>
                                                                                        <br>
                                                                                    </form>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    if ($_SESSION['login_rank'] == 'Administrator') {
                                                                    ?>
                                                                        <!-- End Modal -->
                                                                        <a data-toggle="modal" href="#delete-<?php echo $offence->offence_id; ?>" class="btn btn-sm btn-icon btn-secondary"><i class="far fa-trash-alt"></i>
                                                                            <span class="sr-only">
                                                                                Delete
                                                                            </span>
                                                                        </a>
                                                                    <?php
                                                                    } ?>

                                                                    <!-- Delete Modal -->
                                                                    <div class="modal fade" id="delete-<?php echo $offence->offence_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETE</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body text-center text-danger">
                                                                                    <h4>Delete Record</h4>
                                                                                    <br>
                                                                                    <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                                                                                    <a href="admin_offences?delete=<?php echo $offence->offence_id; ?>" class="text-center btn btn-danger"> Delete </a>
                                                                                    <br>
                                                                                    <br>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End Modal -->
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div><!-- /.card-body -->
                                        </div><!-- /.card -->
                                    </div><!-- /grid column -->
                                </div><!-- /grid row -->
                            </div><!-- /.section-block -->
                        </div><!-- /.page-section -->
                    </div><!-- /.page-inner -->
                </div><!-- /.page -->
            </div><!-- /.wrapper -->
        </main><!-- /.app-main -->
    </div><!-- /.app -->
    <!-- BEGIN BASE JS -->
    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>