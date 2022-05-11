<?php
    session_start();
    include 'config.php';
    include 'incfiles/head.php';
?>
<?php
    $sql = "SELECT * FROM film ORDER BY id DESC";
    $query = $conn->prepare($sql);
    $query->execute();
    $films = $query->fetchAll(); 
?>
        <div class="wrapper wrapper-content">
        <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Danh sách phim</h5>
                        </div>
                        <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover manage-film" >
                                <thead>
                                    <tr>
                                        <th>Tên phim</th>
                                        <th>Loại phim</th>
                                        <th>Số tập</th>
                                        <th>Lượt xem</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($films as $film): ?>
                                    <?php 
                                        $sql = "SELECT count(*) as sotap FROM episode,film WHERE episode.movie = film.id AND film.id = $film[0]";
                                        $query = $conn->prepare($sql);
                                        $query->execute();
                                        $numEpisode = $query->fetch()['sotap'];
                                    ?>
                                    <tr>
                                        <td><?=$film['fname']?></td>
                                        <td><?=($film['ftype'] == 'phimle') ? 'Movie / OVA' : 'Phim bộ' ?></td>
                                        <td><?echo $numEpisode.'/'.$film['fnum_episode']?></td>
                                        <td><?=$film['fview']?></td>
                                        <td class="tooltips-btn">
                                            <a href="addepisode.php?film=<?=$film['id']?>"><button type="button" class="btn btn-primary btn-xs" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Thêm tập mới vào phim"><i class="fas fa-plus"></i></button></a>
                                            <a href="editfilm.php?film=<?=$film['id']?>"><button type="button" class="btn btn-success btn-xs" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Chỉnh sửa phim"><i class="fas fa-pen"></i></button></a>
                                            <a href="manageepisode.php?film=<?=$film['id']?>"><button type="button" class="btn btn-info btn-xs" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Danh sách tập phim"><i class="fas fa-list"></i></button></a>
                                            <button id="removefilm" data-id-film="<?=$film['id']?>" type="button" class="btn btn-danger btn-xs" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Xóa phim"><i class="far fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </table>
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
            $(document).on('click','#removefilm', function(){

                var id = $(this).data("id-film");
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
                        data    : {film: id, 'action':'delete'},
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
