<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/main.css">
</head>
<body id="scroll">
    <!--start header-->
    <header>
        <div class="container-width header">
            <img src="img/logo.svg">
            <form class="nav-search">
                <input type="text" placeholder="Nhập từ khóa tìm kiếm..." name="search">
                <button><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="container-width navmenu">
            <input id="checkNav" type="checkbox"/>
            <label for="checkNav"><i class="fas fa-align-justify"></i></label>
            <nav>
                <ul class="navmenu">
                    <li><a href="index.html">Trang Chủ</a></li>
                    <li><a href="#">Phim Lẻ</a></li>
                    <li><a href="#">Phim Bộ</a></li>
                    <li><label for="megamenu1">Thể loại <i class="fas fa-angle-down"></i></label>
                        <input type="checkbox" id="megamenu1" hidden>
                        <ul class="megamenu">
                            <li><a href="#">Giới Thiệu</a></li>
                            <li><a href="#">Liên Hệ</a></li>
                            <li><a href="#">Điều Khoản</a></li>
                            <li><a href="#">Chính Sách</a></li>
                            <li><a href="#">Giới Thiệu</a></li>
                            <li><a href="#">Liên Hệ</a></li>
                            <li><a href="#">Điều Khoản</a></li>
                            <li><a href="#">Chính Sách</a></li>
                            <li><a href="#">Giới Thiệu</a></li>
                            <li><a href="#">Liên Hệ</a></li>
                            <li><a href="#">Điều Khoản</a></li>
                            <li><a href="#">Chính Sách</a></li>
                        </ul>
                    </li>
                    <li><label for="megamenu">Năm <i class="fas fa-angle-down"></i></label>
                        <input type="checkbox" id="megamenu" hidden>
                        <ul class="megamenu">
                            <li><a href="#">Giới Thiệu</a></li>
                            <li><a href="#">Liên Hệ</a></li>
                            <li><a href="#">Điều Khoản</a></li>
                            <li><a href="#">Chính Sách</a></li>
                            <li><a href="#">Giới Thiệu</a></li>
                            <li><a href="#">Liên Hệ</a></li>
                            <li><a href="#">Điều Khoản</a></li>
                            <li><a href="#">Chính Sách</a></li>
                            <li><a href="#">Giới Thiệu</a></li>
                            <li><a href="#">Liên Hệ</a></li>
                            <li><a href="#">Điều Khoản</a></li>
                            <li><a href="#">Chính Sách</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <!--end header-->
    <!--start main-->
    <?php
        include 'admin/config.php';
        include 'incfiles/functions.php';
        $sql = "SELECT film.id, film.fname, film.fthumb, film.flink, film.fstatus FROM film RIGHT JOIN episode ON film.id = episode.movie GROUP BY film.fname ORDER BY film.id DESC limit 5";
        $query = $conn->prepare($sql);
        $query->execute();
        $newFilms = $query->fetchAll();
    ?>
    <main>
        <div class="newfilm">
            <div class="film container-width">
                <div class="film__header">
                    <div><strong>Phim mới</strong> cập nhật</div>
                </div>
                <div class="film__list">
                    <?php foreach($newFilms as $film): ?>
                    <a href="phim/<?=$film['flink'].'.'.$film['id'].'.html'?>">
                        <div class="film__list--item">
                            <div class="film__item--image">
                                <div class="film__item--status"><?=$film['fstatus']?></div>
                                <img src="<?=getThumb($film['fthumb'])?>">
                            </div>
                            <div class="film__item--name">
                                <?=$film['fname']?>
                            </div>
                        </div>
                    </a>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <div class="container-width main">
            <div class="film__header">
                <div><strong>Phim </strong>thịnh hành</div>
                <div><a href="danh-sach-phim"><button class="viewmore">Xem Tất Cả</button></a></div>
            </div>
            <?php
                $sql = "SELECT film.id, film.fname, film.fthumb, film.flink, film.fstatus FROM film RIGHT JOIN episode ON film.id = episode.movie GROUP BY film.fname ORDER BY film.id DESC";
                $query = $conn->prepare($sql);
                $query->execute();
                $listFilms = $query->fetchAll();
            ?>
            <div class="film__list">
                
            </div>
            <button class="loadmore">Tải thêm phim...</button>
        </div>
    </main>
    <!--end main-->
    <!--footer-->
    <footer>
        <div class="footer container-width">
            <img src="img/logo.svg">
            <nav>
                <ul class="navmenu">
                    <li><a href="#">Sitemap</a></li>
                    <li><a href="#">Điều Khoản</a></li>
                    <li><a href="#">Liên Hệ</a></li>
                    <button class="ontop"><i class="fas fa-arrow-up"></i></button>
                </ul>
            </nav>
        </div>
        <div class="copyright container-width">© Copyright 2021. Author Nguyen Dang Nhat - Clone Hotflix Theme</div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js/custom.js"></script>
    <script>
        $(document).ready(function(){
            var position = 0;
            $('.main .film__list').load('module/getfilm.php',{position: position});
            function getFilm(){
                $.ajax({
                    url         : 'module/getfilm.php',
                    type        : 'POST',
                    dataType    : 'html',
                    data        : {position: position + 15},
                    beforeSend  : function(){
                        $('.loadmore').html('<i class="fas fa-spinner fa-spin"></i> Đang tải')
                    },
                    success     : function(data){
                        setTimeout(()=>{
                            if(data.length > 0){
                                $('.main .film__list').append(data);
                                position += 15;
                                $('.loadmore').html('Tải thêm phim...')
                            } else {
                                $('.loadmore').hide();
                            }
                        },500);
                    }
                });
            }
            $('.loadmore').click(function(){
                getFilm();
            });
        });
    </script>
</body>
</html>