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
    require_once 'admin/config.php';
    require_once 'incfiles/functions.php';
    $id = (int)$_GET['film'];
    $sql = "SELECT * FROM film WHERE id = $id";
    $query = $conn->prepare($sql);
    $query->execute();
    $film = $query->fetch();
?>
    <main>
        <div class="container-width main">
            <div class="showfilm">
                <div id="player">
                    <iframe width="100%" height="600px" title="video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="report">
                    <button class="view__stats"><i class="far fa-eye"></i> <?=$film['fview']?> Lượt Xem</button>
                    <button><i class="fas fa-info"></i> Thông tin phim</button>
                    <button class="report__error" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-exclamation-triangle"></i> Báo lỗi</button>
                </div>
                <!--modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <form>
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Báo lỗi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                    <div class="form-group">
                                        <label>Tên hoặc email</label>
                                        <input type="text" name="error-name" class="form-control" placeholder="Nhập tên hoặc email của bạn..." required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nội dung</label>
                                        <textarea class="form-control" name="error-detail" placeholder="Báo cáo chi tiết về lỗi..." rows="3" required></textarea>
                                    </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                            <button type="submit" class="btn btn-primary">Báo lỗi</button>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                <!--end modal-->
                <div class="film__detail--name">
                        <p><?=$film['fname']?> | <span class="episode-name"></span></p>
                    </div>
                <div class="episode">
                    <div class="episode__header"><span>Chọn tập</span></div>
                    <div class="episode__list">
                        <ul class="episode__picker">
                            <?php 
                                $sql = "SELECT * FROM episode WHERE movie = $id";
                                $query = $conn->prepare($sql);
                                $query->execute();
                                $listEpisode = $query->fetchAll();
                                foreach($listEpisode as $episode):
                            ?>
                            <li><a href="#" data-episode="<?=$episode['id']?>"><?=$episode['episode_name']?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="film__content">
                <div class="film__content--header">
                    <span data-tab="tab-comment" class="active">Bình luận</span>
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
            <div class="film__header">
                    <div><strong>Phim </strong> liên quan</div>
                </div>
                <div class="film__list">
                    <?php
                    $sql = "SELECT film.id, film.fname, film.fthumb, film.flink, film.fview FROM film RIGHT JOIN episode ON film.id = episode.movie GROUP BY film.fname ORDER BY film.fview DESC LIMIT 10";
                    $query = $conn->prepare($sql);
                    $query->execute();
                    $newFilms = $query->fetchAll();
                    foreach($newFilms as $film): ?>
                    <a href="/sitephim/phim/<?=$film['flink'].'.'.$film['id'].'.html'?>">
                        <div class="film__list--item">
                            <div class="film__item--image">
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
            $(document).on('click','.episode__picker li', function(){
                $('.episode__picker li').removeClass("active");
                $('.episode__picker li').attr("disabled",false);
                $(this).addClass("active");
                $(this).attr("disabled",true);
                var episode = $(this).find('a').data("episode");
                var episodeName = $(this).find('a').text();
                $('.episode-name').text(episodeName);
                pickEpisode(episode, <?=$id?>);
                return false;
            });
            $('.episode__picker li:eq(0)').trigger('click');        
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
            $('.modal-content form').submit(function(e){
                e.preventDefault();
                var name    = $('input[name="error-name"]').val();
                var error   = $('textarea[name="error-detail"]').val();
                $.ajax({
                    url         : '/sitephim/module/error.php',
                    dataType    : 'json',
                    type        : 'POST',
                    data        : {type: 'error', 'name': name, error: error, film: <?=$id?>},
                    beforeSend  : function(){
                        $('.modal-content button[type="submit"]').html('<i class="fas fa-circle-notch fa-spin"></i> Đang xử lý');
                    },
                    success     : function(data){
                        setTimeout(() => {
                            if(data.status == 'success'){
                                $('input[name="error-name"]').attr("disabled",true);
                                $('textarea[name="error-detail"]').attr("disabled",true);
                                $('.modal-content button[type="submit"]').html('Thành công').attr("disabled",true);
                            }
                        }, 1000);
                    }
                });
            });
            loadComment(<?=$id?>);
        });
    </script>
</body>
</html>