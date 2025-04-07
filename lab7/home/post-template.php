<?php
if (!isset($post) || !is_array($post)) {
    return; // Если переменная $post не установлена или не является массивом, ничего не выводим
}

$image = htmlspecialchars($post["image"] ?? "", ENT_QUOTES, "UTF-8");
$likes = htmlspecialchars((string) ($post["likes"] ?? 0), ENT_QUOTES, "UTF-8");
$content = pre(htmlspecialchars($post["content"] ?? "", ENT_QUOTES, "UTF-8"));
$timestamp = htmlspecialchars(
    date("d M Y H:i", (int) ($post["timestamp"] ?? 0)),
    ENT_QUOTES,
    "UTF-8"
);
?>

<div class="post">
    <img src="<?= $image ?>" alt="Пост" class="post-img">
    <p>1/3</p>

    <div class="likes">
        <img src="../src/assets/like.png" alt="Like">
        <span><?= $likes ?></span>
    </div>

    <p><?= $content ?></p>
    <span class="hint-text">...еще</span>
    <p class="hint-text"><?= $timestamp ?></p>
</div>
