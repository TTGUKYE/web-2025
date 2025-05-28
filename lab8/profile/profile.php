// profile.php
<?php
include "db.php"; // Подключение к БД

// Получение ID пользователя из GET-параметра
$userId = (int) ($_GET["id"] ?? 1);

// Запрос данных пользователя
try {
    $stmt = $pdo->prepare("
        SELECT
            id,
            username AS name,
            about AS bio,
            avatar_src AS avatar
        FROM users
        WHERE id = ?
    ");
    $stmt->execute([$userId]);
    $selectedUser = $stmt->fetch();
} catch (PDOException $e) {
    die("Ошибка запроса: " . $e->getMessage());
}

// Если пользователь не найден
if (!$selectedUser) {
    header("Location: profile.php");
    exit();
}

// Получение количества постов пользователя
try {
    $stmt = $pdo->prepare("
        SELECT COUNT(*) AS posts_count
        FROM posts
        WHERE user_id = ?
    ");
    $stmt->execute([$userId]);
    $postsCount = $stmt->fetch()["posts_count"];
} catch (PDOException $e) {
    die("Ошибка запроса: " . $e->getMessage());
}

// Получение постов пользователя
try {
    $stmt = $pdo->prepare("
        SELECT image
        FROM posts
        WHERE user_id = ?
    ");
    $stmt->execute([$userId]);
    $posts = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
} catch (PDOException $e) {
    die("Ошибка запроса: " . $e->getMessage());
}

// Валидация данных
require "validation.php";
$errors = validateUserData($selectedUser);
if ($errors) {
    foreach ($errors as $error) {
        echo "<p>$error</p>";
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- ... (остальной HTML-код) ... -->
</head>
<body>
    <div class="profile">
        <img
            src="<?= htmlspecialchars($selectedUser["avatar"]) ?>"
            class="avatar"
            alt="Аватар"
        >
        <p class="name"><?= htmlspecialchars($selectedUser["name"]) ?></p>
        <p class="text"><?= htmlspecialchars($selectedUser["bio"]) ?></p>
        <div class="counter">
            <span><?= $postsCount ?> постов</span>
        </div>

        <div>
            <?php foreach ($posts as $image): ?>
                <div class="post">
                    <img
                        src="<?= htmlspecialchars($image) ?>"
                        alt="Пост"
                        class="post-img"
                    >
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
