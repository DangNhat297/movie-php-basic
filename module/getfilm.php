<?php
    require_once '../admin/config.php';
    require_once '../incfiles/functions.php';
    $limit      = 15;
    $position   = $_POST['position'];
    $sql = "SELECT film.id, film.fname, film.fthumb, film.flink, film.fstatus FROM film RIGHT JOIN episode ON film.id = episode.movie GROUP BY film.fname ORDER BY film.id DESC LIMIT $position,$limit";
    $query = $conn->prepare($sql);
    $query->execute();
    $listFilms = $query->fetchAll();
    $xhtml = '';
    foreach($listFilms as $film){
        $xhtml .= '<a href="phim/'.$film['flink'].'.'.$film['id'].'.html">
            <div class="film__list--item">
                <div class="film__item--image">
                <div class="film__item--status">'.$film['fstatus'].'</div>
                    <img src="'.getThumb($film['fthumb']).'">
                </div>
                <div class="film__item--name">'.$film['fname'].'
                </div>
            </div>
        </a>';
    }
    echo $xhtml;
?>