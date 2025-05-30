<?php
require_once "db.php";
require_once "validation.php";

header("Content-Type: application/json");

// Проверка метода запроса
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode([
        "status" => "error",
        "message" => "Only POST method is allowed",
    ]);
    exit();
}

// Обработка данных формы
$user_id = $_POST["user_id"] ?? null;
$description = $_POST["description"] ?? null;
$image = $_FILES["image"] ?? null;

// Валидация входящих данных
$errors = [];

if (empty($user_id)) {
    $errors[] = "User ID is required";
} elseif (!is_numeric($user_id)) {
    $errors[] = "User ID must be a number";
}

if (empty($description)) {
    $errors[] = "Description is required";
}

if (empty($image)) {
    $errors[] = "Image is required";
} elseif ($image["error"] !== UPLOAD_ERR_OK) {
    $errors[] = "File upload error: " . $image["error"];
} else {
    // Проверка типа файла
    $allowed_types = ["image/jpeg", "image/png", "image/gif"];
    $detected_type = mime_content_type($image["tmp_name"]);

    if (!in_array($detected_type, $allowed_types)) {
        $errors[] = "Invalid file type. Allowed: JPEG, PNG, GIF";
    }
}

// Если есть ошибки - возвращаем их
if (!empty($errors)) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Validation failed",
        "errors" => $errors,
    ]);
    exit();
}

// Сохранение изображения
$upload_dir = __DIR__ . "/../src/images/posts/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

$extension = pathinfo($image["name"], PATHINFO_EXTENSION);
$filename = "post_" . uniqid() . "." . $extension;
$filepath = $upload_dir . $filename;

if (!move_uploaded_file($image["tmp_name"], $filepath)) {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Failed to save image",
    ]);
    exit();
}

// Сохранение в БД
try {
    $db = connectDatabase();
    $stmt = $db->prepare("
        INSERT INTO posts
        (user_id, description, image, like_count, created_at)
        VALUES (:user_id, :description, :image, 0, NOW())
    ");

    $image_path = "images/posts/" . $filename;

    $stmt->execute([
        ":user_id" => (int) $user_id,
        ":description" => $description,
        ":image" => $image_path,
    ]);

    $post_id = $db->lastInsertId();

    echo json_encode([
        "status" => "success",
        "message" => "Post created successfully",
        "post_id" => $post_id,
        "image_path" => $image_path,
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Database error: " . $e->getMessage(),
    ]);
}
?>
