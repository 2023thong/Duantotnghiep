<?php
/*
 * Following code will list all the products or a specific product by 'MaOder' value.
 */

// Array for JSON response
$response = array();

try {
    require_once __DIR__ . '/db_config.php';

    // Connecting to the database using PDO
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USER, DB_PASSWORD);

    // Check if 'maOder' parameter is set
    if (isset($_GET['MaOder'])) {
        $MaOder = $_GET['MaOder']; // Get the 'maOder' parameter from the URL

        // Get the products with the specified 'MaOder' value
        $query = "SELECT * FROM thongtinoder WHERE MaOder = :MaOder";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':MaOder', $MaOder, PDO::PARAM_INT);
        $stmt->execute();

        // Check for empty result
        if ($stmt->rowCount() > 0) {
            $response["chitietoder"] = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Temp user array
                $product = array();
                $product["Id"] = $row["Id"];
                $product["MaOder"] = $row["MaOder"];
                $product["TenDu"] = $row["TenDu"];
                $product["Soluong"] = $row["Soluong"];
                $product["Giatien"] = $row["Giatien"];
                $product["MaBn"] = $row["MaBn"];

                // Push single product into final response array
                array_push($response["chitietoder"], $product);
            }
            // Success
            $response["success"] = 1;
        } else {
            // No products found
            $response["success"] = 0;
            $response["message"] = "No products found for MaOder: " . $MaOder;
        }
    } else {
        // 'maOder' parameter is not set
        $response["success"] = 0;
        $response["message"] = "Parameter 'maOder' is missing.";
    }
} catch (PDOException $e) {
    // Error connecting to the database
    $response["success"] = 0;
    $response["message"] = "Database Error: " . $e->getMessage();
}

// Echoing JSON response
echo json_encode($response);
?>
