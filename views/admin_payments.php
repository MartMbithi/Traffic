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


/* Update  */
if (isset($_POST['update'])) {
    $payment_id = $_POST['payment_id'];
    $payment_date  = $_POST['payment_date'];
    $payment_transaction_no  = $_POST['payment_transaction_no'];
    $payment_amount  = $_POST['payment_amount'];

    $query = "UPDATE offenses_payments SET  payment_date =?, payment_transaction_no =?, payment_amount =? WHERE payment_id =?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        'ssss',
        $payment_date,
        $payment_transaction_no,
        $payment_amount,
        $payment_id
    );
    $stmt->execute();
    if ($stmt) {
        $success = "Payment Updated";
    } else {
        $info = "Please Try Again Or Try Later";
    }
}

/* Delete  */
if (isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    $adn = "DELETE FROM  offenses_payments WHERE payment_id = ? ";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $delete);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = "Deleted" && header("refresh:1; url=admin_payments");
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
                            <h1 class="page-title"> Traffic Offences Charges Payments </h1>
                        </header><!-- /.page-title-bar -->
                        <!-- .page-section -->
                        <div class="page-section">
                            <!-- .section-block -->
                            <!-- grid column -->
                            <div class="text-right">
                                <a href="admin_offences" class="btn btn-outline-primary">
                                    Add Traffic Offence Charge Payment
                                </a>
                                <hr>
                            </div>
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
                                                            <th>Motorist Details </th>
                                                            <th>Offense Details</th>
                                                            <th>Payment Details</th>
                                                            <th>Manage</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $ret = "SELECT * FROM offenses_payments p INNER JOIN  offences o ON p.payment_offence_id  = o.offence_id
                                                        INNER JOIN motorist m ON o.offence_motorist_id = m.motorist_id
                                                        INNER JOIN traffic_rules tr ON tr.rule_id = o.offence_rule_id
                                                        INNER JOIN vehicle_types vt ON o.offence_vehicle_type = vt.vehicle_type_id";
                                                        $stmt = $mysqli->prepare($ret);
                                                        $stmt->execute(); //ok
                                                        $res = $stmt->get_result();
                                                        while ($offence = $res->fetch_object()) {
                                                        ?>
                                                            <tr>
                                                                <th>
                                                                    Name: <?php echo $offence->motorist_full_name; ?><br>
                                                                    Email: <?php echo $offence->motorist_email; ?><br>
                                                                    Phone: <?php echo $offence->motorist_mobile; ?> <br>
                                                                </th>
                                                                <th>
                                                                    Date : <?php echo $offence->offence_date; ?><br>
                                                                    Location: <?php echo $offence->offence_location; ?><br>
                                                                    Rule : <?php echo $offence->rule_name; ?> <br>
                                                                </th>
                                                                <th>
                                                                    Ref : <?php echo $offence->payment_ref; ?><br>
                                                                    Tr No: <?php echo $offence->payment_transaction_no; ?><br>
                                                                    Amount : Ksh <?php echo $offence->payment_amount; ?> <br>
                                                                </th>

                                                                <td>
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
                                                                                        <div class="card-body">
                                                                                            <div class="row">
                                                                                                <div class="form-group col-md-6">
                                                                                                    <label for="">Payment Date </label>
                                                                                                    <input type="date" value="<?php echo $offence->payment_date; ?>" required name="payment_date" class="form-control">
                                                                                                    <input type="hidden" value="<?php echo $offence->payment_id; ?>" required name="payment_id" class="form-control">
                                                                                                </div>
                                                                                                <div class="form-group col-md-6">
                                                                                                    <label for="">Transaction Number</label>
                                                                                                    <input type="text" value="<?php echo $offence->payment_transaction_no; ?>" required name="payment_transaction_no" class="form-control">
                                                                                                </div>
                                                                                                <div class="form-group col-md-12">
                                                                                                    <label for="">Amount Paid (Ksh)</label>
                                                                                                    <input type="text" value="<?php echo $offence->payment_amount; ?>" required name="payment_amount" class="form-control">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="text-right">
                                                                                            <button type="submit" name="update" class="btn btn-primary">Update Payment</button>
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
                                                                        <a data-toggle="modal" href="#delete-<?php echo $offence->payment_id; ?>" class="btn btn-sm btn-icon btn-secondary"><i class="far fa-trash-alt"></i>
                                                                            <span class="sr-only">
                                                                                Delete
                                                                            </span>
                                                                        </a>
                                                                    <?php
                                                                    } ?>

                                                                    <!-- Delete Modal -->
                                                                    <div class="modal fade" id="delete-<?php echo $offence->payment_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                                    <a href="admin_payments?delete=<?php echo $offence->payment_id; ?>" class="text-center btn btn-danger"> Delete </a>
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