<?php
require_once "db.php";
require_once "validation.php";

// Проверка метода запроса
$method = $_SERVER["REQUEST_METHOD"];
if ($method !== "POST") {
    http_response_code(405);
    die("Доступ разрешен только для POST-запросов");
}

// Парсинг JSON данных
$json = file_get_contents("php://input");
$data = json_decode($json, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    die("Ошибка в формате данных");
}

// Валидация данных
if (
    !isset($data["user_id"], $data["image"], $data["description"]) ||
    !is_int($data["user_id"]) ||
    !is_string($data["image"]) ||
    !is_string($data["description"]) ||
    strlen($data["description"]) < 1
) {
    http_response_code(400);
    die("Некорректные данные");
}

// Обработка загрузки изображения
if ($_FILES["image"]["error"] === UPLOAD_ERR_OK) {
    $uploadDir = "../src/images/";
    $uploadFile = $uploadDir . basename($_FILES["image"]["username"]);

    // Проверка типа файла
    $allowedTypes = ["image/jpeg", "image/png"];
    $detectedType = mime_content_type($_FILES["image"]["tmp_name"]);

    if (!in_array($detectedType, $allowedTypes)) {
        http_response_code(400);
        die("Недопустимый формат изображения");
    }

    // Перемещение файла
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $uploadFile)) {
        http_response_code(500);
        die("Ошибка загрузки изображения");
    }

    $data["image"] = $uploadFile; // Сохраняем путь к изображению
} else {
    http_response_code(400);
    die("Изображение не загружено");
}

// Сохранение поста в БД
try {
    $stmt = $db->prepare("
        INSERT INTO posts (user_id, image, description, like_count, created_at)
        VALUES (?, ?, ?, ?, NOW())
    ");
    $stmt->execute([
        $data["user_id"],
        $data["image"],
        $data["description"],
        $data["like_count"] ?? 0,
    ]);
    echo "Пост успешно добавлен!";
} catch (PDOException $e) {
    http_response_code(500);
    die("Ошибка сохранения поста: " . $e->getMessage());
}
?>
