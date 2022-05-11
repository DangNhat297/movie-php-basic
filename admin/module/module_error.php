<?php
    session_start();
    include '../config.php';
    $status = 'error';
    $error  = '';
    if(isset($_SESSION['username']) && isset($_SESSION['flagLogin'])){
        if(!empty($_POST['id']) && ($_POST['action'] == 'remove')){
            $id     = (int)$_POST['id'];
            $sql    = "DELETE FROM report_error WHERE id = '$id'";
            try{
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->exec($sql);
                $status = 'success';
            } catch(PDOException $e){
                $status = 'error';
                $error = $e->getMessage();
            }
        }
    }
    $data = array(
        'status'    => $status,
        'message'   => $error
    );
    echo json_encode($data);
?>