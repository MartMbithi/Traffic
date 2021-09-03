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
require_once('../config/config.php');
require_once('../config/codeGen.php');

/* Sign In */
if (isset($_POST['add'])) {
    $motorist_id = $sys_gen_id;
    $motorist_login_id = $sys_gen_id_alt_1;

    $motorist_full_name = $_POST['motorist_full_name'];
    $motorist_email  = $_POST['motorist_email'];
    $motorist_mobile = $_POST['motorist_mobile'];
    $motorist_id_no = $_POST['motorist_id_no'];
    $motorist_license_no = $_POST['motorist_license_no'];
    $motorist_dob = $_POST['motorist_dob'];

    $login_password = sha1(md5($_POST['login_password']));
    $login_rank = $_POST['login_rank'];

    $query = "INSERT INTO motorist (motorist_id, motorist_login_id, motorist_full_name,  motorist_email, motorist_mobile, motorist_id_no, motorist_license_no,  motorist_dob) VALUES(?,?,?,?,?,?,?,?)";
    $authquery = "INSERT INTO login (login_id, login_user_name, login_password, login_rank) VALUES(?,?,?,?)";

    $stmt = $mysqli->prepare($query);
    $authstmt = $mysqli->prepare($authquery);

    $rc = $stmt->bind_param(
        'ssssssss',
        $motorist_id,
        $motorist_login_id,
        $motorist_full_name,
        $motorist_email,
        $motorist_mobile,
        $motorist_id_no,
        $motorist_license_no,
        $motorist_dob
    );
    $rc = $authstmt->bind_param('ssss', $motorist_login_id, $motorist_email, $login_password, $login_rank);

    $stmt->execute();
    $authstmt->execute();

    if ($stmt && $authstmt) {
        $success = "Account Created, Proceed To Login";
    } else {
        $info = "Please Try Again Or Try Later";
    }
}

require_once('../partials/head.php');
?>

<body>

    <main class="auth">
        <form method="post" class="auth-form">
            <h1 class="text-primary text-center"><b>Sign Up</b></h1>
            <!-- .form-group -->
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="">Full Name</label>
                    <input type="text" required name="motorist_full_name" class="form-control">
                </div>
                <div class="form-group col-md-12">
                    <label for="">Email</label>
                    <input type="text" required name="motorist_email" class="form-control">
                </div>
                <div class="form-group col-md-12">
                    <label for="">Mobile</label>
                    <input type="text" required name="motorist_mobile" class="form-control">
                </div>
                <div class="form-group col-md-12">
                    <label for="">ID No</label>
                    <input type="text" required name="motorist_id_no" class="form-control">
                </div>
                <div class="form-group col-md-12">
                    <label for="">License Number</label>
                    <input type="text" required name="motorist_license_no" class="form-control">
                </div>
                <div class="form-group col-md-12">
                    <label for="">DOB</label>
                    <input type="date" required name="motorist_dob" class="form-control">
                </div>
                <div class="form-group col-md-12">
                    <label for="">Login Password</label>
                    <input type="password" required name="login_password" class="form-control">
                </div>
                <div style="display: none;" class="form-group col-md-6">
                    <label for="">Login Rank</label>
                    <select id="bss1" name="login_rank" class="form-control" data-toggle="selectpicker" data-width="100%">
                        <option>Motorist</option>
                    </select>
                </div>
            </div>
            </div><!-- /.form-group -->
            <!-- .form-group -->
            <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block" name="add" type="submit">Sign Up</button>
            </div><!-- /.form-group -->
            <!-- .form-group -->

            <!-- recovery links -->
            <div class="text-center pt-3">
                <a href="reset_password" class="link">Forgot Password?</a>
                <p>
                    Have a motorist account? <a href="../">Login</a>
                </p>
            </div><!-- /recovery links -->
        </form><!-- /.auth-form -->
        <!-- copyright -->
        <?php require_once('../partials/footer.php'); ?>
    </main><!-- /.auth -->
    <!-- BEGIN BASE JS -->
    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>