
<?php
    require_once('../layouts/config.php');
    require_once('../layouts/function.php');
    require_once('../layouts/header.php');

    if($_SESSION['user_login_detail']['role'] == "user")
    {
        header("Location: ".base_url."admin");
    }

    if(isset($_REQUEST['e_id']) && !empty($_REQUEST['e_id'])) {
        $conditions = ['id' => $_REQUEST['e_id']];
        $return = single_row('`users`', $conditions, $conn);

        if(!empty($return['id'])) {

            if($_SESSION['user_login_detail']['id'] != $return['created_by'])
            {
                $message = "<div class='alert alert-danger reload'>You Don't have Permission to Access.</div>";
            }
            // $message = "<div class='alert alert-success'>Record Get Successfully.</div>";
        } 
        else if(empty($return['id'])) {
            $message = "<div class='alert alert-danger reload'>Record not Found.</div>";
        }
        else {
            $message = "<div class='alert alert-danger'>Something Went Wrong.<br>".$return['error']."</div>";
        }
    } else {
        header("Location: ".base_url."admin/users");
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
            'email' => $_REQUEST['email'],
            'password' => sha1(md5($_REQUEST['password'])),
            'name' => $_REQUEST['name'],
            'role' => $_REQUEST['role'],
        ];

        if (in_array(null, $data, true) || in_array('', $data, true)) {
            // There are null (or empty) values.
        } else {
            $conditions = ['id' => $_REQUEST['e_id']];
            $return = update_data('`users`', $data, $conditions, $conn);

            if(!empty($return)) {
                $message = "<div class='alert alert-success'>Record Updated Successfully.</div>";
            } else {
                $message = "<div class='alert alert-danger'>Something Went Wrong.<br>".$return['error']."</div>";
            }
        }
    }
?>

<form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
    <div class="card card-body rounded bg-white">
        <div class="card-header">
            <h3>Users Data Update</h3>
            <?= (!empty($message)? $message : ''); ?>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>Full Name: </b></label>
                        <input type="text" class="form-control" name="name" value="<?= (!empty($return['name'])) ? $return['name'] : '' ?>" placeholder="Enter Full Name" required>
                        <small> <?= (!empty($name) ? $name : ''); ?></small>
                    </div>
                    <br>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>User Role: </b></label>
                        <select class="form-control" name="role" required>
                            <option value="">Select a Option</option>
                            <option value="admin" <?= (!empty($return['role']) == "admin") ? 'selected' : '' ?>>Admin</option>
                            <option value="user" <?= (!empty($return['role']) == "user") ? 'selected' : '' ?>>User</option>
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
                        <input type="email" class="form-control" name="email" value="<?= (!empty($return['email'])) ? $return['email'] : '' ?>" placeholder="Enter Email" required>
                        <small> <?= (!empty($email) ? $email : ''); ?></small>
                    </div>
                    <br>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>password: </b></label>
                        <input type="text" class="form-control" name="password" value="<?= (!empty($return['password'])) ? $return['password'] : '' ?>" placeholder="Enter Password"
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
                        <input type="hidden" name="e_id" value="<?= (!empty($return['id'])) ? $return['id'] : '' ?>">
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
