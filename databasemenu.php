<?php
$con = mysqli_connect("localhost", "root", "", "duan");
if ($con) {
    if (!empty($_POST['image']) && !empty($_POST['MaMn'])) {
        $path = 'img1/' . date("d-m-y") . '-' . time() . '-' . rand(10000, 100000) . '.jpg';
        
        if (file_put_contents($path, base64_decode($_POST['image']))) {
            $MaMn = mysqli_real_escape_string($con, $_POST['MaMn']); // Bảo vệ khỏi SQL Injection
            $updateSql = "UPDATE menu SET Hinhanh = '$path' WHERE MaMn = '$MaMn'";
            
            if (mysqli_query($con, $updateSql)) {
                echo "success";
            } else {
                echo "Lỗi cập nhật ảnh vào cơ sở dữ liệu";
            }
        } else {
            echo 'Lỗi khi lưu tệp ảnh.';
        }
    } else {
        echo 'Vui lòng chọn ảnh và nhập mã đồ uống.';
    }
} else {
    echo "Lỗi kết nối tới cơ sở dữ liệu";
}
?>
