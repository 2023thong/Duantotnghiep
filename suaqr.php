<?php
$con = mysqli_connect("localhost", "root", "", "duan");
if ($con) {
    if (!empty($_POST['image']) && !empty($_POST['Id'])) {
        $path = 'img1/' . date("d-m-y") . '-' . time() . '-' . rand(10000, 100000) . '.jpg';
        
        if (file_put_contents($path, base64_decode($_POST['image']))) {
            $Id = mysqli_real_escape_string($con, $_POST['Id']); // Bảo vệ khỏi SQL Injection
            $updateSql = "UPDATE qr SET Anh = '$path' WHERE Id = '$Id'";
            
            if (mysqli_query($con, $updateSql)) {
                echo "success";
            } else {
                echo "Lỗi cập nhật ảnh vào cơ sở dữ liệu";
            }
        } else {
            echo 'Lỗi khi lưu tệp ảnh.';
        }
    } else {
        echo 'Vui lòng chọn Qr';
    }
} else {
    echo "Lỗi kết nối tới cơ sở dữ liệu";
}
?>