<?php
    session_start();
    require '../config.php';
    require '../lib/PHPMailer/class.phpmailer.php';
    require '../lib/PHPMailer/class.smtp.php';
    require_once '../incfiles/functions.php';
    $status     = 'error';
    $error      = array();
    $verifyCode = randomStr();
    $date   = new DateTime();
    $datetime   = $date->format("Y-m-d H:i:s");
    function checkLengthName($name){
        $flag = false;
        if(strlen($name) > 5 && strlen($name) < 50) $flag = true;
        return $flag;
    }
    $email    = $_POST['email'];
    $username = preg_replace("#[^A-Za-z0-9]#", "", $_POST['username']);
    if($_POST['password'] != $_POST['repassword']){
        $error['password'] = 'Mật khẩu không chính xác !';
    }
    if($_POST['password'] == ''){
        $error['password'] = 'Vui lòng nhập mật khẩu';
    } else if(!preg_match("#(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z]{6,20}#", $_POST['password'])){
        $error['password'] = 'Mật khẩu phải có độ dài từ 6 đến 20 kí tự';
        $error['password'] = 'Mật khẩu chứa ít nhất 1 kí tự số, 1 chữ hoa, 1 chữ thường';
    }
    if($username == ''){
        $error['username'] = 'Vui lòng nhập tên đăng nhập';
    } else if(!filter_var($username, FILTER_CALLBACK, array("options"=>"checkLengthName"))){
        $error['username'] = 'Tên đăng nhập phải lớn hơn 5 ký tự và ít hơn 50 kí tự';
    }
    if($_POST['terms'] != 'agree'){
        $error[] = 'Vui lòng chấp nhận điều khoản';
    }
    if(count($error) == 0) $status = 'success';
    if($status == 'success'){
        $username = preg_replace("#[^A-Za-z0-9]#", "", $_POST['username']);
        $sql    = "SELECT * FROM users WHERE adminUser = '$username'";
        $result = $conn->prepare($sql);
        $result->execute();
        if($result->rowCount() > 0){
            $error[] = 'Tên đăng nhập đã tồn tại';
            $status = 'error';
        } else {
            $username = preg_replace("#[^A-Za-z0-9]#", "", $_POST['username']);
            $password   = md5($_POST['password']);
            $sql = "INSERT INTO users(adminUser, adminPass, verify_code, reg_date) VALUES ('$username', '$password', '$verifyCode' , '$datetime')";
            try{
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $smtp = $conn->prepare($sql);
                $smtp->execute();
                $status = 'success';
                // start mailer 
                $mail = new PHPMailer();
                $mail->CharSet = "UTF-8";
                $message = file_get_contents('../email_templates/action.html');
                $message = str_replace('%username%',$username,$message);
                $message = str_replace('%verifycode%',md5($verifyCode),$message);
                $mail->IsSMTP(); // set mailer to use SMTP
                $mail->Host = "smtp.gmail.com"; // specify main and backup server
                $mail->Port = 465; // set the port to use
                $mail->SMTPAuth = true; // turn on SMTP authentication
                $mail->SMTPSecure = 'ssl';
                $mail->Username = ""; // your SMTP username or your gmail username
                $mail->Password = ""; // your SMTP password or your gmail password
                $from = "admin@sitephim.com"; // Reply to this email
                $to     = $email; // Recipients email ID
                $name= $username; // Recipient's name
                $mail->From = $from;
                $mail->FromName = "PhimHay"; // Name to indicate where the email came from when the recepient received
                $mail->AddAddress($to,$name);
                $mail->WordWrap = 50; // set word wrap
                $mail->IsHTML(true); // send as HTML
                $mail->Subject = "Xác nhận email đăng ký";
                $mail->MsgHTML($message);
                //$mail->SMTPDebug = 2;
                if(!$mail->Send())
                {
                    $error[] = 'Lỗi gửi mail đăng ký';
                }

                // end mailer
            } catch(PDOException $e){
                $error['sql'] = $e->getMessage();
                $status = 'error';
            }
        }
    }
    $data = array(
        'status'    => $status,
        'message'   => $error
    );
    echo json_encode($data);
?>