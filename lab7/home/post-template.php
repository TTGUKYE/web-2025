<?php
if (!isset($post)) {
    return;
}
$image = htmlspecialchars($post["image"] ?? "");
$likes = htmlspecialchars((string) ($post["likes"] ?? 0));
$content = nl2br(htmlspecialchars($post["content"] ?? ""));
$timestamp = date("d M Y H:i", $post["timestamp"] ?? 0);
?>

<div class="post">
    <img src="<?= $image ?>" class="post-img">
    <div class="likes">
        <img src="../src/assets/like.png" alt="Like">
        <span><?= $likes ?></span>
    </div>
    <p><?= $content ?></p>
                <span class="hint-text">...еще</span>
    <p class="hint-text"><?= $timestamp ?></p>
</div>
