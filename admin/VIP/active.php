<?php
    require_once '../config.php';
    if(isset($_GET['username']) && isset($_GET['verifycode'])){
        $username = $_GET['username'];
        $verifyCode = $_GET['verifycode'];
        $sql = "SELECT * FROM users WHERE adminUser = '$username' and status = 0";
        $query = $conn->prepare($sql);
        $query->execute();
        if($query->rowCount() > 0){
            $result = $query->fetch();
            if($verifyCode == md5($result['verify_code'])){
                $sql = "UPDATE users SET status = 1 WHERE adminUser = '$username'";
                $query = $conn->prepare($sql);
                $query->execute();
                header('Location: activesuccess.php');
            } else {
                header('Location: ../404.html');
            }
        } else {
            header('Location: ../404.html');
        }
    } else {
        header('Location: ../404.html');
    }
?>