<?php
    $wordError = "địt|dcm|lol|dm|lồn|cặc|cc|dkm|clmm|loz|vlxx|sex|cmm|'|\"";
    require_once '../admin/config.php';
    if($_POST['type'] == 'get' && isset($_POST['film'])){
        $film = (int)$_POST['film'];
        $data = array();
        $sql = "SELECT name_cmt, detail_cmt, time_cmt FROM comment WHERE film = $film ORDER BY id DESC";
        $query = $conn->prepare($sql);
        $query->execute();
        if($query->rowCount() > 0){
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $date = new DateTime($row['time_cmt']);
                $datetime = $date->format("d-m-Y \l\ú\c H:i:s");
                $data[] = array(
                    "name"      => $row['name_cmt'],
                    "detail"    => $row['detail_cmt'],
                    "time"      => $datetime
                );
            }
        }
        echo json_encode($data);
    }
    if($_POST['type'] == 'cmt' && isset($_POST['film'])){
        $status = 'error';
        $error = array();
        $ip = $_SERVER['REMOTE_ADDR'];
        $date = new DateTime();
        $dateTime = $date->format("Y-m-d H:i:s");
        $cmt = htmlspecialchars(strip_tags($_POST['comment']));
        $name = htmlspecialchars(strip_tags($_POST['name']));
        $film = (int)$_POST['film'];
        $cmt = preg_replace("#($wordError)#","***",$cmt);
        $name = preg_replace("#($wordError)#","***",$name);
        try{
            $sql = "INSERT INTO comment VALUES(null, '$name', '$cmt', '$ip', '$dateTime', $film)";
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