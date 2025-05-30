<?php
function validateUserData($user)
{
    $errors = [];
    if (strlen($user["username"] ?? "") < 3) {
        $errors[] = "Имя должно содержать минимум 3 символа.";
    }

    if (strlen($user["description"] ?? "") > 200) {
        $errors[] = "Описание не должно превышать 200 символов.";
    }

    return $errors;
}
