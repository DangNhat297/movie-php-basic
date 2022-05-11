<?php
    session_start();
    include 'incfiles/head.php';
?>
        <div class="wrapper wrapper-content">
        <div class="row">
                <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Basic Table</h5>
                    </div>
                    <div class="ibox-content">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Tên</th>
                                <th>Nội dung</th>
                                <th>Địa chỉ IP</th>
                                <th>Thời gian</th>
                                <th>Phim</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="list-comment">
                            </tbody>
                        </table>
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
            function fetchData(){
                $.ajax({
                    url     : 'module/list_comment.php',
                    success  : function(data){
                        $('#list-comment').html(data);
                        $('.table').DataTable({
                            "paging": true,
                            "lengthChange": true,
                            "searching": true,
                            "ordering": false,
                            "info": true,
                            "autoWidth": true,
                            "responsive": true,
                        });
                    }
                });
            }
            fetchData();
            // xóa user
            $(document).on('click','#removecmt', function(){

                var id = $(this).data("id-cmt");
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
                    url         : 'module/module_comment.php',
                    type        : 'POST',
                    data        : {id: id, action: 'remove'},
                    dataType    : 'json',
                    success     : function(data){
                            if(data.status == 'success'){
                                swal("Thành công", "Bạn đã xóa thành công", "success");
                                setTimeout(()=>{
                                    window.location.href="";
                                },1000)
                            } else {
                                swal("Thất bại", "Xóa thất bại, vui lòng thử lại", "error");
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
