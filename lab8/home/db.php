<?php
function connectDatabase()
{
    $host = "localhost";
    $dbname = "blog";
    $username = "root";
    $password = "";

    try {
        $pdo = new PDO(
            "mysql:host=$host;dbname=$dbname;charset=utf8",
            $username,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );
        return $pdo;
    } catch (PDOException $e) {
        // Выводим полное сообщение об ошибке для отладки
        die("Ошибка подключения к базе данных: " . $e->getMessage());
    }
}

$db = connectDatabase();
?>
