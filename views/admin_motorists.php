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
/* Add Officer */
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

    $query = "INSERT INTO motorist (motorist_id, motorist_login_id, 
    motorist_full_name,  motorist_email, motorist_mobile, motorist_id_no, motorist_license_no,  motorist_dob ) VALUES(?,?,?,?,?,?,?,?)";
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
        $success = "Motoriest Added";
    } else {
        $info = "Please Try Again Or Try Later";
    }
}

/* Update Officer */
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

/* Delete Officer */
if (isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    $login = $_GET['login'];

    $adn = "DELETE FROM  motorist WHERE motorist_id = ? ";
    $auth_adn = "DELETE FROM  login WHERE login_id = ? ";

    $stmt = $mysqli->prepare($adn);
    $auth_stmt = $mysqli->prepare($auth_adn);

    $stmt->bind_param('s', $delete);
    $auth_stmt->bind_param('s', $login);

    $stmt->execute();
    $auth_stmt->execute();

    $stmt->close();
    $auth_stmt->close();

    if ($stmt && $auth_stmt) {
        $success = "Deleted" && header("refresh:1; url=admin_motorists");
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
                            <h1 class="page-title"> Motorists </h1>
                        </header><!-- /.page-title-bar -->
                        <!-- .page-section -->
                        <div class="page-section">
                            <!-- .section-block -->
                            <!-- grid column -->
                            <div class="text-right">
                                <a href="#add_modal" class="btn btn-outline-primary" data-toggle="modal">
                                    Add Motorist
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
                                                            <input type="text" required name="motorist_full_name" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Email</label>
                                                            <input type="text" required name="motorist_email" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Mobile</label>
                                                            <input type="email" required name="motorist_mobile" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">ID No</label>
                                                            <input type="text" required name="motorist_id_no" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">License Number</label>
                                                            <input type="text" required name="motorist_license_no" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">DOB</label>
                                                            <input type="date" required name="motorist_dob" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">DOB</label>
                                                            <input type="date" required name="motorist_dob" class="form-control">
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
                                                    <button type="submit" name="add" class="btn btn-primary">Add Motorist</button>
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
                                                <table class="table table-">
                                                    <thead>
                                                        <tr>
                                                            <th>Full Name</th>
                                                            <th>DOB</th>
                                                            <th>ID No</th>
                                                            <th>Contacts</th>
                                                            <th>License</th>
                                                            <th>Manage</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $ret = "SELECT * FROM motorist m INNER JOIN login l ON m.motorist_login_id = l.login_id ";
                                                        $stmt = $mysqli->prepare($ret);
                                                        $stmt->execute(); //ok
                                                        $res = $stmt->get_result();
                                                        while ($of = $res->fetch_object()) {
                                                        ?>
                                                            <tr>
                                                                <th><?php echo $of->motorist_full_name; ?></th>
                                                                <th><?php echo $of->motorist_dob; ?></th>
                                                                <th><?php echo $of->motorist_id_no; ?></th>
                                                                <th>
                                                                    Email: <?php echo $of->motorist_email; ?><br>
                                                                    Phone:<?php echo $of->motorist_mobile; ?> <br>
                                                                </th>
                                                                <th><?php echo $of->motorist_license_no; ?></th>
                                                                <td>
                                                                    <a data-toggle="modal" href="#update-<?php echo $of->motorist_id; ?>" class="btn btn-sm btn-icon btn-secondary"><i class="fa fa-pencil-alt"></i>
                                                                        <span class="sr-only">Edit</span></a>
                                                                    <!-- Update Modal -->
                                                                    <div class="modal fade" id="update-<?php echo $of->motorist_id; ?>">
                                                                        <div class="modal-dialog  modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title">Fill All Fields </h4>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
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
                                                                                            <button type="submit" name="update" class="btn btn-primary">Update Motorist</button>
                                                                                        </div>
                                                                                        <br>
                                                                                    </form>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    if ($_SESSION['login_rank'] == 'Administrator') {
                                                                    ?>
                                                                        <!-- End Modal -->
                                                                        <a data-toggle="modal" href="#delete-<?php echo $of->motorist_id; ?>" class="btn btn-sm btn-icon btn-secondary"><i class="far fa-trash-alt"></i>
                                                                            <span class="sr-only">
                                                                                Delete
                                                                            </span>
                                                                        </a>
                                                                    <?php
                                                                    } ?>

                                                                    <!-- Delete Modal -->
                                                                    <div class="modal fade" id="delete-<?php echo $of->motorist_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETE</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body text-center text-danger">
                                                                                    <h4>Delete Officer Record</h4>
                                                                                    <br>
                                                                                    <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                                                                                    <a href="admin_motorists?delete=<?php echo $of->motorist_id; ?>&login=<?php echo $of->motorist_login_id; ?>" class="text-center btn btn-danger"> Delete </a>
                                                                                    <br>
                                                                                    <br>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End Modal -->
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