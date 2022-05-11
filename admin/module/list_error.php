<?php
    session_start();
    include '../config.php';
    $table = '';
    if(isset($_SESSION['username']) && isset($_SESSION['flagLogin'])){
        $sql = "SELECT report_error.id, rpfrom, error_detail, ip_address, timerp, film.fname FROM report_error,film WHERE report_error.film = film.id";
        $result = $conn->prepare($sql);
        $result->execute();
        if($result->rowCount() > 0){
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                $date = new DateTime($row['timerp']);
                $time = $date->format("d-m-Y \l\ú\c H:i:s");
                $table .= '<tr>
                <td>'.$row["rpfrom"].'</td>
                <td>'.$row["error_detail"].'</td>
                <td>'.$row["ip_address"].'</td>
                <td>'.$time.'</td>
                <td>'.$row["fname"].'</td>
                <td>
                <button type="button" id="remove-err" data-id-err="'.$row["id"].'" class="btn btn-xs btn-danger"><i class="fas fa-user-slash"></i> Xóa</button>
                </td>
                </tr>';
            }
        }
    } else {
        $table = 'error';
    }
    echo $table;
?>