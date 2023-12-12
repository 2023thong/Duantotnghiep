<?php
$con = mysqli_connect("localhost", "root", "", "duan");
if ($con) {
    if (!empty($_POST['image']) && !empty($_POST['MaHH'])) {
        $path = 'img1/' . date("d-m-y") . '-' . time() . '-' . rand(10000, 100000) . '.jpg';
        
        if (file_put_contents($path, base64_decode($_POST['image']))) {
            $MaHH  = mysqli_real_escape_string($con, $_POST['MaHH']); // Bảo vệ khỏi SQL Injection
            $updateSql = "UPDATE hanghoa SET imagePath = '$path' WHERE MaHH = '$MaHH'";
            
            if (mysqli_query($con, $updateSql)) {
                echo "success";
            } else {
                echo "Lỗi cập nhật ảnh vào cơ sở dữ liệu";
            }
        } else {
            echo 'Lỗi khi lưu tệp ảnh.';
        }
    } else {
        echo 'Vui lòng chọn ảnh và nhập mã nhân viên.';
    }
} else {
    echo "Lỗi kết nối tới cơ sở dữ liệu";
}
?>