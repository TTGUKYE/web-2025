<?php
require_once "validation.php";
require_once "db.php";

$db = connectDatabase();

$posts = $db->query("SELECT * FROM posts")->fetchAll(PDO::FETCH_ASSOC);

$userId = (int) ($_GET["id"] ?? 1);

if ($userId) {
    $userId = (int) $userId;
    $stmt = $db->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$userId]);
    $selectedUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$selectedUser) {
        header("Location: profile.php");
        exit();
    }

    // Загрузка постов выбранного пользователя
    $stmt = $db->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$userId]);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUser($userId)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">
</head>
<body>
    <div>
        <div class="nav-item">
            <img src="../src/assets/home.svg" alt="Home" />
        </div>
        <div class="nav-item">
            <img src="../src/assets/profile.svg" alt="Profile" />
            <div class="dot"></div>
        </div>
        <div>
            <img src="../src/assets/plus.svg" alt="Plus" />
        </div>
    </div>

    <div class="profile">
        <img
            src="<?= htmlspecialchars($selectedUser["avatar_src"]) ?>"
            class="avatar"
            alt="Аватар"
        >
        <p class="name"><?= htmlspecialchars($selectedUser["uname"]) ?></p>
        <p class="text"><?= htmlspecialchars(
            $selectedUser["description"]
        ) ?></p>
        <div class="counter">
            <span><?= $postsCount ?> постов</span>
        </div>

        <div>
            <?php foreach ($posts as $post): ?>
                <?php include "post-template.php"; ?>
            <?php endforeach; ?>
    </div>
</body>
</html>
