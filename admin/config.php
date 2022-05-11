<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    define('host', 'mysql:host=localhost;dbname=sitephim;charset:utf8');
    define('dbuser','root');
    define('dbpass','');

    try {
        // Kết nối
        $conn = new PDO(host, dbuser, dbpass);
         
        // Thiết lập chế độ lỗi
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         
        // Thông báo thành công
    } 
    // Nhánh kết nối thất bại
    catch (PDOException $e) {
        die('Kết nối thất bại: ' . $e->getMessage());
    }
?>