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

/* Update Officer */
if (isset($_POST['update_officer'])) {
    $officer_id = $_POST['officer_id'];
    $officer_login_id = $_POST['officer_login_id'];
    $officer_full_name = $_POST['officer_full_name'];
    $officer_email  = $_POST['officer_email'];
    $officer_mobile = $_POST['officer_mobile'];
    $officer_staff_no = $_POST['officer_staff_no'];
    $login_password = sha1(md5($_POST['login_password']));
    $login_rank = $_POST['login_rank'];

    $query = "UPDATE  officer SET  officer_full_name =?, officer_email =?, officer_mobile =?, officer_staff_no =? WHERE officer_id = ?";
    $authquery = "UPDATE  login SET login_user_name =?, login_password =?, login_rank =? WHERE login_id =?";

    $stmt = $mysqli->prepare($query);
    $authstmt = $mysqli->prepare($authquery);

    $rc = $stmt->bind_param('sssss', $officer_full_name, $officer_email, $officer_mobile, $officer_staff_no, $officer_id);
    $rc = $authstmt->bind_param('ssss', $officer_email, $login_password, $login_rank, $officer_login_id);

    $stmt->execute();
    $authstmt->execute();

    if ($stmt && $authstmt) {
        $success = "Officer Account Updated";
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
        <?php require_once('../partials/aside.php');
        $login_id = $_SESSION['login_id'];
        $ret = "SELECT * FROM officer f INNER JOIN login l ON f.officer_login_id = l.login_id WHERE l.login_id = '$login_id' ";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($of = $res->fetch_object()) {
        ?>
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
                                <h1 class="page-title"> My Profile </h1>
                            </header><!-- /.page-title-bar -->
                            <!-- .page-section -->
                            <div class="page-section">
                                <!-- .section-block -->
                                <!-- End Modal -->
                                <div class="section-block">
                                    <div class="row">
                                        <div class="col-12 col-lg-12 col-xl-12">
                                            <!-- .card -->
                                            <div class="card card-fluid">
                                                <!-- .card-body -->
                                                <div class="card-body">
                                                    <form method="post" enctype="multipart/form-data" role="form">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="">Full Name</label>
                                                                    <input type="text" value="<?php echo $of->officer_full_name; ?>" required name="officer_full_name" class="form-control">
                                                                    <input type="hidden" value="<?php echo $of->officer_id; ?>" required name="officer_id" class="form-control">
                                                                    <input type="hidden" value="<?php echo $of->officer_login_id; ?>" required name="officer_login_id" class="form-control">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="">Officer Number</label>
                                                                    <input type="text" value="<?php echo $of->officer_staff_no; ?>" required name="officer_staff_no" class="form-control">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="">Email Address</label>
                                                                    <input type="email" value="<?php echo $of->officer_email; ?>" required name="officer_email" class="form-control">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="">Mobile Numner</label>
                                                                    <input type="text" value="<?php echo $of->officer_mobile; ?>" required name="officer_mobile" class="form-control">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="">Login Password</label>
                                                                    <input type="text" required name="login_password" class="form-control">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="">Login Rank</label>
                                                                    <select id="bss1" name="login_rank" class="form-control" data-toggle="selectpicker" data-width="100%">
                                                                        <option><?php echo $of->login_rank; ?></option>
                                                                        <option>Officer</option>
                                                                        <option>Administrator</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="text-right">
                                                            <button type="submit" name="update_officer" class="btn btn-primary">Update Officer</button>
                                                        </div>
                                                        <br>
                                                    </form>
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
        <?php
        } ?>
    </div><!-- /.app -->
    <!-- BEGIN BASE JS -->
    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>