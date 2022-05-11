<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/sitephim/css/main.css">
</head>
<body id="scroll">
    <!--start header-->
    <header>
        <div class="container-width header">
            <img src="/sitephim/img/logo.svg">
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
                    <li><a href="/sitephim/index.html">Trang Chủ</a></li>
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
    include 'incfiles/functions.php';
    include 'admin/config.php';
    $id = (int)$_GET['film'];
    $sql = "SELECT * FROM film WHERE id = $id";
    $query = $conn->prepare($sql);
    $query->execute();
    $film = $query->fetch();
?>
    <main>
        <div class="container-width main">
            <div class="film__detail">
                <div class="film__detail--thumbnail">
                    <img src="<?=getThumb($film['fthumb'])?>">
                </div>
                <div class="film__detail--info">
                    <div class="film__detail--name">
                        <p><?=$film['fname']?></p>
                    </div>
                    <a href="<?='/sitephim/xem-phim/'.$film['flink'].'.'.$film['id'].'.html'?>"><button class="playfilm"><i class="far fa-play-circle"></i> Xem ngay</button></a>
                    <ul class="film__list--info">
                        <li><span><i class="fas fa-stream"></i></span>Trạng thái: <span><?=$film['fstatus']?></span></li>
                        <li><span><i class="fas fa-boxes"></i></span>Thể loại: <span><?=$film['fcategory']?></span></li>
                        <li><span><i class="far fa-calendar-check"></i></span>Năm sản xuất: <span><?=$film['fyear']?></span></li>
                        <li><span><i class="fas fa-globe"></i></span>Quốc gia: <span><?=$film['fcountry']?></span></li>
                        <li><span><i class="far fa-eye"></i></span>Lượt xem: <span><?=$film['fview']?></span></li>
                        <li><span><i class="fas fa-tags"></i></span>Từ khóa: <span><?=$film['ftag']?></span></li>
                    </ul>
                </div>
            </div>
            <div class="film__content">
                <div class="film__content--header">
                    <span data-tab="tab-content" class="active">Nội dung phim</span>
                    <span data-tab="tab-comment">Bình luận</span>
                </div>
                <div class="tab-item film__content--body" id="tab-content">
                <?=$film['fdescription']?>
                </div>
                <div class="tab-item film__content--comment" id="tab-comment">
                    <form>
                    <div class="tab__comment--header">
                        <form>
                        <input type="text" placeholder="Nhập họ tên" class="name-comment" required>
                        <input type="text" placeholder="Nhập bình luận..." class="incomment" required>
                        <button type="button" class="sendcomment"><i class="far fa-paper-plane"></i> Gửi bình luận</button>
                    </div>
                    </form>
                    <div class="tab__comment--list" id="comment-list">
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--end main-->
    <!--footer-->
    <footer>
        <div class="footer container-width">
            <img src="/sitephim/img/logo.svg">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="/sitephim/js/tab.js"></script>
    <script src="/sitephim/js/custom.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            loadComment(<?=$id?>);
            $(document).on('click','.sendcomment',function(){
                var name    = $('.name-comment').val();
                var comment = $('.incomment').val();
                $.ajax({
                    url         : '/sitephim/module/comment.php',
                    type        : 'POST',
                    dataType    : 'json',
                    data        : {name: name, comment: comment, type: 'cmt', film: <?=$id?>},
                    beforeSend  : function(){
                        $('.sendcomment').html('<i class="fas fa-spinner fa-spin"></i> Đang bình luận');
                    },
                    success     : function(data){
                        setTimeout(function(){
                            if(data.status == 'success'){
                                $('.sendcomment').html('<i class="far fa-paper-plane"></i> Gửi bình luận');
                                loadComment(<?=$id?>);
                                $('.name-comment').val('');
                                $('.incomment').val('');
                            }
                        },1000);
                    }
                });
            });
        });
    </script>
</body>
</html>