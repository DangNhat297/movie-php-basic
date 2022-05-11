<?php
    
    require '../lib/PHPMailer/class.phpmailer.php';
    require '../lib/PHPMailer/class.smtp.php';
    
    $mail = new PHPMailer();
    $message = file_get_contents('action.html');
    $message = str_replace('%username%','ndnhat1',$message);
    $mail->IsSMTP(); // set mailer to use SMTP
    $mail->Host = "smtp.gmail.com"; // specify main and backup server
    $mail->Port = 465; // set the port to use
    $mail->SMTPAuth = true; // turn on SMTP authentication
    $mail->SMTPSecure = 'ssl';
    $mail->Username = "vinhmatic5x@gmail.com"; // your SMTP username or your gmail username
    $mail->Password = "Vip0162808"; // your SMTP password or your gmail password
    $from = "admin@sitephim.com"; // Reply to this email
    $to     ="ndnhat1@gmail.com"; // Recipients email ID
    $name="Test"; // Recipient's name
    $mail->From = $from;
    $mail->FromName = "PhimHayXXX"; // Name to indicate where the email came from when the recepient received
    $mail->AddAddress($to,$name);
    $mail->WordWrap = 50; // set word wrap
    $mail->IsHTML(true); // send as HTML
    $mail->Subject = "test mailer";
    $mail->MsgHTML($message);
    //$mail->SMTPDebug = 2;
    if(!$mail->Send())
    {
        echo "<h1>Loi khi goi mail: " . $mail->ErrorInfo . '</h1>';
    }
    else
    {
        echo "<h1>Send mail thanh cong</h1>";
    }
?>