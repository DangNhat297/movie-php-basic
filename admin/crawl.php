<?php
    session_start();
    include 'incfiles/head.php';
?>
<?php
    require_once 'config.php';
    require_once 'incfiles/functions.php';
    $status = '';
    $error = '';
    if(isset($_POST['submit'])){
        $url = $_POST['url'];
        $data = file_get_contents($url);
        $patten = '#id="video">(.*)<scr.*class="img_av_chitiet_phim".*src="(.*)".*class="title-1">(.*)<.*movie-title_tt">Trạng thái:(.*)<.*Quốc gia:(.*)<.*Năm sản xuất:(.*)<.*Thể loại:(.*)</div>.*the_content_seo">(.*)</div.*Từ khóa:(.*)</footer>#imsU';
        preg_match($patten, $data, $match);
        if(count($match) > 0){
            $sever = $match[1];
            unset($match[0]);
            unset($match[1]);
            $match[8] = preg_replace("#<block.*</blockquote>#","",$match[8]);
            $pattenPlayer = '#button id="(.*)".*icon_phim">(.*)<#imsU';
            preg_match_all($pattenPlayer, $sever, $link);
            $player = array();
            for($i = 0;$i < count($link[1]);$i++){
                $player[$link[2][$i]] = trim($link[1][$i]);
            }
            $film = array(
                'fthumb'        => trim(strip_tags($match[2])),
                'fname'         => trim(strip_tags($match[3])),
                'fstatus'       => trim(strip_tags($match[4])),
                'fcountry'      => trim(strip_tags($match[5])),
                'fyear'         => trim(strip_tags($match[6])),
                'fcategory'     => trim(strip_tags($match[7])),
                'fdescription'  => trim(strip_tags($match[8])),
                'ftag'          => trim(strip_tags($match[9])),
                'player'        => $player
            );
            unset($match);
            unset($link);
            $fname          = $film['fname'];
            $fdescription   = $film['fdescription'];
            $fthumb         = $film['fthumb'];
            $fcategory      = $film['fcategory'];
            $fstatus        = $film['fstatus'];
            $fcountry       = $film['fcountry'];
            $fyear          = $film['fyear'];
            $flink          = slug($film['fname']);
            $ftag           = $film['ftag'];
            try{
                $sql = "INSERT INTO film VALUES(null,'$fname','$fdescription','$fthumb','$fcategory','$fstatus','$fcountry',0,$fyear,'$flink','$ftag',1,'phimle');";
                $query = $conn->prepare($sql);
                $query->execute();
            }catch(PDOException){
                $error = 'Không thể thêm phimm';
            }
            foreach($film['player'] as $key => $value){
                if(preg_match("#(drive)#",$value)){
                    $fplayerID = getDriveID($value);
                } else {
                    $fplayerID = $value;
                }
                try{
                    $sql = "SELECT MAX(id) FROM film";
                    $query = $conn->prepare($sql);
                    $query->execute();
                    $lastId = $query->fetch()['MAX(id)'];
                    $sql = "INSERT INTO episode VALUES(null,'$key','$fplayerID',$lastId)";
                    $query = $conn->prepare($sql);
                    $query->execute();
                }catch(PDOException){
                    $error = 'Không thể thêm tập';
                }
            }
        } else {
            $error = 'Không thể crawl phim';
        }
        if($error == ''){
            $status = 'Thành công phim '. $fname ;
        } else {
            $status = 'Thất bại';
        }; 
    }
?>
        <div class="wrapper wrapper-content">
        <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Crawl Phim Lẻ Phimhaytvv</h5>
                        </div>
                        <div class="ibox-content">
                            <form action="" method="POST">
                                <div class="form-group row"><label for="url-crawl" class="col-lg-2 col-form-label">Nhập url</label>
                                <div class="col-lg-10"><input type="text" id="url-crawl" name="url" placeholder="Url phimhaytvv https://phimhaytvv.com/phim-oan-hon-trong-phong" class="form-control">
                                </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-sm btn-primary" name="submit" type="submit">Bắt đầu</button>
                                    </div>
                                </div>
                                <p><?=$status?></p>
                                <p><?=$error?></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    include 'incfiles/foot.php';
?>
</body>
</html>
