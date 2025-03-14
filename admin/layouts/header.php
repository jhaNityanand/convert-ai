<?php 
    include_once('config.php');

    if(empty($_SESSION['user_login_detail']) && empty($_SESSION['user_login_detail']['id']))
    {
        header("Location: ".base_url."admin/users/login.php");
    }

    if(isset($_REQUEST['logout_submit']))
    {
        session_destroy();
        header("Location: ".base_url."admin/users/login.php");
    }

    // echo $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
    // echo "<br>";
    // echo $url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    // echo "<br>";
    // echo $url =  parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= (!empty($title)) ? $title : 'Convert Application'; ?></title>
    <link rel="icon" type="image/png" href="../images/logo.png"/>

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
    <!-- datatable -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <!-- CKeditor -->
    <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
    
    <style>
    * {
        font-family: 'Times New Roman', Times, serif;
    }

    table {
        font-size: 14px;
        border-right: 1px solid black;
        border-left: 1px solid black;
    }

    .nav-link {
        font-size: 20px;
    }

    .container {
        /* border: 4px double black; */
    }

    .footer {
        text-align: center;
        min-height: 75px;
        font-size: 18px;
        background-color: rgba(var(--bs-light-rgb), var(--bs-bg-opacity)) !important;
    }

    small {
        color: red;
        font-size: 14px;
    }
    label {
        font-size: 16px;
    }
    </style>
</head>

<body>
    <div class="container-fulid">
        <div class="row">
            <nav style="width: 100%;" class="">
                <ul style="width: 100%;"
                    class="nav justify-content navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand nav-link" style=" color: green;" href="<?= base_url.'admin' ?>">
                        <i class="fa-solid fa-house-chimney"></i>
                    </a>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url.'admin/blog' ?>">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url.'admin/convert' ?>">Convert</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url.'admin/compress' ?>">Compress</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url.'admin/setting' ?>">Setting</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url.'admin/users' ?>">Users</a>
                    </li>
                </ul>
                <ul style="width: 100%; float: right; margin-right: 25px;"
                    class="nav justify-content-end navbar navbar-expand-lg navbar-light bg-light">
                    <li class="nav-item">
                        <a class="nav-link" href="#" style=" color: blue;">
                            <!-- <i class="fas fa-users"></i> -->
                            <?= (!empty($_SESSION['user_login_detail']['name']) ? $_SESSION['user_login_detail']['name'] : '<i class="fas fa-users"></i>'); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                            <button class="btn btn-ft border-2 rounded-5 btn-outline-danger nav-link" type="submit" name="logout_submit"><i
                                class="fa-sharp fa-solid fa-right-from-bracket"></i></button>
                        </form>
                    </li>
                </ul>
                <br>
            </nav>
        </div>