<?php
// Подключение валидации
require_once "validation.php";

// Загрузка данных из JSON
$data = json_decode(file_get_contents("data.json"), true);

// Проверяем, что данные существуют
if (!isset($data["users"]) || !isset($data["posts"])) {
    die("Ошибка: Некорректные данные в JSON.");
}

$users = $data["users"];
$posts = $data["posts"];

// Проверка данных пользователей
foreach ($users as $user) {
    if (!validateUser($user)) {
        die("Ошибка валидации данных пользователя: " . json_encode($user));
    }
}

// Проверка данных постов
foreach ($posts as $post) {
    if (!validatePost($post)) {
        die("Ошибка валидации данных поста: " . json_encode($post));
    }
}

// Поиск пользователя по ID
function findUserById($users, $id)
{
    foreach ($users as $user) {
        if (isset($user["id"]) && $user["id"] === $id) {
            return $user;
        }
    }
    return null;
}

// Фильтрация постов по ID пользователя
function filterPostsByUser($posts, $userId)
{
    return array_filter($posts, function ($post) use ($userId) {
        return isset($post["user_id"]) && $post["user_id"] === $userId;
    });
}

// Валидация параметров
$userId = isset($_GET["id"]) ? (int) $_GET["id"] : 1;

// Находим выбранного пользователя
$selectedUser = findUserById($users, $userId);

// Если пользователь не найден, выбираем первого
if (!$selectedUser) {
    $selectedUser = $users[0] ?? [];
}

// Получаем посты выбранного пользователя
$userPosts = filterPostsByUser($posts, $selectedUser["id"] ?? 0);
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>
        <?= htmlspecialchars(
            $selectedUser["name"] ?? "Пользователь не найден",
            ENT_QUOTES,
            "UTF-8"
        ) ?>
    </title>
    <link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="nav">
        <div class="nav-item">
            <img src="../src/assets/home.svg" alt="Home">
            <div class="dot"></div>
        </div>
        <div class="nav-item">
            <a href="?id=1">
                <img src="../src/assets/profile.svg" alt="Profile">
            </a>
        </div>
        <div class="nav-item">
            <img src="../src/assets/plus.svg" alt="Plus">
        </div>
    </div>

    <!Блок пользователя
    <div class="userdata">
        <div>
            <img
                src="<?= htmlspecialchars(
                    $selectedUser["avatar"] ?? "",
                    ENT_QUOTES,
                    "UTF-8"
                ) ?>"
                alt="<?= htmlspecialchars(
                    $selectedUser["name"] ?? "Аватар не найден",
                    ENT_QUOTES,
                    "UTF-8"
                ) ?>"
                class="avatar"
            >
            <p class="text">
                <?= htmlspecialchars(
                    $selectedUser["name"] ?? "Пользователь не найден",
                    ENT_QUOTES,
                    "UTF-8"
                ) ?>
            </p>
        </div>
        <img src="../src/assets/edit.svg" alt="Edit" class="edit">
    </div>

    <!Список постов
    <?php foreach ($userPosts as $post) {
        include "post-template.php";
    } ?>
</body>
</html>
