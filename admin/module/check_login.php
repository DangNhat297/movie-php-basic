<?php
    include '../config.php';
    include '../incfiles/functions.php';
    session_start();
    $status = 'error';
    $error = array();
    if(isset($_SESSION['username']) && isset($_SESSION['flagLogin'])){
        header("Location: ../index.php");
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if($username == ''){
            $error['username'] = 'Vui lòng điền tên đăng nhập';
        } else if(strlen($username) < 6 || strlen($username) > 50){
            $error['username'] = 'Tên đăng nhập phải lớn hơn 5 ký tự và ít hơn 50 kí tự';
        } else {
            $sql = "SELECT * FROM users WHERE adminUser = '$username'";
            $result = $conn->prepare($sql);
            $result->execute();
            if($result->rowCount() == 0){
                $error['username'] = 'Tên đăng nhập không tồn tại';
            }
        }
        if($password == ''){
            $error['password'] = 'Vui lòng điền mật khẩu';
        }

        if(count($error) == 0){
            $password = md5($_POST['password']);
            $query          = "SELECT * FROM users WHERE adminUser = '$username' AND adminPass = '$password'";
            $sql            = $conn->prepare($query);
            $sql->execute();
            if($sql->rowCount() == 1){
                $userStatus = $sql->fetch()['status'];
                if($userStatus == 0){
                    $error['username'] = 'Tài khoản chưa kích hoạt';
                } else {
                    $status                 = 'success';
                    $_SESSION['username']   = $username;
                    $_SESSION['flagLogin']  = true;
                    if($_POST['remember'] == 'remember'){
                        setcookie('username', $username, time() + 86400, "/");
                        setcookie('password', $_POST['password'], time() + 86400, "/");
                        setcookie('remember', true, time() + 86400, "/");
                    } else {
                        setcookie('username', "", time()-360, "/");
                        setcookie('password', "", time()-360, "/");
                        setcookie('remember', "", time()-360, "/");
                    }
                }
            } else {
                $error['password'] = 'Mật khẩu không chính xác';
            }
        }
    }
    $data = array(
        'status'    => $status,
        'message'   => $error
    );
    echo json_encode($data);
?>