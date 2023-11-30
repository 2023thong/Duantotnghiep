<?php

$response = array();

try {
    require_once __DIR__ . '/db_config.php';

    $pdo = new PDO("mysql:host=" . DB_SERVER .";dbname=" . DB_DATABASE, DB_USER, DB_PASSWORD);

    $query = "SELECT DATE_FORMAT(Thoigian, '%Y-%m') AS Thang, SUM(TongTien) AS DoanhThuThang
              FROM hoadon
              GROUP BY Thang
              ORDER BY Thang";
    $stmt = $pdo->query($query);

    if ($stmt->rowCount() > 0) {
        $response["doanhthuthang"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $monthlyRevenue = array();
            $monthlyRevenue["Thang"] = $row["Thang"];
            $monthlyRevenue["DoanhThuThang"] = $row["DoanhThuThang"];

            array_push($response["doanhthuthang"], $monthlyRevenue);
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