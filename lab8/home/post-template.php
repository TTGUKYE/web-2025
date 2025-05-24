<?php
if (!isset($post, $user)) {
    return;
} ?>

<div class="post">
    <div>
        <img src="<?= htmlspecialchars(
            $user["avatar_src"] ?? ""
        ) ?>" class="avatar">
        <p><?= htmlspecialchars($user["username"] ?? "") ?></p>
    </div>

    <img src="<?= htmlspecialchars(
        $post["image"] ?? ""
    ) ?>" class="post-img" alt="Пост">

    <div class="likes">
        <img src="../src/assets/like.png" alt="Like">
        <span><?= htmlspecialchars($post["like_count"] ?? 0) ?></span>
    </div>

    <p><?= nl2br(htmlspecialchars($post["description"] ?? "")) ?></p>
    <span class="hint-text">...еще</span>
    <p class="hint-text"><?= htmlspecialchars(
        date("d M Y", strtotime($post["created_at"] ?? 0))
    ) ?></p>
</div>
