<?php
function validateUser($user)
{
    return isset($user["id"], $user["username"], $user["avatar_src"]) &&
        is_numeric($user["id"]) &&
        strlen($user["username"]) >= 3 &&
        !empty($user["avatar_src"]);
}

function validatePost($post)
{
    return isset(
        $post["id"],
        $post["user_id"],
        $post["image"],
        $post["description"]
    ) &&
        is_numeric($post["id"]) &&
        is_numeric($post["user_id"]) &&
        !empty($post["image"]) &&
        !empty($post["description"]);
}
