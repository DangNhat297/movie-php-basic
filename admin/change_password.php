<?php
    session_start();
    include 'incfiles/head.php';
?>
        <div class="wrapper wrapper-content">
        <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Thay đổi mật khẩu</h5>
                        </div>
                        <div class="ibox-content">
                            <form id="formSignup">
                            <div id="message-content" class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            </div>
                                <div class="form-group row"><label for="oldpass" class="col-lg-2 col-form-label">Mật khẩu cũ</label>
                                <div class="col-lg-10"><input type="password" id="oldpass" placeholder="Mật khẩu cũ" class="form-control">
                                </div>
                                </div>
                                <div class="form-group row"><label for="newpass" class="col-lg-2 col-form-label">Mật khẩu mới</label>
                                    <div class="col-lg-10"><input type="password" id="newpass" placeholder="Mật khẩu mới" class="form-control"></div>
                                </div>
                                <div class="form-group row"><label for="repass" class="col-lg-2 col-form-label">Nhập lại mật khẩu mới</label>
                                    <div class="col-lg-10"><input type="password" id="repass" placeholder="Nhập lại mật khẩu" class="form-control"></div>
                                </div>
                                <input type="hidden" id="username" value="<?=$_SESSION['username']?>">
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-sm btn-primary" type="submit">Thay đổi</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    include 'incfiles/foot.php';
?>
    <script>
        $(document).ready(function(){
            $('#message-content').hide();
            $('form#formSignup').submit(function(e){
                $('#message-content').hide();
                $('#message-content span').remove();
                e.preventDefault();
                var oldpass     = $('#oldpass').val();
                var newpass     = $('#newpass').val();
                var repass      = $('#repass').val();
                var username    = $('#username').val();
                $.ajax({
                    url         : 'module/changepass.php',
                    type        : 'POST',
                    data        : {oldpass: oldpass, newpass: newpass, repass: repass, username: username},
                    dataType    : 'json',
                    beforeSend  : function(){
                        $('button[type="submit"]').html('<i class="fas fa-circle-notch fa-spin"></i> Đang tiến hành');
                    },
                    success     : function(data){
                        setTimeout(function(){
                            if(data.status == 'success'){
                                $('button[type="submit"]').html('<i class="fas fa-check"></i> Thành công');
                                $('button[type="submit"]').attr("disabled", "disabled");
                                swal("Thành công", "Thay đổi mật khẩu thành công", "success");
                                setTimeout(function(){
                                    window.location.href="";
                                },1000);
                            } else {
                                $('#message-content').show();
                                $('button[type="submit"]').html('Đăng ký');
                                swal("Thất bại", "Thay đổi mật khẩu thất bại, vui lòng thử lại", "error");
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
