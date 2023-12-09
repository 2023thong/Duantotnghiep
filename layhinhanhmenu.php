<?php
// Thiết lập kết nối MySQL


$con = mysqli_connect("localhost", "root", "", "duan");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!empty($_GET['MaMn'])) {
    $MaMn = mysqli_real_escape_string($con, $_GET['MaMn']); // Sanitize input to prevent SQL injection

    $selectSql = "SELECT Hinhanh FROM menu WHERE MaMn = '$MaMn'";
    $result = mysqli_query($con, $selectSql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $imagePath = $row['Hinhanh'];
            // Check if the image file exists
            if (file_exists($imagePath)) {
                // Set the appropriate headers to indicate that this is an image
                header('Content-Type: image/jpeg');

                // Output the image data
                readfile($imagePath);
            } else {
                echo "Image not found";
            }
        } else {
            echo "No image found for the provided MaMn";
        }
    } else {
        echo "Database query error: " . mysqli_error($con);
    }
} else {
    echo "Missing MaMn parameter";
}

// Đóng kết nối MySQL sau khi hoàn tất
mysqli_close($con);
?>
