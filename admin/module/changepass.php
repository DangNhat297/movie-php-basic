<?php
    session_start();
    include '../config.php';
    $status = 'error';
    $error  = array();
    if(isset($_SESSION['username']) && isset($_SESSION['flagLogin'])){
        $oldPass    = md5(trim($_POST['oldpass']));
        $newPass    = $_POST['newpass'];
        $rePass     = $_POST['repass'];
        $username   = $_POST['username'];
        $sql        = "SELECT * FROM users WHERE adminUser = '$username'";
        $result     = $conn->prepare($sql);
        $result->execute();
        $user       = $result->fetch(PDO::FETCH_ASSOC);
        if($oldPass != $user['adminPass']){
            $error[] = 'Mật khẩu cũ không chính xác';
        } else if($newPass != $rePass){
            $error[] = 'Mật khẩu mới không đúng';
        } else if(!preg_match("#(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z]{6,20}#", $newPass)){
            $error['password'] = 'Mật khẩu phải có độ dài từ 6 đến 20 kí tự';
            $error['password'] = 'Mật khẩu chứa ít nhất 1 kí tự số, 1 chữ hoa, 1 chữ thường';
        } else {
            $newPass = md5($newPass);
            $sql = "UPDATE users SET adminPass = '$newPass' WHERE adminUser = '$username'";
            $query = $conn->prepare($sql);
            $query->execute();
            $status = 'success';
        }
    }
    $data = array(
        'status'    => $status,
        'message'   => $error
    );
    echo json_encode($data);
?>