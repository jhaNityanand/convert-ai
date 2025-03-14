<?php
    $title = "Users | Convert Application";
    require_once('../layouts/config.php');
    require_once('../layouts/function.php');
    require_once('../layouts/header.php');

    $all_data = select_all('`users`', $conn);

    if(isset($_REQUEST['status_submit']))
    {
        if($_SESSION['user_login_detail']['role'] == "admin" && $_SESSION['user_login_detail']['id'] == $_REQUEST['created_by'])
        {
            if(isset($_REQUEST['id']) && isset($_REQUEST['status']))
            {
                if($_REQUEST['status'] == '0') {
                    $status = 1;
                } else {
                    $status = 0;
                }
                $data = ['status' => $status];
                $conditions = ['id' => $_REQUEST['id']];
                
                $return = update_data('`users`', $data, $conditions, $conn);
                if(!empty($return)) {
                    $message = "<div class='alert alert-success'>Record Updated Successfully (status).</div>";
                } else {
                    $message = "<div class='alert alert-danger'>Something Went Wrong (status).<br>".$return['error']."</div>";
                }
            }else {
                $message = "<div class='alert alert-danger'>Something Went Wrong (status).</div>";
            }
        } else {
            $message = "<div class='alert alert-danger reload'>You Don't have Permission to Access.</div>";
        }
    }

    if(isset($_REQUEST['password_submit']))
    {
        if($_SESSION['user_login_detail']['role'] == "admin" && $_SESSION['user_login_detail']['id'] == $_REQUEST['created_by'])
        {
            if(isset($_REQUEST['id']) && isset($_REQUEST['password']) && isset($_REQUEST['con_password']))
            {
                if($_REQUEST['password'] == $_REQUEST['con_password']) {
                    
                    $data = ['password' => sha1(md5($_REQUEST['password']))];
                    $conditions = ['id' => $_REQUEST['id']];
                    
                    $return = update_data('`users`', $data, $conditions, $conn);
                    if(!empty($return)) {
                        $message = "<div class='alert alert-success'>Record Updated Successfully (password).</div>";
                    } else {
                        $message = "<div class='alert alert-danger'>Something Went Wrong (password).<br>".$return['error']."</div>";
                    }
                } else {
                    $message = "<div class='alert alert-danger reload'>Password and Confirm Password not Matched.</div>";
                }
            } else {
                $message = "<div class='alert alert-danger'>Something Went Wrong (password).</div>";
            }
        } else {
            $message = "<div class='alert alert-danger reload'>You Don't have Permission to Access.</div>";
        }
    }

    if(isset($_REQUEST['d_id']) && isset($_REQUEST['c_id']))
    {
        if($_SESSION['user_login_detail']['role'] == "admin" && $_SESSION['user_login_detail']['id'] == $_REQUEST['c_id'])
        {
            $conditions = ['id' => $_REQUEST['d_id']];
            $return = delete_data('`users`', $conditions, $conn);

            if(!empty($return)) {
                $message = "<div class='alert alert-success'>Record Deleted Successfully.</div>";
            } else {
                $message = "<div class='alert alert-danger'>Something Went Wrong.<br>".$return['error']."</div>";
            }
        } else {
            $message = "<div class='alert alert-danger reload'>You Don't have Permission to Access.</div>";
        }
    }
?>

<div class="card card-body rounded bg-white">
    <div class="card-header">
        <h3>Users Data Display
            <div style="float: right;">
                <button onclick="add_new()" class="btn btn-ft border-2 rounded-5 btn-outline-primary"><b> Add New <i
                            class="fas fa-plus"></i> </b></button>
            </div>
        </h3>
        <?= (!empty($message)? $message : ''); ?>
    </div>
    <div class="card-body">
        <div class="row">
            <table>
                <thead>
                    <th>Sr. No.</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Users Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php foreach($all_data as $key => $val){ ?>
                    <tr>
                        <td><?= ($key + 1); ?></td>
                        <td><?= $val['name']; ?></td>
                        <td><?= $val['email']; ?></td>
                        <td><?= $val['role']; ?></td>
                        <td>
                            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                                <input type="hidden" name="id" value="<?= $val['id']; ?>">
                                <input type="hidden" name="created_by" value="<?= $val['created_by']; ?>">
                                <input type="hidden" name="status" value="<?= $val['status']; ?>">
                                <?= ($val['status'] == '0') ? '<button type="submit" name="status_submit" class="btn btn-ft border-2 rounded-5 btn-outline-dark"><b> InActive </b></button>' : '<button type="submit" name="status_submit" class="btn btn-ft border-2 rounded-5 btn-outline-info"><b> Active </b></button>' ?>
                            </form>
                        </td>
                        <td>
                            <button title="Password Change" onClick="password('<?= $val['id']; ?>', '<?= $val['created_by']; ?>')"
                                class="btn btn-ft border-2 rounded-5 btn-outline-secondary"><b> <i
                                        class="fas fa-eye"></i> </b></button>
                            &nbsp;
                            <button onClick="edit('<?= $val['id']; ?>', '<?= $val['created_by']; ?>')"
                                class="btn btn-ft border-2 rounded-5 btn-outline-success"><b> <i
                                        class="fas fa-edit"></i> </b></button>
                            &nbsp;
                            <button onClick="deletes('<?= $val['id']; ?>', '<?= $val['created_by']; ?>')"
                                class="btn btn-ft border-2 rounded-5 btn-outline-danger"><b> <i
                                        class="fas fa-trash"></i> </b></button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <input type="hidden" id="go_back" value="admin/users">
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Update Password</h4>
                    <button type="button" class="close btn btn-ft border-2 rounded-5 btn-outline-danger" data-dismiss="modal"><b> &times; </b></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label><b>password: </b></label>
                                <input type="text" class="form-control" name="password" value="" placeholder="Enter Password"
                                    required>
                                <small> <?= (!empty($password) ? $password : ''); ?></small>
                            </div>
                            <br>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label><b>Confirm password: </b></label>
                                <input type="text" class="form-control" name="con_password" value="" placeholder="Enter Confirm Password"
                                    required>
                                <small> <?= (!empty($con_password) ? $con_password : ''); ?></small>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <input type="hidden" name="id" id="id" value="">
                    <input type="hidden" name="created_by" id="created_by" value="">
                    <button type="button" class="close btn btn-ft border-2 rounded-5 btn-outline-danger" data-dismiss="modal"><b> Close </b></button>
                    &nbsp;&nbsp;&nbsp;
                    <button type="submit" name="password_submit" class="btn btn-ft border-2 rounded-5 btn-outline-success" data-dismiss="modal"><b> Submit </b></button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
    require_once('../layouts/footer.php');
?>

<script>
function add_new() {
    if (confirm('Are you sure?')) {
        window.location.href = "<?= base_url ?>admin/users/add.php";
    }
}

function edit(id, created_by) {
    if (confirm('Are you sure?')) {
        window.location.href = "<?= base_url ?>admin/users/edit.php?e_id=" + id;
    }
}

function deletes(id, created_by) {
    if (confirm('Are you sure?')) {
        window.location.href = "<?= base_url ?>admin/users/index.php?d_id="+id+"&c_id="+created_by;
    }
}

function password(id, created_by) {
    if (confirm('Are you sure?')) {
        $("#myModal").modal('show');
        $("#id").val(id);
        $("#created_by").val(created_by);
    }
}

$(".close").on("click", function(){
    $("#myModal").modal('hide');
});
</script>