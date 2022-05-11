<?php
    $url = $_GET['url'];
    $data = file_get_contents($url);
    $patten = '#id="video">(.*)<scr.*class="img_av_chitiet_phim".*src="(.*)".*class="title-1">(.*)<.*movie-title_tt">Trạng thái:(.*)<.*Quốc gia:(.*)<.*Năm sản xuất:(.*)<.*Thể loại:(.*)</div>.*the_content_seo">(.*)</div.*Từ khóa:(.*)</footer>#imsU';
    preg_match($patten, $data, $match);
    $sever = $match[1];
    unset($match[0]);
    unset($match[1]);
    $match[8] = preg_replace("#<block.*</blockquote>#","",$match[8]);
    // echo '<pre>';
    // print_r($match);
    // echo '</pre>';
    $pattenPlayer = '#button id="(.*)".*icon_phim">(.*)<#imsU';
    preg_match_all($pattenPlayer, $sever, $link);
    // echo '<pre>';
    // print_r($link);
    // echo '<pre>';
    $player = array();
    for($i = 0;$i < count($link[1]);$i++){
        $player[$link[2][$i]] = trim($link[1][$i]);
    }
    $arrData = array(
        'fthumb'        => trim(strip_tags($match[2])),
        'fname'         => trim(strip_tags($match[3])),
        'fstatus'       => trim(strip_tags($match[4])),
        'fcountry'      => trim(strip_tags($match[5])),
        'fcategory'     => trim(strip_tags($match[7])),
        'fdescription'  => trim(strip_tags($match[8])),
        'ftag'          => trim(strip_tags($match[9])),
        'fyear'         => trim(strip_tags($match[6])),
        'player'        => $player
    );
    unset($match);
    unset($link);
    echo '<pre>';
    print_r($arrData);
    echo '</pre>';
?>