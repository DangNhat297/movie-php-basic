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
            <div class="alert alert-success">
                                Xác minh tài khoản thành công !
                                Sẽ tự động chuyển về trang đăng nhập sau <span class="timecount"></span> giây.
                            </div>
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
            var i = 5;
            var count = setInterval(function(){
                $('.timecount').text(i);
                i--;
                if(i < 0) clearInterval(count);
            },1000);
            setTimeout(function(){
                window.location.href="login.php";
            },6000);
        });
    </script>
</body>

</html>
