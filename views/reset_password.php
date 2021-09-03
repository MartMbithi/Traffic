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
if (isset($_POST['Reset_Password'])) {
    $login_user_name = $_POST['login_user_name'];
    $query = mysqli_query($mysqli, "SELECT * from `login` WHERE login_user_name = '" . $login_user_name . "' ");
    $num_rows = mysqli_num_rows($query);

    if ($num_rows > 0) {
        $n = date('y'); //Load Mumble Jumble
        $new_password = bin2hex(random_bytes($n));
        $query = "UPDATE login SET  login_password=? WHERE  login_user_name =? ";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('ss', $new_password, $login_user_name);
        $stmt->execute();
        if ($stmt) {
            $_SESSION['login_user_name'] = $login_user_name;
            $success = "Password Reset" && header("refresh:1; url=confirm_password");
        } else {
            $err = "Password reset failed";
        }
    } else {
        $err = "User Account Does Not Exist";
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
            <h1 class="text-primary text-center"><b>Reset Password</b></h1>
            <!-- .form-group -->
            <div class="form-group">
                <div class="form-label-group">
                    <input type="text" id="inputUser" class="form-control" required name="login_user_name" placeholder="Username" autofocus=""> <label for="inputUser">Username</label>
                </div>
            </div><!-- /.form-group -->

            </div><!-- /.form-group -->
            <!-- .form-group -->
            <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block" name="Reset_Password" type="submit">Reset Password</button>
            </div><!-- /.form-group -->
            <!-- .form-group -->

            <!-- recovery links -->
            <div class="text-center pt-3">
                <a href="../" class="link">Remembered Password?</a>
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