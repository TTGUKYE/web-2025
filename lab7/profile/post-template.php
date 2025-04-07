<?php
if (!isset($post["image"])) {
    return;
}

$src = htmlspecialchars($post["image"] ?? "", ENT_QUOTES, "UTF-8");
?>

<div class="post">
    <img src="<?= $src ?>" alt="Пост" class="post-img">
</div>
