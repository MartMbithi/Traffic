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
/* Confirm Passsword */
if (isset($_POST['Confirm_Password'])) {

    $login_user_name  = $_SESSION['login_user_name'];
    $new_password = sha1(md5($_POST['new_password']));
    $confirm_password = sha1(md5($_POST['confirm_password']));
    /* Check If Passwords Match */
    if ($new_password != $confirm_password) {
        /* Die */
        $err = "Passwords Does Not Match";
    } else {
        /* Update Password */
        $query = "UPDATE login  SET  login_password =? WHERE  login_user_name = ? ";
        $stmt = $mysqli->prepare($query);
        //bind paramaters
        $rc = $stmt->bind_param('ss',  $confirm_password, $login_user_name);
        $stmt->execute();
        if ($stmt) {
            $success = "Password Reset" && header("refresh:1; url=../");
        } else {
            $err = "Password Reset Failed";
        }
    }
}
require_once('../partials/head.php');
?>

<body>

    <main class="auth">
        <header id="auth-header" class="auth-header" style="background-image: url(../public/images/background.jpg);">
            <h1>
                <br>
            </h1>
        </header><!-- form -->
        <form method="post" class="auth-form">
            <h1 class="text-primary text-center"><b>Confirm Password</b></h1>
            <!-- .form-group -->
            <div class="form-group">
                <div class="form-label-group">
                    <input type="password" id="inputPassword" required name="new_password" class="form-control" placeholder="Password"> <label for="inputPassword">New Password</label>
                </div>
            </div><!-- /.form-group -->
            <div class="form-group">
                <div class="form-label-group">
                    <input type="password" id="inputPassword" required name="confirm_password" class="form-control" placeholder="Password"> <label for="inputPassword">Confirm Password</label>
                </div>
            </div><!-- /.form-group -->
            </div><!-- /.form-group -->
            <!-- .form-group -->
            <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block" name="Confirm_Password" type="submit">Confirm Password</button>
            </div><!-- /.form-group -->
        </form><!-- /.auth-form -->
        <!-- copyright -->
        <?php require_once('../partials/footer.php'); ?>
    </main><!-- /.auth -->
    <!-- BEGIN BASE JS -->
    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>