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
require_once('../partials/my_analytics.php');
checklogin();
require_once('../partials/head.php');
?>

<body>
    <!-- .app -->
    <div class="app">

        <!-- .app-header -->
        <?php require_once('../partials/my_header.php'); ?>
        <!-- .app-aside -->
        <?php require_once('../partials/my_aside.php'); ?>
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
                                    <div class="col-lg-12">
                                        <div class="metric-row metric-flush">
                                            <!-- metric column -->
                                            <div class="col">
                                                <!-- .metric -->
                                                <a href="my_traffic_rules" class="metric metric-bordered align-items-center">
                                                    <h2 class="metric-label"> Traffic Rules </h2>
                                                    <p class="metric-value h3">
                                                        <sub><i class="fas fa-user-astronaut"></i></sub>
                                                        <span class="value"><?php echo $rules; ?></span>
                                                    </p>
                                                </a> <!-- /.metric -->
                                            </div><!-- /metric column -->
                                            <!-- metric column -->
                                            <div class="col">
                                                <!-- .metric -->
                                                <a href="my_offences" class="metric metric-bordered align-items-center">
                                                    <h2 class="metric-label"> My Recorded Offences </h2>
                                                    <p class="metric-value h3">
                                                        <sub><i class="fas fa-car-crash"></i></sub>
                                                        <span class="value"><?php echo $offences; ?></span>
                                                    </p>
                                                </a> <!-- /.metric -->
                                            </div><!-- /metric column -->
                                            <!-- metric column -->
                                            <div class="col">
                                                <!-- .metric -->
                                                <a href="my_charges" class="metric metric-bordered align-items-center">
                                                    <h2 class="metric-label"> Paid Charges </h2>
                                                    <p class="metric-value h3">
                                                        <sub><i class="fas fa-dollar-sigh"></i></sub>
                                                        <span class="value">Ksh <?php echo $offenses_payments; ?></span>
                                                    </p>
                                                </a> <!-- /.metric -->
                                            </div><!-- /metric column -->
                                        </div>
                                    </div><!-- metric column -->
                                </div><!-- /metric row -->
                            </div><!-- /.section-block -->
                            <!-- grid row -->
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