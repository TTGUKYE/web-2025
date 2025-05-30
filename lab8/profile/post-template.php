<?php
$src = $post["image"] ?? "";
if (!empty($src)): ?>
    <div class="post">
        <img src="<?= htmlspecialchars($src) ?>" alt="Пост" class="post-img">
    </div>
<?php endif; ?>
