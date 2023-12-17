<?php
// Thiết lập kết nối MySQL


$con = mysqli_connect("localhost", "root", "", "duan");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!empty($_GET['Id'])) {
    $Id = mysqli_real_escape_string($con, $_GET['Id']); // Sanitize input to prevent SQL injection

    $selectSql = "SELECT Anh FROM qr WHERE Id  = '$Id'";
    $result = mysqli_query($con, $selectSql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $Anh = $row['Anh'];

            // Check if the image file exists
            if (file_exists($Anh)) {
                // Set the appropriate headers to indicate that this is an image
                header('Content-Type: image/jpeg');
                // Output the image data
                readfile($Anh);
            } else {
                echo "Image not found";
            }
        } else {
            echo "No image found for the provided MaNv";
        }
    } else {
        echo "Database query error: " . mysqli_error($con);
    }
} else {
    echo "Missing MaNv parameter";
}

// Đóng kết nối MySQL sau khi hoàn tất
mysqli_close($con);
?>