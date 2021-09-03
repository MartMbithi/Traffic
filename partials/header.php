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

$login_id = $_SESSION['login_id'];
$ret = "SELECT * FROM login WHERE login_id ='$login_id'";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($user = $res->fetch_object()) {
?>
    <header class="app-header app-header-dark">
        <!-- .top-bar -->
        <div class="top-bar">
            <!-- .top-bar-brand -->
            <div class="top-bar-brand">
                <!-- toggle aside menu -->
                <button class="hamburger hamburger-squeeze mr-2" type="button" data-toggle="aside-menu" aria-label="toggle aside menu"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button> <!-- /toggle aside menu -->
                <a href="">
                    <h1 class="text-warning">TIMS</h1>
                </a>
            </div><!-- /.top-bar-brand -->
            <!-- .top-bar-list -->
            <div class="top-bar-list">
                <!-- .top-bar-item -->
                <div class="top-bar-item px-2 d-md-none d-lg-none d-xl-none">
                    <!-- toggle menu -->
                    <button class="hamburger hamburger-squeeze" type="button" data-toggle="aside" aria-label="toggle menu"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button> <!-- /toggle menu -->
                </div><!-- /.top-bar-item -->
                <!-- .top-bar-item -->
                <div class="top-bar-item top-bar-item-full">
                    <!-- .top-bar-search -->

                </div><!-- /.top-bar-item -->
                <!-- .top-bar-item -->
                <div class="top-bar-item top-bar-item-right px-0 d-none d-sm-flex">
                    <!-- .nav -->
                    <!-- .btn-account -->
                    <div class="dropdown d-none d-md-flex">
                        <button class="btn-account" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="user-avatar user-avatar-md"><img src="../public/uploads/user_data/no-profile.png" alt=""></span> <span class="account-summary pr-lg-4 d-none d-lg-block">
                                <span class="account-name"><?php echo $user->login_user_name; ?></span>
                                <span class="account-description"><?php echo $user->login_rank; ?> </span></span></button> <!-- .dropdown-menu -->
                        <div class="dropdown-menu">
                            <div class="dropdown-arrow d-lg-none" x-arrow=""></div>
                            <div class="dropdown-arrow ml-3 d-none d-lg-block"></div>
                            <h6 class="dropdown-header d-none d-md-block d-lg-none">
                                <?php echo $user->login_user_name; ?>
                            </h6>
                            <a class="dropdown-item" href="admin_profile">
                                <span class="dropdown-icon oi oi-person"></span>
                                Profile
                            </a>
                            <a class="dropdown-item" href="logout">
                                <span class="dropdown-icon oi oi-account-logout"></span>
                                Logout
                            </a>
                        </div><!-- /.dropdown-menu -->
                    </div><!-- /.btn-account -->
                </div><!-- /.top-bar-item -->
            </div><!-- /.top-bar-list -->
        </div><!-- /.top-bar -->
    </header><!-- /.app-header -->
<?php
} ?>