<?php

$response = array();

try {
    require_once __DIR__ . '/db_config.php';

    $pdo = new PDO("mysql:host=" . DB_SERVER .";dbname=" . DB_DATABASE, DB_USER, DB_PASSWORD);

    $query = "SELECT DATE_FORMAT(Thoigian, '%Y') AS Nam, SUM(TongTien) AS DoanhThuNam
              FROM hoadon
              GROUP BY Nam
              ORDER BY Nam";
    $stmt = $pdo->query($query);

    if ($stmt->rowCount() > 0) {
        $response["doanhthunam"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $annualRevenue = array();
            $annualRevenue["Nam"] = $row["Nam"];
            $annualRevenue["DoanhThuNam"] = $row["DoanhThuNam"];

            array_push($response["doanhthunam"], $annualRevenue);
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