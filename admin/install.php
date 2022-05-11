<?php
    define('host', 'mysql:host=localhost;charset:utf8');
    define('dbuser','root');
    define('dbpass','');
    define('dbname','sitephim');
    $error = array();
    try {
        // Chuỗi kết nối
        $conn = new PDO(host, dbuser, dbpass);
         
        // Thiết lập chế độ exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         
        // Câu truy vấn
        $sql = "CREATE DATABASE sitephim";
         
        // Thực thi câu truy vấn
        $conn->exec($sql);
         
        // Thông báo thành công
        echo "Tạo database thành công";
    }
    catch(PDOException $e)
    {
        $error[] = 'Không thể tạo database';
    }
    $sql = [
        "CREATE TABLE users(
            adminId int(11) auto_increment primary key,
            adminUser varchar(150) not null comment 'Email',
            adminPass varchar(100) not null comment 'Mật khẩu',
            status int(0) NOT NULL DEFAULT '0' comment 'Kích hoạt',
            verify_code varchar(50) not null comment 'Mã kích hoạt',
            reg_date datetime not null
        );",
        "CREATE TABLE film(
            id int auto_increment primary key,
            fname varchar(255) not null comment 'Tên phim',
            fdescription text comment 'Mô tả',
            fthumb varchar(500) comment 'Ảnh thumbnail',
            fcategory varchar(100) comment 'Thể loại phim',
            fstatus varchar(255) comment 'Tình trạng phim',
            fcountry varchar(255) comment 'Quốc gia',
            fview int comment 'Lượt xem',
            fyear int comment 'Năm sản xuất',
            flink varchar(255) comment 'Link phim',
            ftag varchar(255) comment 'Từ khóa liên quan',
            fnum_episode int comment 'Số tập',
            ftype varchar(25) comment 'Phim bộ hoặc phim lẻ'
        );",
        "CREATE TABLE episode(
            id int auto_increment primary key,
            episode_name varchar(255) not null,
            player varchar(255) not null,
            movie int not null,
            foreign key (movie) references film(id) ON DELETE CASCADE
        );",
        "CREATE TABLE comment(
            id int auto_increment primary key,
            name_cmt varchar(255) not null,
            detail_cmt text not null,
            ip_address varchar(255) not null,
            time_cmt datetime,
            film int not null,
            foreign key (film) references film(id) ON DELETE CASCADE
        );",
        "CREATE TABLE report_error(
            id int auto_increment primary key,
            rpfrom varchar(50) comment 'Tên người gửi',
            error_detail varchar(255) comment 'Nội dung báo lỗi',
            timerp datetime not null,
            ip_address varchar(25) comment 'Địa chỉ IP người gửi',
            film int not null,
            foreign key (film) references film(id) ON DELETE CASCADE
        );"
    ];
    try{
        $conn->query("use ". dbname);
        foreach($sql as $query){
            $conn->exec($query);
        }
        echo 'Tạo table thành công !';
    }
    catch(PDOException $e){
        $error[] = $e->getMessage();
    }
    echo '<pre>';
    print_r($error);
    echo '</pre>';
?>