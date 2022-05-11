<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NĐN | Đăng ký tài khoản</title>

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

    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <div>

            <h1 class="logo-name"><i class="fas fa-sign-in-alt"></i></h1>

            </div>
            <h3>Đăng ký tài khoản</h3>
            <p>ASSIGNMENT WEB2013 - NGUYỄN ĐĂNG NHẬT
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>
            <div id="message-content" class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            </div>
            <div id="message-success" class="alert alert-success alert-dismissable">
                Đăng ký thành công ! Vui lòng kiểm tra email và xác minh tài khoản !<br>
                Tài khoản sẽ bị xóa sau 24h nếu không xác minh !
            </div>
            <form class="m-t" role="form" action="" id="formSignup">
                <div class="form-group">
                    <input type="email" id="email" class="form-control" placeholder="Email" required="">
                </div>
                <div class="form-group">
                    <input type="text" id="username" class="form-control" placeholder="Tên đăng nhập" required="">
                </div>
                <div class="form-group">
                    <input type="password" id="password" class="form-control" placeholder="Mật khẩu" required="">
                </div>
                <div class="form-group">
                    <input type="password" id="repassword" class="form-control" placeholder="Nhập lại mật khẩu" required="">
                </div>
                <div class="form-group">
                        <div class="checkbox i-checks"><label for="terms"> <input type="checkbox" id="terms"><i></i> Chấp nhận điều khoản đăng ký & sử dụng </label></div>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Đăng ký</button>

                <p class="text-muted text-center"><small>Already have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="login.php">Login</a>
            </form>
            <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../js/bootstrap.js"></script>
    
    <!-- iCheck -->
    <script src="../js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#message-content').hide();
            $('#message-success').hide();
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
            $('form#formSignup').submit(function(e){
                $('#message-content').hide();
                $('#message-content span').remove();
                e.preventDefault();
                var email       = $('#email').val();
                var username    = $('#username').val();
                var password    = $('#password').val();
                var repassword  = $('#repassword').val();
                var terms;
                if($('#terms').is(':checked')){
                    terms       = 'agree';
                } else {
                    terms       = '';
                }
                $.ajax({
                    url         : '../module/check_register.php',
                    type        : 'POST',
                    data        : {email: email, username: username, password: password, repassword: repassword, terms: terms},
                    dataType    : 'json',
                    beforeSend  : function(){
                        $('button[type="submit"]').html('<i class="fas fa-circle-notch fa-spin"></i> Đang đăng ký');
                    },
                    success     : function(data){
                        setTimeout(function(){
                            if(data.status == 'success'){
                                $('button[type="submit"]').html('<i class="fas fa-check"></i> Đăng ký thành công');
                                swal("Thành công", "Đăng ký thành công", "success");
                                setTimeout(function(){
                                    $('form').slideUp().hide();
                                    $('#message-success').slideDown("slow").show();
                                },2000);
                            } else {
                                $('#message-content').show();
                                $('button[type="submit"]').html('Đăng ký');
                                swal("Thất bại", "Đăng ký thất bại, vui lòng thử lại", "error");
                                for(var x in data.message){
                                    $('#message-content').append('<span>' + data.message[x] + '<br/></span>');
                                }
                            }
                        },1000);
                    }
                });
            })
        });
    </script>
</body>

</html>
