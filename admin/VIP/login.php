<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NĐN | Đăng nhập</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/css/all.min.css" rel="stylesheet">
    <link href="../css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

</head>
<?php 
    session_start();
    include '../incfiles/functions.php';
    if(isset($_SESSION['username']) && isset($_SESSION['flagLogin'])){
        header("Location: ../index.php");
    }
?>
<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name"><i class="fas fa-cogs"></i></h1>

            </div>
            <h3>Chào mừng đến với trang quản trị </h3>
            <p>ASSIGNMENT WEB2013 - NGUYỄN ĐĂNG NHẬT
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>
            <p>Đăng nhập ngay để quản lý website</p>
            <form class="m-t" role="form" action="" id="formLogin">
                <div class="form-group">
                    <input type="text" name="username" value="<? echo (isset($_COOKIE['username'])) ? $_COOKIE['username'] : ''; ?>" class="form-control" placeholder="Tên đăng nhập">
                    <span class="errormessage username form-text m-b-none" style="color: red"></span>
                </div>
                <div class="form-group">
                    <input type="password" name="password" value="<? echo (isset($_COOKIE['password'])) ? $_COOKIE['password'] : ''; ?>" class="form-control" placeholder="Mật khẩu">
                    <span class="errormessage password form-text m-b-none" style="color: red"></span>
                </div>
                <div class="form-group">
                        <div class="checkbox i-checks"><label for="remember"> <input value="remember" name="remember" id="remember" type="checkbox" <? echo (isset($_COOKIE['remember'])) ? 'checked' : ''; ?>><i></i> Nhớ mật khẩu </label></div>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Đăng nhập</button>

                <p class="text-muted text-center"><small>Bạn chưa có tài khoản?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.php">Đăng ký ngay</a>
            </form>
            <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.errormessage').hide();
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
            $('#formLogin').submit(function(e){
                $('.errormessage').html('');
                $('.errormessage').hide();
                e.preventDefault();
                var username        = $('input[name="username"]').val();
                var password        = $('input[name="password"]').val();
                var remember        = '';
                if($('#remember').is(':checked')){
                    remember = 'remember';
                } else {
                    remember = '';
                }
                $.ajax({
                    url         : '../module/check_login.php',
                    type        : 'POST',
                    data        : {username: username, password: password, remember: remember},
                    dataType    : 'json',
                    beforeSend  : function(){
                        $('button[type="submit"]').html('<i class="fas fa-circle-notch fa-spin"></i> Đang tiến hành');
                    },
                    success     : function(data, status){
                        setTimeout(function(){
                            if(data.status == 'success'){
                                $('button[type="submit"]').html('<i class="fas fa-check"></i> Thành công');
                                swal("Thành công", "Đăng nhập thành công", "success");
                                setTimeout(function(){
                                    window.location.href="../index.php";
                                },2000);
                            } else {
                                $('.errormessage').show();
                                for(var x in data.message){
                                    $('.errormessage.' + x).html(data.message[x]);
                                }
                                swal("Thất bại", "Đăng nhập thất bại. Vui lòng kiểm tra lại", "error");
                                $('button[type="submit"]').html('Đăng nhập');
                                
                            }
                        },1000);
                    }
                });
            });
        });
    </script>
</body>

</html>
