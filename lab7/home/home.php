<?php
require_once "validation.php";

$data = json_decode(file_get_contents("data.json"), true);
$users = $data["users"] ?? [];
$posts = $data["posts"] ?? [];

if (empty($users) || empty($posts)) {
    die("Ошибка: Неверная структура JSON");
}

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
    foreach ($users as $user) {
        if ($user["id"] === $userId) {
            $selectedUser = $user;
            break;
        }
    }
    if (!$selectedUser) {
        header("Location: home.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>home</title>
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
        <div class="nav-item">
            <img src="../src/assets/plus.svg" alt="Plus" />
        </div>
    </div>

    <?php if ($selectedUser) { ?>
        <div class="userdata">
            <img
                src="<?= htmlspecialchars($selectedUser["avatar"]) ?>"
                alt="<?= htmlspecialchars($selectedUser["name"]) ?>"
                class="avatar"
            >
            <p class="text"><?= htmlspecialchars($selectedUser["name"]) ?></p>
        </div>

        <div >
            <?php
            $userPosts = array_filter(
                $posts,
                fn($post) => $post["user_id"] == $selectedUser["id"]
            );
            foreach ($userPosts as $post) {
                include "post-template.php";
            }
            ?>
        </div>
    <?php } else { ?>
        <div >
            <?php foreach ($users as $user) { ?>
                <div c>
                    <div class="userdata">
                        <img
                            src="<?= htmlspecialchars($user["avatar"]) ?>"
                            alt="<?= htmlspecialchars($user["name"]) ?>"
                            class="avatar"
                        >
                        <p class="text"><?= htmlspecialchars(
                            $user["name"]
                        ) ?></p>
                    </div>

                    <div >
                        <?php
                        $userPosts = array_filter(
                            $posts,
                            fn($post) => $post["user_id"] == $user["id"]
                        );
                        foreach ($userPosts as $post) {
                            include "post-template.php";
                        }
                        ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</body>
</html>
