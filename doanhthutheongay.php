<?php

$response = array();

try {
    require_once __DIR__ . '/db_config.php';

    $pdo = new PDO("mysql:host=" . DB_SERVER .";dbname=" . DB_DATABASE, DB_USER, DB_PASSWORD);

    $query = "SELECT DATE(Thoigian) AS Ngay, SUM(TongTien) AS DoanhThuNgay
              FROM hoadon
              GROUP BY DATE(Thoigian)
              ORDER BY Ngay";
    $stmt = $pdo->query($query);

    if ($stmt->rowCount() > 0) {
        $response["doanhthu"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $dailyRevenue = array();
            $dailyRevenue["Ngay"] = $row["Ngay"];
            $dailyRevenue["DoanhThuNgay"] = $row["DoanhThuNgay"];

            array_push($response["doanhthu"], $dailyRevenue);
        }
        $response["success"] = 1;
    } else {
        $response["success"] = 0;
        $response["message"] = "No revenue data found";
    }
} catch (PDOException $e) {
    $response["success"] = 0;
    $response["message"] = "Database Error: " . $e->getMessage();
}

echo json_encode($response);

?>
