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
    <aside class="app-aside app-aside-expand-md app-aside-light">
        <!-- .aside-content -->
        <div class="aside-content">
            <!-- .aside-header -->
            <header class="aside-header d-block d-md-none">
                <!-- .btn-account -->
                <button class="btn-account" type="button" data-toggle="collapse" data-target="#dropdown-aside">
                    <span class="user-avatar user-avatar-lg">
                        <img src="../public/uploads/user_data/no-profile.png" alt=""></span>
                    <span class="account-icon"><span class="fa fa-caret-down fa-lg">
                        </span></span> <span class="account-summary">
                        <span class="account-name"><?php echo $user->login_user_name; ?></span>
                        <span class="account-description"><?php echo $user->login_rank; ?></span></span></button> <!-- /.btn-account -->
                <!-- .dropdown-aside -->
                <div id="dropdown-aside" class="dropdown-aside collapse">
                    <!-- dropdown-items -->
                    <div class="pb-3">
                        <a class="dropdown-item" href="admin_profile">
                            <span class="dropdown-icon oi oi-person"></span>
                            Profile
                        </a>
                        <a class="dropdown-item" href="logout">
                            <span class="dropdown-icon oi oi-account-logout"></span>
                            Logout</a>
                        <div class="dropdown-divider"></div>
                    </div><!-- /dropdown-items -->
                </div><!-- /.dropdown-aside -->
            </header><!-- /.aside-header -->
            <!-- .aside-menu -->
            <div class="aside-menu overflow-hidden">
                <!-- .stacked-menu -->
                <nav id="stacked-menu" class="stacked-menu">
                    <!-- .menu -->
                    <ul class="menu">
                        <!-- .menu-item -->
                        <li class="menu-item ">
                            <a href="admin_dashboard" class="menu-link">
                                <span class="menu-icon fas fa-home"></span>
                                <span class="menu-text">Dashboard</span>
                            </a>
                        </li><!-- /.menu-item -->
                        <li class="menu-item ">
                            <a href="admin_officers" class="menu-link">
                                <span class="menu-icon fas fa-user-astronaut"></span>
                                <span class="menu-text">Oficers</span>
                            </a>
                        </li><!-- /.menu-item -->
                        <li class="menu-item">
                            <a href="admin_motorists" class="menu-link">
                                <span class="menu-icon fas fa-biking"></span>
                                <span class="menu-text">Motorists</span>
                            </a>
                        </li><!-- /.menu-item -->
                        <li class="menu-item ">
                            <a href="admin_vehicles" class="menu-link">
                                <span class="menu-icon fas fa-car"></span>
                                <span class="menu-text">Vehicles</span>
                            </a>
                        </li><!-- /.menu-item -->
                        <li class="menu-item ">
                            <a href="admin_traffic_rules" class="menu-link">
                                <span class="menu-icon fas fa-traffic-light"></span>
                                <span class="menu-text">Traffic Rules</span>
                            </a>
                        </li><!-- /.menu-item -->
                        <li class="menu-item ">
                            <a href="admin_offences" class="menu-link">
                                <span class="menu-icon fas fa-car-crash"></span>
                                <span class="menu-text">Offences</span>
                            </a>
                        </li><!-- /.menu-item -->
                        <li class="menu-item ">
                            <a href="admin_payments" class="menu-link">
                                <span class="menu-icon fas fa-money-bill-alt"></span>
                                <span class="menu-text">Payments</span>
                            </a>
                        </li><!-- /.menu-item -->
                        <!-- .menu-header -->
                        <li class="menu-header">System Reports </li><!-- /.menu-header -->
                        <!-- .menu-item -->
                        <li class="menu-item has-child ">
                            <a href="#" class="menu-link "><span class="menu-icon oi oi-puzzle-piece"></span> <span class="menu-text">Reports</span></a> <!-- child menu -->
                            <ul class="menu">
                                <li class="menu-item">
                                    <a href="reports_officers" class="menu-link">Officers</a>
                                </li>
                                <li class="menu-item">
                                    <a href="reports_motorists" class="menu-link">Motorists</a>
                                </li>
                                <li class="menu-item">
                                    <a href="reports_offences" class="menu-link">Offences</a>
                                </li>
                                <li class="menu-item">
                                    <a href="reports_payments" class="menu-link">Payments</a>
                                </li>
                            </ul><!-- /child menu -->
                        </li><!-- /.menu-item -->
                    </ul><!-- /.menu -->
                </nav><!-- /.stacked-menu -->
            </div><!-- /.aside-menu -->
        </div><!-- /.aside-content -->
    </aside><!-- /.app-aside -->
<?php
} ?>