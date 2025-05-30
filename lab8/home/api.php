<?php
require_once "db.php";
require_once "validation.php";

header("Content-Type: application/json");

$method = $_SERVER["REQUEST_METHOD"];
if ($method !== "POST") {
    http_response_code(405);
    echo json_encode([
        "status" => "error",
        "message" => "Only POST method is allowed",
    ]);
    exit();
}

// Обработка multipart/form-data
$data = [
    "user_id" => $_POST["user_id"] ?? null,
    "description" => $_POST["description"] ?? null,
];

// Обработка файла изображения
$imagePath = null;
if (!empty($_FILES["image"])) {
    $image = $_FILES["image"];

    // Проверка ошибок загрузки
    if ($image["error"] !== UPLOAD_ERR_OK) {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "message" => "File upload error: " . $image["error"],
        ]);
        exit();
    }

    // Проверка типа файла
    $allowedTypes = ["image/jpeg", "image/png", "image/gif"];
    $detectedType = mime_content_type($image["tmp_name"]);

    if (!in_array($detectedType, $allowedTypes)) {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "message" => "Invalid file type. Allowed: JPEG, PNG, GIF",
        ]);
        exit();
    }

    // Генерация уникального имени файла
    $extension = pathinfo($image["name"], PATHINFO_EXTENSION);
    $filename = uniqid("post_") . "." . $extension;
    $uploadDir = __DIR__ . "/../src/images/";
    $uploadFile = $uploadDir . $filename;

    // Сохранение файла
    if (!move_uploaded_file($image["tmp_name"], $uploadFile)) {
        http_response_code(500);
        echo json_encode([
            "status" => "error",
            "message" => "Failed to save image",
        ]);
        exit();
    }

    $imagePath = "../src/images/" . $filename;
    $data["image"] = $imagePath;
}

// Валидация данных
$errors = [];
if (empty($data["user_id"])) {
    $errors[] = "User ID is required";
}
if (empty($data["description"])) {
    $errors[] = "Description is required";
}
if (empty($data["image"])) {
    $errors[] = "Image is required";
}

if (!empty($errors)) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Validation failed",
        "errors" => $errors,
    ]);
    exit();
}

// Сохранение в БД
try {
    $stmt = $db->prepare("
        INSERT INTO posts
        (user_id, description, image, like_count, created_at)
        VALUES (:user_id, :description, :image, :like_count, NOW())
    ");

    $stmt->execute([
        ":user_id" => (int) $data["user_id"],
        ":description" => $data["description"],
        ":image" => $data["image"],
        ":like_count" => $_POST["like_count"] ?? 0,
    ]);

    $postId = $db->lastInsertId();

    echo json_encode([
        "status" => "success",
        "message" => "Post created successfully",
        "post_id" => $postId,
        "image_path" => $data["image"],
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Database error: " . $e->getMessage(),
    ]);
}
?>
