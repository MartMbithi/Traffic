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
checklogin();
/* Add Officer */
/* Update Officer */
/* Delete Officer */
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
                            <h1 class="page-title"> Traffic Officers </h1>
                        </header><!-- /.page-title-bar -->
                        <!-- .page-section -->
                        <div class="page-section">
                            <!-- .section-block -->
                            <!-- grid column -->
                            <div class="text-right">
                                <a href="#add_modal" class="btn btn-outline-primary" data-toggle="modal">
                                    Add Traffic Officer
                                </a>
                                <hr>
                            </div>
                            <!-- Add Modal -->
                            <div class="modal fade" id="add_modal">
                                <div class="modal-dialog  modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Fill All Fields </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Add Module Form -->
                                            <form method="post" enctype="multipart/form-data" role="form">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="">Full Name</label>
                                                            <input type="text" required name="officer_full_name" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Officer Number</label>
                                                            <input type="text" required name="officer_staff_no" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Email Address</label>
                                                            <input type="email" required name="officer_email" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Mobile Numner</label>
                                                            <input type="text" required name="officer_mobile" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Login Password</label>
                                                            <input type="text" required name="login_password" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Login Rank</label>
                                                            <select id="bss1" name="login_rank" class="form-control" data-toggle="selectpicker" data-width="100%">
                                                                <option>Officer</option>
                                                                <option>Administrator</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="submit" name="add_officer" class="btn btn-primary">Add Officer</button>
                                                </div>
                                                <br>
                                            </form>
                                            <!-- End Module Form -->
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
                                                            <th>Staff Number </th>
                                                            <th>Full Name</th>
                                                            <th>Contacts</th>
                                                            <th>Manage</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $ret = "SELECT * FROM officer f INNER JOIN login l ON f.officer_login_id = l.login_id ";
                                                        $stmt = $mysqli->prepare($ret);
                                                        $stmt->execute(); //ok
                                                        $res = $stmt->get_result();
                                                        while ($of = $res->fetch_object()) {
                                                        ?>
                                                            <tr>
                                                                <th><?php echo $of->officer_staff_no; ?></th>
                                                                <th><?php echo $of->officer_full_name; ?></th>
                                                                <th>
                                                                    Email: <?php echo $off->officer_email; ?><br>
                                                                    Phone:<?php echo $off->officer_mobile; ?> <br>
                                                                </th>
                                                                <td>

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