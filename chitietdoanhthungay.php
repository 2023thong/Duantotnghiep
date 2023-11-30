<?php
$response = array();

try {
    require_once __DIR__ . '/db_config.php';
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USER, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Lấy ngày từ tham số truyền vào hoặc sử dụng ngày hiện tại nếu không có tham số
    $selectedDate = isset($_GET['selected_date']) ? $_GET['selected_date'] : date('Y-m-d');

    $query = "SELECT Maoder, SUM(TongTien) AS TongTien FROM hoadon WHERE Thoigian = :selected_date GROUP BY Maoder";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':selected_date', $selectedDate);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $response["doanhthu"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $orderData = array();
            $orderData["Maoder"] = $row["Maoder"];
            $orderData["TongTien"] = $row["TongTien"];
            array_push($response["doanhthu"], $orderData);
        }

        $response["thanhcong"] = 1;
    } else {
        $response["thanhcong"] = 0;
        $response["message"] = "Không tìm thấy dữ liệu đơn hàng cho ngày đã chọn";
    }
} catch (PDOException $e) {
    $response["thanhcong"] = 0;
    $response["message"] = "Lỗi cơ sở dữ liệu: " . $e->getMessage();
}

echo json_encode($response);
?>