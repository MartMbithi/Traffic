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

/* Add  */
if (isset($_POST['add'])) {
    $vehicle_type_id = $sys_gen_id;
    $vehicle_type_name = $_POST['vehicle_type_name'];
    $vehicle_type_desc  = $_POST['vehicle_type_desc'];
    $query = "INSERT INTO vehicle_types (vehicle_type_id, vehicle_type_name, vehicle_type_desc) VALUES(?,?,?)";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        'sss',
        $vehicle_type_id,
        $vehicle_type_name,
        $vehicle_type_desc

    );
    $stmt->execute();
    if ($stmt) {
        $success = "Vehicle Category Added";
    } else {
        $info = "Please Try Again Or Try Later";
    }
}

/* Update  */
if (isset($_POST['update'])) {
    $vehicle_type_id = $_POST['vehicle_type_id'];
    $vehicle_type_name = $_POST['vehicle_type_name'];
    $vehicle_type_desc  = $_POST['vehicle_type_desc'];

    $query = "UPDATE vehicle_types SET  vehicle_type_name =?,  vehicle_type_desc =? WHERE vehicle_type_id =? ";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        'sss',
        $vehicle_type_name,
        $vehicle_type_desc,
        $vehicle_type_id
    );
    $stmt->execute();
    if ($stmt) {
        $success = "Vehicle Category Updated";
    } else {
        $info = "Please Try Again Or Try Later";
    }
}

/* Delete Officer */
if (isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    $adn = "DELETE FROM  vehicle_types WHERE vehicle_type_id = ? ";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $delete);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = "Deleted" && header("refresh:1; url=admin_vehicles");
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
                            <h1 class="page-title"> Vehicle Categories </h1>
                        </header><!-- /.page-title-bar -->
                        <!-- .page-section -->
                        <div class="page-section">
                            <!-- .section-block -->
                            <!-- grid column -->
                            <div class="text-right">
                                <a href="#add_modal" class="btn btn-outline-primary" data-toggle="modal">
                                    Add Vehicle Category
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
                                                        <div class="form-group col-md-12">
                                                            <label for="">Vehicle Category</label>
                                                            <input type="text" required name="vehicle_type_name" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="">Details</label>
                                                            <textarea type="text" rows="5" required name="vehicle_type_desc" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="submit" name="add" class="btn btn-primary">Add Vehicle Category</button>
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
                                                            <th>Type Name</th>
                                                            <th>Details</th>
                                                            <th>Manage</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $ret = "SELECT * FROM vehicle_types ";
                                                        $stmt = $mysqli->prepare($ret);
                                                        $stmt->execute(); //ok
                                                        $res = $stmt->get_result();
                                                        while ($of = $res->fetch_object()) {
                                                        ?>
                                                            <tr>
                                                                <th><?php echo $of->vehicle_type_name; ?></th>
                                                                <th><?php echo $of->vehicle_type_desc; ?></th>
                                                                <td>
                                                                    <a data-toggle="modal" href="#update-<?php echo $of->vehicle_type_id; ?>" class="btn btn-sm btn-icon btn-secondary"><i class="fa fa-pencil-alt"></i>
                                                                        <span class="sr-only">Edit</span></a>
                                                                    <!-- Update Modal -->
                                                                    <div class="modal fade" id="update-<?php echo $of->vehicle_type_id; ?>">
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
                                                                                                <div class="form-group col-md-12">
                                                                                                    <label for="">Vehicle Category</label>
                                                                                                    <input type="text" required name="vehicle_type_name" value="<?php echo $of->vehicle_type_name; ?>" class="form-control">
                                                                                                    <input type="hidden" required name="vehicle_type_id" value="<?php echo $of->vehicle_type_id; ?>" class="form-control">
                                                                                                </div>
                                                                                                <div class="form-group col-md-12">
                                                                                                    <label for="">Details</label>
                                                                                                    <textarea type="text" rows="5" required name="vehicle_type_desc" class="form-control"><?php echo $of->vehicle_type_desc; ?></textarea>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="text-right">
                                                                                            <button type="submit" name="update" class="btn btn-primary">Update Vehicle Category</button>
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
                                                                        <a data-toggle="modal" href="#delete-<?php echo $of->vehicle_type_id; ?>" class="btn btn-sm btn-icon btn-secondary"><i class="far fa-trash-alt"></i>
                                                                            <span class="sr-only">
                                                                                Delete
                                                                            </span>
                                                                        </a>
                                                                    <?php
                                                                    } ?>

                                                                    <!-- Delete Modal -->
                                                                    <div class="modal fade" id="delete-<?php echo $of->vehicle_type_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETE</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body text-center text-danger">
                                                                                    <h4>Delete Vehicle Type Record</h4>
                                                                                    <br>
                                                                                    <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                                                                                    <a href="admin_vehicles?delete=<?php echo $of->vehicle_type_id; ?>" class="text-center btn btn-danger"> Delete </a>
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