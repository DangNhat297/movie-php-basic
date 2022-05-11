<?php
    $wordError = "địt|dcm|lol|dm|lồn|cặc|cc|dkm|clmm|loz|vlxx|sex|cmm|'|\"";
    require_once '../admin/config.php';
    if($_POST['type'] == 'error' && isset($_POST['film'])){
        $status = 'error';
        $error = array();
        $ip = $_SERVER['REMOTE_ADDR'];
        $date = new DateTime();
        $dateTime = $date->format("Y-m-d H:i:s");
        $cmt = htmlspecialchars(strip_tags($_POST['error']));
        $name = htmlspecialchars(strip_tags($_POST['name']));
        $film = (int)$_POST['film'];
        $cmt = preg_replace("#($wordError)#","***",$cmt);
        $name = preg_replace("#($wordError)#","***",$name);
        try{
            $sql = "INSERT INTO report_error VALUES(null, '$name', '$cmt', '$dateTime', '$ip', $film)";
            $query = $conn->prepare($sql);
            $query->execute();
            $status = 'success';
        } catch(PDOException $e){
            $error[] = $e->getMessage();
        }
        $data = array(
            'status'    => $status,
            'message'   => $error
        );
        echo json_encode($data);
    }
?>