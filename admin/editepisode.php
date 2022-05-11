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
                            <h5>Sửa tập phim</h5>
                        </div>
                        <div class="ibox-content">
                        <?php
                            if(isset($_GET['episode']) && $_GET['episode'] != ''){
                                $id = (int)$_GET['episode'];
                                $sql = "SELECT episode.id, episode.episode_name, episode.player, film.fname FROM episode,film WHERE film.id = episode.movie AND episode.id = $id;";
                                $query = $conn->prepare($sql);
                                $query->execute();
                                if($query->rowCount() > 0){
                                    $result = $query->fetch();
                        ?>
                            <form id="update-episode" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="episode" value="<?=$result['id']?>">
                                <div class="alert alert-danger alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                </div>
                                <div class="form-group row"><label for="fname" class="col-lg-2 col-form-label">Tên phim</label>
                                <div class="col-lg-10"><input type="text" name="fname" value="<?=$result['fname']?>" id="fname" placeholder="Nhập tên phim" class="form-control" readonly>
                                </div>
                                </div>
                                <div class="form-group row"><label for="episode-name" class="col-lg-2 col-form-label">Tên tập</label>
                                <div class="col-lg-10"><input type="text" name="episode-name" value="<?=$result['episode_name']?>" id="episode-name" placeholder="Nếu là phim lẻ thì HD, HD Vietsub,... Còn phim bộ thì thứ tự tập 01, 02, ..." class="form-control" required>
                                </div>
                                </div>
                                <div class="form-group row"><label for="fplayer" class="col-lg-2 col-form-label">Link drive</label>
                                <div class="col-lg-10"><input type="text" name="fplayer" id="fplayer" value="https://drive.google.com/file/d/<?=$result['player']?>/view?usp=sharing" placeholder="Nhập link player drive" class="form-control" required>
                                </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-sm btn-primary" type="submit">Cập nhật tập phim</button>
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
            $('#update-episode').submit(function(e){
                $('.alert-dismissable').hide();
                $('.alert-dismissable span').remove();
                e.preventDefault();
                var formData = new FormData(this);
                formData.append('action','update-episode');
                $.ajax({
                    url         : 'module/module_film.php',
                    type        : 'POST',
                    dataType    : 'json',
                    contentType : false,
                    processData : false,
                    data        : formData,
                    beforeSend  : function(){
                        $('button[type="submit"]').html('<i class="fas fa-spinner fa-pulse"></i> Đang cập nhật tập phim');
                    },
                    success     : function(data){
                        setTimeout(function(){
                            if(data.status == 'success'){
                                $('button[type="submit"]').html('<i class="fas fa-check"></i> Cập nhật thành công');
                                swal("Thành công", "Cập nhật tập phim thành công", "success");
                                setTimeout(function(){
                                    window.history.back();
                                },2000);
                            } else {
                                $('button[type="submit"]').html('Cập nhật tập phim');
                                swal("Thất bại", "Cập nhật tập phim thất bại, vui lòng thử lại", "error");
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
