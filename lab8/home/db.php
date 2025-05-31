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
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //При ошибках PDO будет выбрасывать исключения (удобно для отладки).
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //Результаты запросов возвращаются в виде ассоциативных массивов (например, $row['id'])
                PDO::ATTR_EMULATE_PREPARES => false, //Отключает эмуляцию подготовленных запросов, что повышает безопасность.
            ]
        );
        return $pdo;
    } catch (PDOException $e) {
        die("Ошибка подключения к базе данных: " . $e->getMessage());
    }
}

$db = connectDatabase();
?>
