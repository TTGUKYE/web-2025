<?php
require_once "user-utils.php";
require_once "validation.php";

$userId = (int) ($_GET["id"] ?? 1);
$user = findUserById($userId);

if (!$user) {
    header("Location: profile.php");
    exit();
}

$posts = getUserPosts($userId);
$postsCount = count($posts);

$validationErrors = validateUserData([
    "username" => $user["username"],
    "description" => $user["description"],
]);

$description = $user["description"];
if (strlen($description) > 200) {
    $description = substr($description, 0, 200) . "...";
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
            <div class="dot"></div>
        </div>
        <div class="nav-item">
            <img src="../src/assets/profile.svg" alt="Profile" />
        </div>
        <div>
            <img src="../src/assets/plus.svg" alt="Plus" />
        </div>
    </div>

    <div class="profile">
        <img
            src="<?= htmlspecialchars($user["src"]) ?>"
            class="avatar"
            alt="Аватар"
        >
        <p class="name"><?= htmlspecialchars($user["username"]) ?></p>
        <p class="text"><?= htmlspecialchars($description) ?></p>
        <div class="counter">
            <span><?= $postsCount ?> постов</span>
        </div>

        <div>
            <?php foreach ($posts as $post): ?>
                <?php include "post-template.php"; ?>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
