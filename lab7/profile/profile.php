<?php
$data = json_decode(file_get_contents("data.json"), true);
$users = $data["users"] ?? [];

$userId = (int) ($_GET["id"] ?? 1);

foreach ($users as $user) {
    if ($user["id"] === $userId) {
        $selectedUser = $user;
        break;
    }
}

if (!$selectedUser) {
    header("Location: profile.php");
    exit();
}

require "validation.php";
$errors = validateUserData($selectedUser);
if ($errors) {
    echo "<div style='color: red'>";
    foreach ($errors as $error) {
        echo "<p>$error</p>";
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title><?= htmlspecialchars($selectedUser["name"]) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">
</head>
<body>
    <!Навигация
    <div class="nav">
        <div class="nav-item">
            <a href="home.php">
                <img src="../src/assets/home.svg" alt="Home">
            </a>
        </div>
        <div class="nav-item">
            <img src="../src/assets/profile.svg" alt="Profile">
            <div class="dot"></div>
        </div>
        <div class="nav-item">
            <img src="../src/assets/plus.svg" alt="Plus">
        </div>
    </div>

    <div class="profile">
        <img src="<?= htmlspecialchars(
            $selectedUser["avatar"]
        ) ?>" class="avatar">
        <p class="name"><?= htmlspecialchars($selectedUser["name"]) ?></p>
        <p class="text"><?= htmlspecialchars($selectedUser["bio"]) ?></p>
        <div class="counter">
            <span><?= $selectedUser["posts_count"] ?> постов</span>
        </div>

        <div>
            <?php foreach ($selectedUser["posts"] as $image) { ?>
                <?php
                $post = ["image" => $image];
                include "post-template.php";
                ?>
            <?php } ?>
        </div>
    </div>
</body>
</html>
