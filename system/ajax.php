<?php 

    require_once('../admin/layouts/config.php');
    require_once('../admin/layouts/function.php');
    require_once('mail/email.php');

    if(!empty($_REQUEST['id']) && $_REQUEST['check'] == 'delete_image')
    {
        $conditions = ['id' => $_REQUEST['id']];
        $return = delete_data('`multiple_images`', $conditions, $conn);

        if(!empty($return)) {
            $data = ['status' => true, 'message' => 'success...'];
            return $data;
            exit;
        }
    }

    /* echo "<pre>";
    print_r($_REQUEST);
    die; */

    if(!empty($_REQUEST['email']) && $_REQUEST['check'] == 'email')
    {
        $conditions = [
            'email' => $_REQUEST['email'],
        ];
        $return = single_row('`email`', $conditions, $conn);

        if(empty($return['email'])) {

            $insert_data = [
                '`email`' => $_REQUEST['email'],
                '`status`' => 1,
            ];
            $return_data = insert("`email`", $insert_data, $conn);

            $email[] = $value;
        }

        if(!empty($return_data['last_id']) || !empty($return['email'])) {

            $to      = $_REQUEST['email'];
            $subject = 'Thanking You for Visit and Send Email.';
            $message = '';
            $message .= '<p>I want to take a moment to express my gratitude for your visit. It meant a lot to me to have you here, and I truly appreciate your support.</p>';
            $message .= '<br><br>';
            $message .= '<center>';
            $message .= '<a href="https://convert.examtube.in/" target="_blank"><h1>Visit Again</h1></a>';
            $message .= '</center>';
            
            $return = send_mail($to, $subject, $message);

            if($return['status'] == false) {
                echo json_encode($return);
                exit;
            } 
            else {
                $array = ['status' => true, 'message' => 'Thanking You.'];
                echo json_encode($array);
                exit;
            }
        }
    }

    if(!empty($_REQUEST['email']) && $_REQUEST['check'] == 'comment')
    {
        $data = [
            'blog_id' => $_REQUEST['blog_id'],
            'name' => $_REQUEST['name'],
            'email' => $_REQUEST['email'],
            'comment' => $_REQUEST['comment'],
            'ip_address' => getenv("REMOTE_ADDR"),
        ];
        $return_data = insert("`blog_comment`", $data, $conn);

        if(!empty($return_data['last_id'])) {

            $to      = $_REQUEST['email'];
            $subject = 'Thanking You for Sending Comment.';
            $message = '';
            $message .= '<p>I want to take a moment to express my gratitude for your visit. It meant a lot to me to have you here, and I truly appreciate your support.</p><br>';
            $message .= '<h3>Your Comment is Pending for Approvel.</h3>';
            $message .= '<a href="'.base_url.'" target="_blank"><b>Visit Again</b></a>';
            
            $return = send_mail($to, $subject, $message);

            if($return['status'] == false) {
                return json_encode($return);
                exit;
            } 
            else {
                $array = ['status' => true, 'message' => 'Thanking You.'];
                return json_encode($array);
                exit;
            }
        }
    }

?>
