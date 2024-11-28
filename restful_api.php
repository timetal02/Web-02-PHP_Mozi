<?php
// Adatbázis kapcsolat
include_once 'database.php';

// A tartalom típus beállítása JSON válaszhoz
header("Content-Type: application/json");

// A kérésekhez szükséges metódusok engedélyezése
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));

if (count($request) < 1) {
    http_response_code(400);
    echo json_encode(["error" => "Tábla neve szükséges a kéréshez."]);
    exit();
}

$table = $request[0]; // Az első útvonalrész a tábla neve

// A RESTful műveletek kezelése
try {
    switch ($method) {
        case 'GET':
            // Lekérdezés
            $sql = "SELECT * FROM $table";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($results);
            break;

        case 'POST':
            // Adatok beszúrása
            $input = json_decode(file_get_contents("php://input"), true);
            $keys = implode(", ", array_keys($input));
            $placeholders = implode(", ", array_fill(0, count($input), '?'));
            $sql = "INSERT INTO $table ($keys) VALUES ($placeholders)";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array_values($input));
            echo json_encode(["success" => "Adatok sikeresen hozzáadva!"]);
            break;

        case 'PUT':
            // Adatok frissítése
            if (!isset($_GET['id'])) {
                http_response_code(400);
                echo json_encode(["error" => "ID szükséges a frissítéshez."]);
                exit();
            }
            $id = $_GET['id'];
            $input = json_decode(file_get_contents("php://input"), true);
            $fields = implode(" = ?, ", array_keys($input)) . " = ?";
            $sql = "UPDATE $table SET $fields WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([...array_values($input), $id]);
            echo json_encode(["success" => "Adatok sikeresen frissítve!"]);
            break;

        case 'DELETE':
            // Adatok törlése
            if (!isset($_GET['id'])) {
                http_response_code(400);
                echo json_encode(["error" => "ID szükséges a törléshez."]);
                exit();
            }
            $id = $_GET['id'];
            $sql = "DELETE FROM $table WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
            echo json_encode(["success" => "Adatok sikeresen törölve!"]);
            break;

        default:
            http_response_code(405);
            echo json_encode(["error" => "Nem támogatott HTTP-módszer."]);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
?>
