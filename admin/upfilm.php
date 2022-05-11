<?php
    session_start();
    include 'config.php';
    include 'incfiles/head.php';
?>
        <div class="wrapper wrapper-content">
        <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Thêm phim</h5>
                        </div>
                        <div class="ibox-content">
                            <form id="add-film" method="POST" enctype="multipart/form-data">
                                <div class="alert alert-danger alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                </div>
                                <div class="form-group row"><label for="fname" class="col-lg-2 col-form-label">Tên phim</label>
                                <div class="col-lg-10"><input type="text" name="fname" id="fname" placeholder="Nhập tên phim" class="form-control" required>
                                </div>
                                </div>
                                <div class="form-group row"><label for="fdescription" class="col-lg-2 col-form-label">Mô tả phim</label>
                                <div class="col-lg-10"><textarea type="text" name="fdescription" id="fdescription" placeholder="Nhập mô tả" rows="5" class="form-control" required></textarea>
                                </div>
                                </div>
                                <div class="form-group row"><label for="fthumb" class="col-lg-2 col-form-label">Upload ảnh</label>
                                <div class="col-lg-10"><div class="custom-file">
                                    <input id="fthumb" type="file" class="custom-file-input" name="fthumb">
                                    <label for="fthumb" class="custom-file-label">Choose file...</label>
                                    <span class="form-text m-b-none">Định dạng cho phép: png, jpg, jpeg, jfif. Kích thước 50kb - 5mb
                                        <br>Hoặc <span class="toggleinputurlthumb" style="color: #1AB394;cursor: pointer">ấn vào đây</span> để nhập link thumbnail
                                    </span>
                                </div> 
                                </div>
                                </div>
                                <div class="form-group row linkthumb"><label for="furlthumb" class="col-lg-2 col-form-label">Link thumbnail</label>
                                <div class="col-lg-10"><input type="text" id="furlthumb" name="furlthumb" placeholder="Nhập link thumbnail" class="form-control">
                                </div>
                                </div>
                                <div class="form-group row"><label for="fcategory" class="col-lg-2 col-form-label">Danh mục phim</label>
                                <div class="col-lg-10"><input type="text" id="fcategory" name="fcategory" placeholder="Phim hành động, phim tình cảm, phim chiếu rạp..." class="form-control" required>
                                </div>
                                </div>
                                <div class="form-group row"><label for="fstatus" class="col-lg-2 col-form-label">Tình trạng phim</label>
                                <div class="col-lg-10"><input type="text" id="fstatus" name="fstatus" placeholder="HD Vietsub, Thuyết Minh, CAM,..." class="form-control" required>
                                </div>
                                </div>
                                <div class="form-group row"><label for="fcountry" class="col-lg-2 col-form-label">Quốc gia</label>
                                <div class="col-lg-10"><input type="text" id="fcountry" name="fcountry" placeholder="Việt Nam, Hàn Quốc,..." class="form-control" required>
                                </div>
                                </div>
                                <div class="form-group row"><label for="fyear" class="col-lg-2 col-form-label">Năm sản xuất</label>
                                <div class="col-lg-10"><input type="text" id="fyear" name="fyear" placeholder="Nhập năm sán xuất" class="form-control" required>
                                </div>
                                </div>
                                <div class="form-group row"><label for="ftag" class="col-lg-2 col-form-label">Từ khóa</label>
                                <div class="col-lg-10"><input type="text" id="ftag" name="ftag" placeholder="Các từ khóa cách nhau bởi dấu phẩy ," class="form-control" required>
                                </div>
                                </div>
                                <div class="form-group row"><label class="col-sm-2 col-form-label">Loại phim</label>
                                    <div class="col-sm-10"><select class="form-control m-b" id="ftype" name="ftype">
                                        <option value="phimbo">Phim bộ (Series Dài Tập)</option>
                                        <option value="phimle">Phim lẻ (Movie/OVA)</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group row"><label for="fepisode" class="col-lg-2 col-form-label">Số tập</label>
                                <div class="col-lg-10"><input type="text" id="fepisode" name="fepisode" placeholder="Nhập số tập" class="form-control" required>
                                </div>
                                </div>
                                <div class="typefilm">
                                    <div class="form-group row"><label for="fepisode-name" class="col-lg-2 col-form-label">Tên tập</label>
                                    <div class="col-lg-10"><input type="text" id="fepisode-name" name="fepisode-name" placeholder="HD Vietsub, Vietsub, CAM,.." class="form-control">
                                    </div>
                                    </div>
                                    <div class="form-group row"><label for="fplayer" class="col-lg-2 col-form-label">Player (Drive)</label>
                                    <div class="col-lg-10"><input type="text" id="fplayer" name="fplayer" placeholder="Nhập link drive" class="form-control">
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-sm btn-primary" id="submit" type="submit">Thêm phim</button>
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
            $('.alert').hide();
            $('.linkthumb').hide();
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
                $('.toggleinputurlthumb').hide();
            });
            $('.toggleinputurlthumb').click(function(){
                $('.linkthumb').slideDown("slow").show();
                $('#fthumb').attr("disabled","true");
            });
            $('.typefilm').hide();
            $('#ftype').change(function(){
                console.log($(this).val());
                if($(this).val() == 'phimle'){
                    $('.typefilm').slideDown("slow").show();
                    $('#fepisode').val('1');
                } else {
                    $('.typefilm').slideUp("slow");
                    $('#fepisode').val('');
                }
            });
            $('#add-film').submit(function(e){
                $('.alert').hide();
                $('.alert span').remove();
                e.preventDefault();
                var formData = new FormData(this);
                formData.append('action','add');
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
                                swal("Thành công", "Thêm phim thành công", "success");
                                setTimeout(function(){
                                    window.location.href="";
                                },2000);
                            } else {
                                $('button[type="submit"]').html('Thêm phim');
                                swal("Thất bại", "Thêm phim thất bại, vui lòng thử lại", "error");
                                for(var x in data.message){
                                    $('.alert').append('<span>'+ data.message[x] +'<br/></span>');
                                }
                                $('.alert').show();
                            }
                        },1000);
                    }
                });
            });
        });
    </script>
</body>
</html>
