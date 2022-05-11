<?php
    session_start();
    include 'config.php';
    include 'incfiles/head.php';
?>
<?php
    if(isset($_GET['film']) && $_GET['film'] != ''){
    $film = (int)$_GET['film'];
    $sql = "SELECT episode.id, episode.episode_name, episode.player, episode.movie, film.fname FROM episode,film WHERE film.id = episode.movie AND episode.movie = $film;";
    $query = $conn->prepare($sql);
    $query->execute();
    $episodes = $query->fetchAll(); 
    $sql = "SELECT * FROM film WHERE id = $film";
    $query = $conn->prepare($sql);
    $query->execute();
    $film = $query->fetch();
?>
        <div class="wrapper wrapper-content">
        <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5><?=$film['fname']?></h5>
                        </div>
                        <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover manage-film" >
                                <thead>
                                    <tr>
                                        <th>Tên tập</th>
                                        <th>ID Player</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($episodes as $episode): ?>
                                    <tr>
                                        <td><?=$episode['episode_name']?></td>
                                        <td><?=$episode['player']?></td>
                                        <td class="tooltips-btn">
                                            <a href="editepisode.php?episode=<?=$episode['id']?>"><button type="button" class="btn btn-success btn-xs" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Chỉnh sửa tập"><i class="fas fa-pen"></i></button></a>
                                            <button id="delepisode" data-id-episode="<?=$episode['id']?>" type="button" class="btn btn-danger btn-xs" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Xóa tập"><i class="far fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </table>
                            <?php
                                }
                                else {
                                    echo "<script>window.location.href='managefilm.php'</script>";
                                }
                            ?>
                        </div>
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
            $('.manage-film').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                });
            $('.tooltips-btn td').popover();
            $(document).on('click','#delepisode', function(){

                var id = $(this).data("id-episode");
                //pop up
                swal({
                    title: "Bạn có chắc chắn muốn xóa ?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url     : 'module/module_film.php',
                        type    : 'POST',
                        data    : {episode: id, 'action':'delete-episode'},
                        dataType: 'json',
                        success : function(data){
                            if(data.status == 'success'){
                                swal("Thành công", "Bạn đã xóa thành công", "success");
                                setTimeout(function(){
                                    window.location.href="";
                                },2000);
                            } else {
                                swal("Thất bại", "Xóa thất bại, vui lòng thử lại !", "error");
                            }
                        }
                    });
                }
                });
                });
       });
    </script>
</body>
</html>
