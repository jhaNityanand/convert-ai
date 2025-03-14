
<?php

    require_once('layouts/config.php');
    require_once('layouts/function.php');
    require_once('../system/mail/email.php');

    $path = "../system/uploaded/images";
    $directories = glob($path . '/*' , GLOB_ONLYDIR);
    $files = scandir($path);

    /* foreach($directories as $key => $val) {
        array_map('unlink', glob($val."/*.*"));
        rmdir($val);
    }

    foreach($files as $key => $val) {

        $name = explode('-', $val);
        if(end($name) == "com.zip") {
            unlink($path . '/' . $val);
        }
    } */

    // echo "<pre>";
    // print_r($directories);
    // print_r($files);

    if($_REQUEST['api'] == 'delete_all')
    {
        $path_img = "../system/uploaded/images";
        $directories = glob($path_img . '/*' , GLOB_ONLYDIR);
        $files = scandir($path_img);

        foreach($directories as $key => $val) {
            array_map('unlink', glob($val."/*.*"));
            rmdir($val);
        }
        if(count($files) > 3) {

            foreach($files as $key => $val) {
                if($val != "index.php") {
                    unlink($path_img . '/' . $val);
                }
            }
        }


        $path_multi_img = "../system/uploaded/multiple_images";
        $directories = glob($path_multi_img . '/*' , GLOB_ONLYDIR);
        $files = scandir($path_multi_img);
    
        foreach($directories as $key => $val) {
            array_map('unlink', glob($val."/*.*"));
            rmdir($val);
        }


        $path_zip = "../system/uploaded/zip";
        $directories = glob($path_zip . '/*' , GLOB_ONLYDIR);
        $files = scandir($path_zip);
    
        if(count($files) > 3) {

            foreach($files as $key => $val) {
                if($val != "index.php") {
                    unlink($path_zip . '/' . $val);
                }
            }
        }


        $path_main = "../system/uploaded";
        $directories = glob($path_main . '/*' , GLOB_ONLYDIR);
        $files = scandir($path_main);

        if(count($files) > 7) {

            foreach($files as $key => $val) {
                if($val != "index.php") {
                    unlink($path_main . '/' . $val);
                }
            }
        }

        // echo "<pre>";
        // print_r($directories);
        // print_r($files);
        // echo count($files);
        // die;
    }

    if($_REQUEST['api'] == 'insert_email')
    {
        $email_array = [
            '2522@gmail.com',
            'smartzadvertiser@gmail.com',
            'matloob.nic@gmail.com',
            'hamza7554191@gmail.com',
            'aliemarketeer@gmail.com',
        ];

        $email = [];
        foreach ($email_array as $key => $value) {

            $conditions = [
                'email' => $value,
            ];
            $return = single_row('`email`', $conditions, $conn);

            if(empty($return['email'])) {

                $insert_data = [
                    '`email`' => $value,
                    '`status`' => 2,
                ];
                insert("`email`", $insert_data, $conn);

                $email[] = $value;
            }
        }

        echo 'Email Count: ' . count($email_array);
        echo "<pre>";
        print_r($email);
    }

    if($_REQUEST['api'] == 'send_mail')
    {
        $attachment = 'C:\wamp64\www\convert\system\mail\send.html';
        $subject = 'Invitation for visit our website.';

        $message = '';
        $message .= '<br>';
        $message .= '<h4><spam style="font-size: larger;">Dear</spam> Sir / Madam,</h4>';
        $message .= '<p style="font-size: 16px;"> On behalf of <b>Convert Application</b> I would like to extend an invitation to you to visit <b><i>Our Website</i></b> located at <a href="https://convertai.in/" target="_blank"><b><i>Click HERE</i></b></a>.</p>';
        $message .= '<h4><spam style="font-size: larger;float: right;">Thanking You. </spam></h4>';
        $message .= '<br>';
        $message .= '<center><a href="https://convertai.in/"><h3>Direct Visit</h3></a></center>';
        $message .= '<br>';

        $query = 'SELECT * FROM `email` WHERE status = 1 ORDER BY id ASC LIMIT 0, 1';
        $all_data = select_all_by_query($query, $conn);

        $to = [];
        if (count($all_data) > 0) {
            
            foreach ($all_data as $key => $value) {
                $to[] = $value['email'];

                $data = ['status' => 1];
                $conditions = ['id' => $value['id']];
                update_data('`email`', $data, $conditions, $conn);
            }
            $return_email_responce = send_mail_multiple($to, $subject, $message, $attachment);

            if($return_email_responce['status'] == true) {

                foreach ($to as $key => $value) {

                    $data = ['status' => 0];
                    $conditions = ['email' => $value];
                    update_data('`email`', $data, $conditions, $conn);
                }
            }
        } 
        else {
            $return_email_responce = '';
        }
        echo json_encode(['status' => true, 'count' => count($all_data), 'email' => $to]);
        die;
        // echo 'Email Count: ' . count($all_data);
        // echo "<pre>";
        // print_r($return_email_responce);
    }

    return true;
    exit;

?>
