<?php
    session_start();
    include '../config.php';
    $table = '';
    if(isset($_SESSION['username']) && isset($_SESSION['flagLogin'])){
        $sql = "SELECT comment.id, comment.name_cmt, comment.detail_cmt, comment.ip_address, comment.time_cmt, film.fname FROM comment, film WHERE comment.film = film.id;";
        $result = $conn->prepare($sql);
        $result->execute();
        if($result->rowCount() > 0){
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                $date = new DateTime($row['time_cmt']);
                $time = $date->format("d-m-Y \l\ú\c H:i:s");
                $table .= '<tr>
                <td>'.$row["name_cmt"].'</td>
                <td>'.$row["detail_cmt"].'</td>
                <td>'.$row["ip_address"].'</td>
                <td>'.$time.'</td>
                <td>'.$row["fname"].'</td>
                <td>
                <button type="button" id="removecmt" data-id-cmt="'.$row["id"].'" class="btn btn-xs btn-danger"><i class="fas fa-user-slash"></i> Xóa</button>
                </td>
                </tr>';
            }
        }
    } else {
        $table = 'error';
    }
    echo $table;
?>