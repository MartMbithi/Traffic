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
/* Login */
if (isset($_POST['login'])) {

    $login_user_name = trim($_POST['login_user_name']);
    $login_password = sha1(md5($_POST['login_password']));
    $login_rank  = $_POST['login_rank'];

    $stmt = $mysqli->prepare("SELECT *
    FROM login  WHERE  login_user_name =? AND login_password =? AND login_rank =?");
    $stmt->bind_param('sss', $login_user_name, $login_password, $login_rank);
    $stmt->execute();
    $stmt->bind_result($login_user_name, $login_password, $login_rank, $login_id);
    $rs = $stmt->fetch();

    //Persist User Sessions
    $_SESSION['login_id'] = $login_id;
    $_SESSION['login_rank'] = $login_rank;

    if ($rs && $login_rank == 'Administrator') {
        header("location:admin_dashboard");
    } else if ($rs && $login_rank == 'Officer') {
        header("location:officer_dashboard");
    } else if ($rs && $login_rank == 'Motorist') {
        header("location:motorist_dashboard");
    } else {
        $err = "Incorrect Login Username, Login Rank Or Password";
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
            <h1 class="text-primary text-center"><b>Sign In</b></h1>
            <!-- .form-group -->
            <div class="form-group">
                <div class="form-label-group">
                    <input type="text" id="inputUser" class="form-control" name="login_user_name" placeholder="Username" autofocus=""> <label for="inputUser">Username</label>
                </div>
            </div><!-- /.form-group -->
            <!-- .form-group -->
            <div class="form-group">
                <div class="form-label-group">
                    <input type="password" id="inputPassword" name="login_password" class="form-control" placeholder="Password"> <label for="inputPassword">Password</label>
                </div>
            </div><!-- /.form-group -->
            <div class="form-group">
                <div class="form-label-group">
                    <label class="control-label">Login In As</label>
                    <select id="bss1" name="login_rank" class="form-control" data-toggle="selectpicker" data-width="100%">
                        <option>Administrator</option>
                        <option>Officer</option>
                        <option>Motorist</option>
                    </select>
                </div><!-- /.form-group -->
            </div>
            </div><!-- /.form-group -->
            <!-- .form-group -->
            <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Sign In</button>
            </div><!-- /.form-group -->
            <!-- .form-group -->

            <!-- recovery links -->
            <div class="text-center pt-3">
                <a href="reset_password" class="link">Forgot Password?</a>
                <p>
                    Don't have a motorist account? <a href="signup">Create One</a>
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