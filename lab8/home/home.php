<?php
require_once "validation.php";
require_once "db.php";

$db = connectDatabase();

$users = $db->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
$posts = $db->query("SELECT * FROM posts")->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $user) {
    if (!validateUser($user)) {
        die("Ошибка валидации пользователя: " . json_encode($user));
    }
}

foreach ($posts as $post) {
    if (!validatePost($post)) {
        die("Ошибка валидации поста: " . json_encode($post));
    }
}

$userId = $_GET["id"] ?? null;
$selectedUser = null;

if ($userId) {
    $userId = (int) $userId;
    $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $selectedUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$selectedUser) {
        header("Location: home.php");
        exit();
    }

    // Загрузка постов выбранного пользователя
    $stmt = $db->prepare("SELECT * FROM posts WHERE user_id = ?");
    $stmt->execute([$userId]);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUser($userId)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="styles.css" />
        <title>Home</title>
        <link href="https://fonts.gstatic.com" />
        <link
            href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap"
            rel="stylesheet"
        />
    </head>
<body>
    <div class="navigation">
        <div class="nav-item">
            <a href="home.php">
                <img src="../src/assets/home.svg" alt="Главная">
            </a>
            <div class="dot"></div>
        </div>
        <div class="nav-item">
            <img src="../src/assets/profile.svg" alt="Профиль">
        </div>
        <div class="nav-item">
            <img src="../src/assets/plus.svg" alt="Добавить">
        </div>
    </div>

    <?php foreach ($posts as $post) {
        $user = getUser($post["user_id"]);
        include "post-template.php";
    } ?>
</body>
</html>
