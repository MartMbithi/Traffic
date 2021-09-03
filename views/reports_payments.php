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
                            <h1 class="page-title"> Traffic Offences Charges Payments Reports </h1>
                        </header><!-- /.page-title-bar -->
                        <!-- .page-section -->
                        <div class="page-section">
                            <!-- .section-block -->
                            <!-- grid column -->
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