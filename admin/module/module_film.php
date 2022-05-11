<?php
    session_start();
    require_once '../config.php';
    require_once '../incfiles/functions.php';
    $status     = 'error';
    $error      = array();
    if(isset($_SESSION['username']) && isset($_SESSION['flagLogin'])){
        if(isset($_POST['action']) && ($_POST['action'] == 'add')){
            $fname          = renameMovie(trim($_POST['fname']));
            $fdescription   = trim($_POST['fdescription']);
            $furlthumb      = trim($_POST['furlthumb']);
            $fcategory      = trim($_POST['fcategory']);
            $fstatus        = trim($_POST['fstatus']);
            $fcountry       = trim($_POST['fcountry']);
            $fyear          = trim($_POST['fyear']);
            $ftag           = trim($_POST['ftag']);
            $ftype          = $_POST['ftype'];
            $fepisode       = trim($_POST['fepisode']);
            $fepisodeName   = trim($_POST['fepisode-name']);
            $fplayer        = trim($_POST['fplayer']);
            $flink          = slug($fname);
            if($ftype == 'phimle' && $fplayer == ''){
                $error[]    = 'Nếu up phim lẻ, vui lòng nhập link player drive';
            }
            if($ftype == 'phimle' && $fepisodeName == ''){
                $error[]    = 'Nếu up phim lẻ, vui lòng nhập tên bộ phim (HD, HDVietsub,...)';
            }
            if(preg_match("#\D#",$fyear)){
                $error[]    = 'Năm sản xuất không đúng';
            }
            if(preg_match("#\D#",$fepisode)){
                $error[]    = 'Số tập phim không đúng';
            }
            if((!isset($_FILES['fthumb']) || ($_FILES['fthumb']['size'] == 0)) && $furlthumb == ''){
                $error[]    = 'Vui lòng tải lên hoặc nhập url thumbnail';
            }
            if(isset($_FILES['fthumb']) && ($_FILES['fthumb']['size'] > 0)){
                if($_FILES['fthumb']['error'] != 0){
                    $error[] = 'File bị lỗi';
                } else {
                    $fileName = $_FILES['fthumb']['name'];
                    if(!checkExtension($fileName)){
                        $error[] = 'Định dạng file không chính xác';
                    }
                    if(!checkFileSize($_FILES['fthumb']['size'],50000,5000000)){
                        $error[] = 'Kích thước file không cho phép';
                    }
                }
                if(count($error) == 0){
                    $file_extension = strtolower(pathinfo($_FILES['fthumb']['name'], PATHINFO_EXTENSION));
                    $file_path = randomStr().date("h-i-s").'.'.$file_extension;
                    move_uploaded_file($_FILES['fthumb']['tmp_name'], '../../img/film/'. $file_path);
                    try{
                        $sql = "INSERT INTO film VALUES(null,'$fname','$fdescription','$file_path','$fcategory','$fstatus','$fcountry',0,$fyear,'$flink','$ftag',$fepisode,'$ftype');";
                        $query = $conn->prepare($sql);
                        $query->execute();
                    }catch(PDOException $e){
                        $error[] = $e;
                    }
                }
            } else {
                if(count($error) == 0){
                    try{
                        $sql = "INSERT INTO film VALUES(null,'$fname','$fdescription','$furlthumb','$fcategory','$fstatus','$fcountry',0,$fyear,'$flink','$ftag',$fepisode,'$ftype');";
                        $query = $conn->prepare($sql);
                        $query->execute();
                    } catch(PDOException $e){
                        $error[] = $e;
                    }
                }
            }
            if($ftype == 'phimle'){
                if(preg_match("#(drive)#",$fplayer)){
                    $fplayerID = getDriveID($fplayer);
                } else {
                    $fplayerID = $fplayer;
                }
                $sql = "SELECT MAX(id) FROM film";
                $query = $conn->prepare($sql);
                $query->execute();
                $lastId = $query->fetch()['MAX(id)'];
                $sql = "INSERT INTO episode VALUES(null,'$fepisodeName','$fplayerID',$lastId)";
                $query = $conn->prepare($sql);
                $query->execute();
            }
            if(count($error) == 0) $status = 'success';
        }
        if(isset($_POST['action']) && ($_POST['action'] == 'delete')){
            $film = $_POST['film'];
            try {
                $sql    = "DELETE FROM film WHERE id = $film";
                $query  = $conn->prepare($sql);
                $query->execute();
            } catch(PDOException $e){
                $error[] = $e->getMessage();
            }
            if(count($error) == 0) $status = 'success';
        }
        if(isset($_POST['action']) && ($_POST['action'] == 'add-episode') && isset($_POST['film'])){
            $film = (int)$_POST['film'];
            $fepisodeName = trim($_POST['episode-name']);
            $fplayer = trim($_POST['fplayer']);
            if(preg_match("#(drive)#",$fplayer)){
                $fplayerID = getDriveID($fplayer);
            } else {
                $fplayerID = $fplayer;
            }
            try{
                $sql = "INSERT INTO episode VALUES(null,'$fepisodeName','$fplayerID',$film)";
                $query = $conn->prepare($sql);
                $query->execute();
            } catch(PDOException){
                $error[] = 'Không thể thêm tập phim';
            }
            if(count($error) == 0) $status = 'success';
        }
        if(isset($_POST['action']) && ($_POST['action'] == 'update-episode') && isset($_POST['episode'])){
            $episode = (int)$_POST['episode'];
            $fepisodeName = trim($_POST['episode-name']);
            $fplayer = trim($_POST['fplayer']);
            if(preg_match("#(drive)#",$fplayer)){
                $fplayerID = getDriveID($fplayer);
            } else {
                $fplayerID = $fplayer;
            }
            try{
                $sql = "UPDATE episode SET episode_name = '$fepisodeName', player = '$fplayerID' WHERE id = $episode";
                $query = $conn->prepare($sql);
                $query->execute();
            } catch(PDOException){
                $error[] = 'Không thể cập nhật tập phim';
            }
            if(count($error) == 0) $status = 'success';
        }
        if(isset($_POST['action']) && ($_POST['action'] == 'update') && isset($_POST['film'])){
            $film           = (int)$_POST['film'];
            $fname          = renameMovie(trim($_POST['fname']));
            $fdescription   = trim($_POST['fdescription']);
            $furlthumb      = trim($_POST['furlthumb']);
            $fcategory      = trim($_POST['fcategory']);
            $fstatus        = trim($_POST['fstatus']);
            $fcountry       = trim($_POST['fcountry']);
            $fyear          = trim($_POST['fyear']);
            $ftag           = trim($_POST['ftag']);
            $ftype          = $_POST['ftype'];
            $fepisode       = trim($_POST['fepisode']);
            $flink          = slug($fname);
            if(preg_match("#\D#",$fyear)){
                $error[]    = 'Năm sản xuất không đúng';
            }
            if(preg_match("#\D#",$fepisode)){
                $error[]    = 'Số tập phim không đúng';
            }
            if(isset($_FILES['fthumb']) && ($_FILES['fthumb']['size'] > 0)){
                if($_FILES['fthumb']['error'] != 0){
                    $error[] = 'File bị lỗi';
                } else {
                    $fileName = $_FILES['fthumb']['name'];
                    if(!checkExtension($fileName)){
                        $error[] = 'Định dạng file không chính xác';
                    }
                    if(!checkFileSize($_FILES['fthumb']['size'],50000,5000000)){
                        $error[] = 'Kích thước file không cho phép';
                    }
                }
                if(count($error) == 0){
                    $file_extension = strtolower(pathinfo($_FILES['fthumb']['name'], PATHINFO_EXTENSION));
                    $file_path = randomStr().date("h-i-s").'.'.$file_extension;
                    move_uploaded_file($_FILES['fthumb']['tmp_name'], '../../img/film/'. $file_path);
                    try{
                        $sql = "UPDATE film SET fname = '$fname',
                        fdescription = '$fdescription',
                        fthumb = '$file_path',
                        fcategory = '$fcategory',
                        fstatus = '$fstatus',
                        fcountry = '$fcountry',
                        fyear = $fyear,
                        flink = '$flink',
                        ftag = '$ftag',
                        fnum_episode = $fepisode,
                        ftype = '$ftype' WHERE id = $film;";
                        $query = $conn->prepare($sql);
                        $query->execute();
                    }catch(PDOException $e){
                        $error[] = $e;
                    }
                }
            } else {
                if($furlthumb != ''){
                    if(count($error) == 0){
                        try{
                            $sql = "UPDATE film SET fname = '$fname',
                            fdescription = '$fdescription',
                            fthumb = '$furlthumb',
                            fcategory = '$fcategory',
                            fstatus = '$fstatus',
                            fcountry = '$fcountry',
                            fyear = $fyear,
                            flink = '$flink',
                            ftag = '$ftag',
                            fnum_episode = $fepisode,
                            ftype = '$ftype' WHERE id = $film;";
                            $query = $conn->prepare($sql);
                            $query->execute();
                        } catch(PDOException $e){
                            $error[] = $e;
                        }
                    }
                } else {
                    if(count($error) == 0){
                        try{
                            $sql = "UPDATE film SET fname = '$fname',
                            fdescription = '$fdescription',
                            fcategory = '$fcategory',
                            fstatus = '$fstatus',
                            fcountry = '$fcountry',
                            fyear = $fyear,
                            flink = '$flink',
                            ftag = '$ftag',
                            fnum_episode = $fepisode,
                            ftype = '$ftype' WHERE id = $film;";
                            $query = $conn->prepare($sql);
                            $query->execute();
                        } catch(PDOException $e){
                            $error[] = $e;
                        }
                    }
                }
            }
            if(count($error) == 0) $status = 'success';
        }
        if(isset($_POST['action']) && ($_POST['action'] == 'delete-episode')){
            $film = $_POST['episode'];
            try {
                $sql    = "DELETE FROM episode WHERE id = $film";
                $query  = $conn->prepare($sql);
                $query->execute();
            } catch(PDOException $e){
                $error[] = $e->getMessage();
            }
            if(count($error) == 0) $status = 'success';
        }
    }
    $data       = array(
        'status'    => $status,
        'message'   => $error
    );
    echo json_encode($data);
?>