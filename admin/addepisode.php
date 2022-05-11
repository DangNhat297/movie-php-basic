<?php
    session_start();
    include 'config.php';
    include 'incfiles/head.php';
    include 'incfiles/functions.php';
?>

        <div class="wrapper wrapper-content">
        <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Thêm tập phim</h5>
                        </div>
                        <div class="ibox-content">
                        <?php
                            if(isset($_GET['film']) && $_GET['film'] != ''){
                                $id = (int)$_GET['film'];
                                $sql = "SELECT * FROM film WHERE id = $id";
                                $query = $conn->prepare($sql);
                                $query->execute();
                                if($query->rowCount() > 0){
                                    $result = $query->fetch();
                        ?>
                            <form id="add-episode" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="film" value="<?=$result['id']?>">
                                <div class="alert alert-danger alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                </div>
                                <div class="form-group row"><label for="" class="col-lg-2 col-form-label">Thumbnail</label>
                                <div class="col-lg-10"><img src="<?=getThumb($result['fthumb'])?>" class="form-control" style="width: 130px;height: 140px;object-fit:cover">
                                </div>
                                </div>
                                <div class="form-group row"><label for="fname" class="col-lg-2 col-form-label">Tên phim</label>
                                <div class="col-lg-10"><input type="text" name="fname" value="<?=$result['fname']?>" id="fname" placeholder="Nhập tên phim" class="form-control" readonly>
                                </div>
                                </div>
                                <div class="form-group row"><label for="episode-name" class="col-lg-2 col-form-label">Tên tập</label>
                                <div class="col-lg-10"><input type="text" name="episode-name" id="episode-name" placeholder="Nếu là phim lẻ thì HD, HD Vietsub,... Còn phim bộ thì thứ tự tập 01, 02, ..." class="form-control" required>
                                </div>
                                </div>
                                <div class="form-group row"><label for="fplayer" class="col-lg-2 col-form-label">Link drive</label>
                                <div class="col-lg-10"><input type="text" name="fplayer" id="fplayer" placeholder="Nhập link player drive" class="form-control" required>
                                </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-sm btn-primary" type="submit">Thêm phim</button>
                                    </div>
                                </div>
                            </form>
                            <?php
                                } else {
                                        echo '<div class="alert alert-danger">
                                        Không tìm thấy phim, vui lòng thử lại !
                                    </div>';
                                    }
                                } else {
                                    echo "<script>window.location.href='index.php'</script>";
                                }
                            ?>
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
            $('.alert-dismissable').hide();
            $('#add-episode').submit(function(e){
                $('.alert-dismissable').hide();
                $('.alert-dismissable span').remove();
                e.preventDefault();
                var formData = new FormData(this);
                formData.append('action','add-episode');
                $.ajax({
                    url         : 'module/module_film.php',
                    type        : 'POST',
                    dataType    : 'json',
                    contentType : false,
                    processData : false,
                    data        : formData,
                    beforeSend  : function(){
                        $('button[type="submit"]').html('<i class="fas fa-spinner fa-pulse"></i> Đang thêm sản phẩm');
                    },
                    success     : function(data){
                        setTimeout(function(){
                            if(data.status == 'success'){
                                $('button[type="submit"]').html('<i class="fas fa-check"></i> Thêm thành công');
                                swal("Thành công", "Thêm tập phim thành công", "success");
                                setTimeout(function(){
                                    window.location.href="managefilm.php";
                                },2000);
                            } else {
                                $('button[type="submit"]').html('Thêm phim');
                                swal("Thất bại", "Thêm tập phim thất bại, vui lòng thử lại", "error");
                                for(var x in data.message){
                                    $('.alert-dismissable').append('<span>'+ data.message[x] +'<br/></span>');
                                }
                                $('.alert-dismissable').show();
                            }
                        },1000);
                    }
                });
            });
        });
    </script>
</body>
</html>
