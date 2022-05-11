<?php
    if(!isset($_SESSION['username']) || !isset($_SESSION['flagLogin'])){
        header('Location: VIP/login.php');
    }
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Assignment WEB2013 | Nguyễn Đăng Nhật</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/all.min.css" rel="stylesheet">
    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
</head>
<body>
    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <img alt="image" class="rounded-circle" src="img/emoji.png" style="width:48px;height:48px" />
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="block m-t-xs font-bold"><? echo $_SESSION['username'] ?></span>
                            <span class="text-muted text-xs block">FPT Polytechnic <b class="caret"></b></span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a class="dropdown-item" href="profile.html">Trang cá nhân</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                    N+
                    </div>
                </li>
                <li>
                    <a href="index.php"><i class="fa fa-th-large"></i> <span class="nav-label">Trang chủ</span></a>
                </li>
                <li>
                    <a href="managefilm.php"><i class="fas fa-video"></i> <span class="nav-label">Danh sách phim</span></a>
                </li>
                <li>
                    <a href="upfilm.php"><i class="fas fa-film"></i> <span class="nav-label">Thêm phim</span></a>
                </li>
                <li>
                    <a href="comment.php"><i class="far fa-comments"></i> <span class="nav-label">Bình luận</span></a>
                </li>
                <li>
                    <a href="report_error.php"><i class="fas fa-exclamation"></i> <span class="nav-label">Báo cáo lỗi</span></a>
                </li>
                <li>
                    <a href="crawl.php"><i class="fas fa-allergies"></i> <span class="nav-label">Crawl Phimhaytvv</span></a>
                </li>
                <li>
                    <a href="change_password.php"><i class="fas fa-key"></i> <span class="nav-label">Đổi mật khẩu</span></a>
                </li>
                <li>
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> <span class="nav-label">Đăng xuất</span></a>
                </li>
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Nhập để tìm kiếm..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Xin chào</span>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a class="dropdown-item float-left" href="#">
                                    <img alt="image" class="rounded-circle" src="img/a7.jpg">
                                </a>
                                <div>
                                    <small class="float-right">46 giờ trước</small>
                                    <strong>Nguyễn Đăng Nhật</strong> bắt đầu theo dõi <strong>Nguyễn Đăng Nhật</strong>. <br>
                                    <small class="text-muted">46 giờ trước lúc 7:58 pm - 26.07.2021</small>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="#" class="dropdown-item">
                                    <i class="fa fa-envelope"></i> <strong>Xem tất cả tin nhắn</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#" class="dropdown-item">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Bạn có 8 tin nhắn
                                    <span class="float-right text-muted small">4 phút trước</span>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="#" class="dropdown-item">
                                    <strong>See tất cả</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="logout.php">
                        <i class="fas fa-sign-out-alt"></i> Đăng xuất
                    </a>
                </li>
            </ul>

        </nav>
        </div>