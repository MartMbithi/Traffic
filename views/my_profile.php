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
if (isset($_POST['update'])) {
    $motorist_id = $_POST['motorist_id'];
    $motorist_login_id = $_POST['motorist_login_id'];
    $motorist_full_name = $_POST['motorist_full_name'];
    $motorist_email  = $_POST['motorist_email'];
    $motorist_mobile = $_POST['motorist_mobile'];
    $motorist_id_no = $_POST['motorist_id_no'];
    $motorist_license_no = $_POST['motorist_license_no'];
    $motorist_dob = $_POST['motorist_dob'];

    $login_password = sha1(md5($_POST['login_password']));
    $login_rank = $_POST['login_rank'];

    $query = "UPDATE motorist 
    SET  motorist_full_name =?,  motorist_email =?, motorist_mobile =?,
     motorist_id_no =?, motorist_license_no =?,  motorist_dob =? WHERE motorist_id=? ";
    $authquery = "UPDATE  login SET  login_user_name =?, login_password =?, login_rank =? WHERE login_id =?";

    $stmt = $mysqli->prepare($query);
    $authstmt = $mysqli->prepare($authquery);

    $rc = $stmt->bind_param(
        'sssssss',
        $motorist_full_name,
        $motorist_email,
        $motorist_mobile,
        $motorist_id_no,
        $motorist_license_no,
        $motorist_dob,
        $motorist_id
    );
    $rc = $authstmt->bind_param('ssss',  $motorist_email, $login_password, $login_rank, $motorist_login_id);

    $stmt->execute();
    $authstmt->execute();

    if ($stmt && $authstmt) {
        $success = "Motoriest Updated";
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
        <?php require_once('../partials/my_aside.php');
        $login_id = $_SESSION['login_id'];
        $ret = "SELECT * FROM motorist m INNER JOIN login l ON m.motorist_login_id = l.login_id WHERE l.login_id = '$login_id'";
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
                                                                    <input type="text" value="<?php echo $of->motorist_full_name; ?>" required name="motorist_full_name" class="form-control">
                                                                    <input type="hidden" value="<?php echo $of->motorist_id; ?>" required name="motorist_id" class="form-control">
                                                                    <input type="hidden" value="<?php echo $of->motorist_login_id; ?>" required name="motorist_login_id" class="form-control">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="">Email</label>
                                                                    <input type="text" value="<?php echo $of->motorist_email; ?>" required name="motorist_email" class="form-control">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="">Mobile</label>
                                                                    <input type="text" value="<?php echo $of->motorist_mobile; ?>" required name="motorist_mobile" class="form-control">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="">ID No</label>
                                                                    <input type="text" value="<?php echo $of->motorist_id_no; ?>" required name="motorist_id_no" class="form-control">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="">License Number</label>
                                                                    <input type="text" value="<?php echo $of->motorist_license_no; ?>" required name="motorist_license_no" class="form-control">
                                                                </div>

                                                                <div class="form-group col-md-6">
                                                                    <label for="">DOB</label>
                                                                    <input type="date" required value="<?php echo $of->motorist_dob; ?>" name="motorist_dob" class="form-control">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="">Login Password</label>
                                                                    <input type="text" required name="login_password" class="form-control">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="">Login Rank</label>
                                                                    <select id="bss1" name="login_rank" class="form-control" data-toggle="selectpicker" data-width="100%">
                                                                        <option>Motorist</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="text-right">
                                                            <button type="submit" name="update" class="btn btn-primary">Update Profile</button>
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