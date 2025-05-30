<?php
include "db.php";

function findUserById($id)
{
    global $pdo;
    try {
        $stmt = $pdo->prepare(
            "SELECT id, username, about AS description, avatar_src AS src FROM users WHERE id = ?"
        );
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Ошибка подключения к базе данных: " . $e->getMessage());
    }
}

function getUserPosts($userId)
{
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT image FROM posts WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Ассоциативный массив
    } catch (PDOException $e) {
        die("Ошибка подключения к базе данных: " . $e->getMessage());
    }
}
?>
