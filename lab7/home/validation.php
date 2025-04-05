<?php
function validateUser($user)
{
    return isset($user["id"], $user["name"], $user["avatar"]) &&
        is_int($user["id"]) &&
        is_string($user["name"]) &&
        strlen($user["name"]) >= 3 &&
        is_string($user["avatar"]) &&
        strlen($user["avatar"]) >= 5;
}

function validatePost($post)
{
    return isset(
        $post["id"],
        $post["user_id"],
        $post["image"],
        $post["likes"],
        $post["timestamp"],
        $post["content"]
    ) &&
        is_int($post["id"]) &&
        is_int($post["user_id"]) &&
        is_string($post["image"]) &&
        strlen($post["image"]) >= 5 &&
        is_int($post["likes"]) &&
        is_numeric($post["timestamp"]) &&
        is_string($post["content"]) &&
        strlen($post["content"]) >= 1;
}
?>
