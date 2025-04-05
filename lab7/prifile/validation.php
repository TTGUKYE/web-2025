<?php
// validation.php

function validateUserData($user)
{
    $errors = [];

    // Проверка имени
    if (strlen($user["name"] ?? "") < 3) {
        $errors[] = "Имя должно содержать минимум 3 символа.";
    }

    // Проверка описания
    if (strlen($user["bio"] ?? "") > 200) {
        $errors[] = "Описание не должно превышать 200 символов.";
    }

    // Проверка ID
    if (!is_numeric($user["id"] ?? "")) {
        $errors[] = "ID должен быть числом.";
    }

    return $errors;
}
