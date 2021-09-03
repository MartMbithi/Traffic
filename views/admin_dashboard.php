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
require_once('../partials/analytics.php');
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

                        <!-- .page-section -->
                        <div class="page-section">
                            <!-- .section-block -->
                            <div class="section-block">
                                <!-- metric row -->
                                <div class="metric-row">
                                    <div class="col-lg-9">
                                        <div class="metric-row metric-flush">
                                            <!-- metric column -->
                                            <div class="col">
                                                <!-- .metric -->
                                                <a href="admin_officers" class="metric metric-bordered align-items-center">
                                                    <h2 class="metric-label"> Officers </h2>
                                                    <p class="metric-value h3">
                                                        <sub><i class="fas fa-user-astronaut"></i></sub>
                                                        <span class="value"><?php echo $officer; ?></span>
                                                    </p>
                                                </a> <!-- /.metric -->
                                            </div><!-- /metric column -->
                                            <!-- metric column -->
                                            <div class="col">
                                                <!-- .metric -->
                                                <a href="admin_motorists" class="metric metric-bordered align-items-center">
                                                    <h2 class="metric-label"> Registered Motorists </h2>
                                                    <p class="metric-value h3">
                                                        <sub><i class="fas fa-biking"></i></sub>
                                                        <span class="value"><?php echo $motorist; ?></span>
                                                    </p>
                                                </a> <!-- /.metric -->
                                            </div><!-- /metric column -->
                                            <!-- metric column -->
                                            <div class="col">
                                                <!-- .metric -->
                                                <a href="admin_offences" class="metric metric-bordered align-items-center">
                                                    <h2 class="metric-label"> Recorded Offences </h2>
                                                    <p class="metric-value h3">
                                                        <sub><i class="fas fa-car-crash"></i></sub>
                                                        <span class="value"><?php echo $offences; ?></span>
                                                    </p>
                                                </a> <!-- /.metric -->
                                            </div><!-- /metric column -->
                                        </div>
                                    </div><!-- metric column -->
                                    <div class="col-lg-3">
                                        <!-- .metric -->
                                        <a href="admin_payments" class="metric metric-bordered">
                                            <div class="metric-badge">
                                                <span class="badge badge-lg badge-success"><span class="fas fa-hand-holding-usd pulse mr-1"></span> Offences Fines Payments</span>
                                            </div>
                                            <p class="metric-value h3">
                                                <sub><i class="fas fa-money-bill-alt"></i></sub> <span class="value">Ksh <?php echo $offenses_payments; ?></span>
                                            </p>
                                        </a> <!-- /.metric -->
                                    </div><!-- /metric column -->
                                </div><!-- /metric row -->
                            </div><!-- /.section-block -->
                            <!-- grid row -->
                            <div class="row">
                                <!-- grid column -->
                                <div class="col-12 col-lg-12 col-xl-12">
                                    <!-- .card -->
                                    <div class="card card-fluid">
                                        <!-- .card-body -->
                                        <div class="card-body">
                                            <h3 class="card-title mb-4"> Recently Recorded Offences </h3>
                                            <hr>
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
                                                                Phone:<?php echo $offence->motorist_mobile; ?> <br>
                                                                License: <?php echo $offence->motorist_license_no; ?>
                                                            </th>
                                                            <th>
                                                                <?php echo $offence->vehicle_type_name; ?>
                                                            </th>
                                                            <th>
                                                                Name: <?php echo $offence->officer_full_name; ?><br>
                                                                Email: <?php echo $offence->officer_email; ?><br>
                                                                Mobile:<?php echo $offence->officer_mobile; ?> <br>
                                                            </th>
                                                            <td>
                                                                <a class="badge badge-success" data-toggle="modal" href="#u-<?php echo $offence->offence_id; ?>">View Report</a>
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
                        </div><!-- /.page-section -->
                    </div><!-- /.page-inner -->
                </div><!-- /.page -->
            </div><!-- .app-footer -->
            <?php require_once('../partials/footer.php'); ?>
            <!-- /.wrapper -->
        </main><!-- /.app-main -->
    </div><!-- /.app -->
    <!-- BEGIN BASE JS -->
    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>