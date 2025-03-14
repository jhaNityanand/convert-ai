<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function send_mail($email, $subject, $message)
{
    require 'PHPMailer/Exception.php';
    require 'PHPMailer/SMTP.php';
    require 'PHPMailer/PHPMailer.php';

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'convertai.in@gmail.com';               //SMTP username
        $mail->Password   = 'kdqjoodcsdgdcnvs';                     //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('convertai.in@gmail.com', 'Convert Application');
        $mail->addReplyTo('convertai.in@gmail.com', 'Convert Application');
        //Add a recipient
        $mail->addAddress($email); 

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        $output = ['status' => true, 'message' => 'Email Success.'];
    }
    catch (Exception $e) {
        echo $mail->ErrorInfo;
        die;
        $result = $e->getMessage();
        $output = ['status' => false, 'message' => "Email Failed.", 'error' => $mail->ErrorInfo];
    }
    catch (phpmailerException $e) {
        $result = $e->errorMessage();
    }

    return $output;
}

function send_mail_multiple($email, $subject, $message, $attachment = null)
{
    require 'PHPMailer/Exception.php';
    require 'PHPMailer/SMTP.php';
    require 'PHPMailer/PHPMailer.php';

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'in.convertai@gmail.com';               //SMTP username
        $mail->Password   = 'zlxhjylejqyzohtg'; /* kdqjoodcsdgdcnvs zlxhjylejqyzohtg */                     //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable implicit TLS encryption
        $mail->Port       = '587';                                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('in.convertai@gmail.com', 'Convert Application');
        $mail->addReplyTo('in.convertai@gmail.com', 'Convert Application');
        //Add a recipient
        if(is_array($email)) {
            foreach ($email as $key => $value) {
                $mail->addAddress($value);
                // $mail->addBCC($value);
            }
        }

        //Content
        $mail->isHTML(true);                                //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $message;

        if($attachment != null) {
            // $attachment = 'C:\wamp64\www\convert\system\mail\send.html';
            $mail->AddAttachment($attachment, 'convertai.html');
        }
        
        $mail->send();
        $output = ['status' => true, 'message' => 'Email Success.'];
    }
    catch (Exception $e) {
        echo $mail->ErrorInfo;
        die;
        $output = ['status' => false, 'message' => "Email Failed.", 'error' => $mail->ErrorInfo];
    }
    catch (phpmailerException $e) {
        $result = $e->errorMessage();
    }

    return $output;
}

$emailss = [
    'nityanandjha2020@gmail.com', 
    'nityanandjha13578@gmail.com', 
    'in.jha357@gmail.com',
];
$subjectss = 'Testig';
$messagess = 'Multiple.';

// $return = send_mail_multiple($emailss, $subjectss, $messagess);
// echo "<pre>";
// print_r($return);
// die;

$emailss = 'nityanandjha2020@gmail.com'; 
$subjectss = 'Testig';
$messagess = 'Single.';

// $return = send_mail($emailss, $subjectss, $messagess);
// echo "<pre>";
// print_r($return);
// die;

/* convertai.in@gmail.com
kdqjoodcsdgdcnvs */

/* in.convertai@gmail.com
zlxhjylejqyzohtg */

/* nityanandjha2020@gmail.com
qjyxlhmztovgmplg */

/* nityanandjha13578@gmail.com
uhdhxabzstxjfmze */

// 9510005675*@#
// 9016201780

?>
