
<?php
    require_once('../layouts/config.php');
    require_once('../layouts/function.php');

    if(!empty($_SESSION['user_login_detail']) && !empty($_SESSION['user_login_detail']['id']))
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
        if(empty($_REQUEST['con_password'])) {
            $con_password = "Confirm Password Field is Required.";
        }
        $data = [
            '`email`' => $_REQUEST['email'],
            '`password`' => sha1(md5($_REQUEST['password'])),
            '`con_password`' => sha1(md5($_REQUEST['con_password'])),
        ];

        if (in_array(null, $data, true) || in_array('', $data, true)) {
            // There are null (or empty) values.
        } else {
            if($_REQUEST['password'] != $_REQUEST['con_password']) {

                $message = "<div class='alert alert-danger'>Password and Confirm Password not Matched.</div>";
            } else {
                $conditions = [
                    'email' => $data['`email`'],
                ];
                $return = single_row('`users`', $conditions, $conn);
                if(empty($return['email']) && empty($return['password'])) {
    
                    $message = "<div class='alert alert-danger'>Email not Found in System.</div>";
                } 
                else if($return['status'] == '0') {
                    $message = "<div class='alert alert-danger'>Your Account is Suspended. (Please Contact Admin)</div>";
                }
                else {
                    $data = [
                        'email' => $_REQUEST['email'],
                        'password' => sha1(md5($_REQUEST['password'])),
                    ];
                    $conditions = [
                        'email' => $data['email'],
                    ];
                    $return = update_data('`users`', $data, $conditions, $conn);

                    if(!empty($return)) {
                        $message = "<div class='alert alert-success'>Password Updated Successfully.</div>";
                        header("Location: ".base_url."admin/users/login.php");
                    } else {
                        $message = "<div class='alert alert-danger'>Something Went Wrong.<br>".$return['error']."</div>";
                    }
                    exit;
                }
            }
        }
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password | Convert Application</title>
    <link rel="icon" type="image/png" href="../images/logo.png" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- Icon cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <style>
    * {
        font-family: times new roman;
    }

    small {
        color: red;
        font-size: 17px;
    }

    label {
        font-size: 16px;
    }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                    <div class="shadow card border-secondary border-3 p-4 rounded bg-white">
                        <div class="card-header">
                            <h1 class="text-center">Forget Password</h1>
                            <h4 class="text-center">Update Your Password</h4>
                            <small><?= (!empty($message) ? $message : ''); ?></small>
                        </div>

                        <div class="card-body">

                            <div class="mb-3">
                                <label for="" class="form-label">Email: </label>
                                <input class="form-control" type="email" name="email" placeholder="Enter Email ID."
                                    required>
                                <small> <?= (!empty($email) ? $email : ''); ?> </small>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Password: </label>
                                <input class="form-control" type="password" name="password"
                                    placeholder="Enter Password." required>
                                <small> <?= (!empty($password) ? $password : ''); ?> </small>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Confirm Password: </label>
                                <input class="form-control" type="password" name="con_password"
                                    placeholder="Enter Confirm Password." required>
                                <small> <?= (!empty($con_password) ? $con_password : ''); ?> </small>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div style="float: right;">
                                <button type="submit" class="btn btn-ft border-2 rounded-5 btn-outline-primary"
                                    name="submit"><b> Submit </b></button>
                            </div>
                            <br><br>
                            <div class="row text-center">
                                <div class="col-sm-12">
                                    <a href="<?= base_url."admin/users/login.php"; ?>">
                                        <h5>Login</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
