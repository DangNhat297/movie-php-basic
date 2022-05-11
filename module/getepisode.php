<?php
    require_once '../admin/config.php';
    if($_POST['type'] == 'pick-episode' && isset($_POST['episode'])){
        $episode = (int)$_POST['episode'];
        $film = (int)$_POST['film'];
        $sql = "UPDATE film SET fview = fview + 1 WHERE id = $film";
        $query = $conn->prepare($sql);
        $query->execute();
        $sql = "SELECT * FROM episode WHERE id = $episode";
        $query = $conn->prepare($sql);
        $query->execute();
        $player = $query->fetch()['player'];
        $data = array('player' => $player);
        echo json_encode($data);
    }
?>