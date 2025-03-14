
<?php
    require_once('../layouts/config.php');
    require_once('../layouts/function.php');
    require_once('../layouts/header.php');

    if($_SESSION['user_login_detail']['role'] == "user")
    {
        header("Location: ".base_url."admin");
    }

    if(isset($_REQUEST['submit']))
    {
        if(empty($_REQUEST['email'])) {
            $email = "Email Field is Required.";
        }
        if(empty($_REQUEST['password'])) {
            $password = "Password Field is Required.";
        }
        if(empty($_REQUEST['name'])) {
            $name = "Full Name Field is Required.";
        }
        if(empty($_REQUEST['role'])) {
            $role = "User Role Field is Required.";
        }
        $data = [
            '`created_by`' => $_SESSION['user_login_detail']['id'],
            '`email`' => $_REQUEST['email'],
            '`password`' => sha1(md5($_REQUEST['password'])),
            '`name`' => $_REQUEST['name'],
            '`role`' => $_REQUEST['role'],
        ];

        if (in_array(null, $data, true) || in_array('', $data, true)) {
            // There are null (or empty) values.
        } else {
            $conditions = ['email' => $_REQUEST['email']];
            $return = single_row('`users`', $conditions, $conn);
            if(!empty($return['email'])) {
                $message = "<div class='alert alert-danger not_reload'>Email Already Exits.</div>";
            } else {
                $return = insert('`users`', $data, $conn);
                if(!empty($return) && !empty($return['last_id']) != 0) {
                    $message = "<div class='alert alert-success'>Record Inserted Successfully.</div>";
                } else {
                    $message = "<div class='alert alert-danger'>Something Went Wrong.<br>".$return['error']."</div>";
                }
            }
        }
    }
?>

<form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
    <div class="card card-body rounded bg-white">
        <div class="card-header">
            <h3>Users Data Insert</h3>
            <div class="empty_div"><?= (!empty($message)? $message : ''); ?></div>
        </div>
        <div class="card-body">
            
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>Full Name: </b></label>
                        <input type="text" class="form-control" name="name" value="" placeholder="Enter Full Name" required>
                        <small> <?= (!empty($name) ? $name : ''); ?></small>
                    </div>
                    <br>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>User Role: </b></label>
                        <select class="form-control" name="role" required>
                            <option value="">Select a Option</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                        <small> <?= (!empty($role) ? $role : ''); ?></small>
                    </div>
                    <br>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>Email: </b></label>
                        <input type="email" class="form-control" name="email" value="" placeholder="Enter Email" required>
                        <small> <?= (!empty($email) ? $email : ''); ?></small>
                    </div>
                    <br>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>password: </b></label>
                        <input type="text" class="form-control" name="password" value="" placeholder="Enter Password"
                            required>
                        <small> <?= (!empty($password) ? $password : ''); ?></small>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-12">
                    <div style="float: right;">
                        <input type="hidden" id="go_back" value="admin/users">
                        <button type="button" class="btn btn-ft border-2 rounded-5 btn-outline-danger"
                            onClick="history.back();"><b> Back </b></button>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="submit" class="btn btn-ft border-2 rounded-5 btn-outline-primary"
                            name="submit"><b>
                                Submit </b></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
    require_once('../layouts/footer.php');
?>
