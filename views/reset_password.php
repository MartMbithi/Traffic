<?php
/*
 * Created on Fri Sep 03 2021
 *
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
                    <input type="text" id="inputUser" class="form-control" name="login_user_name" placeholder="Username" autofocus=""> <label for="inputUser">Username</label>
                </div>
            </div><!-- /.form-group -->

            </div><!-- /.form-group -->
            <!-- .form-group -->
            <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Reset Password</button>
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