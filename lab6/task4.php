<!DOCTYPE html>
<html>
<head>
    <title>Определение знака зодиака</title>
</head>
<body>
    <form method="GET" action="">
        <label for="date">Введите дату рождения:</label><br>
        <input type="text" id="date" name="date" placeholder="Пример: 15 марта или 03.15">
        <button type="submit">Узнать знак</button>
    </form>
<?php
function zodiacSign($day, $month)
{
    if (($month == 1 && $day >= 20) || ($month == 2 && $day <= 18)) {
        return "Водолей";
    }
    if (($month == 2 && $day >= 19) || ($month == 3 && $day <= 20)) {
        return "Рыбы";
    }
    if (($month == 3 && $day >= 21) || ($month == 4 && $day <= 19)) {
        return "Овен";
    }
    if (($month == 4 && $day >= 20) || ($month == 5 && $day <= 20)) {
        return "Телец";
    }
    if (($month == 5 && $day >= 21) || ($month == 6 && $day <= 20)) {
        return "Близнецы";
    }
    if (($month == 6 && $day >= 21) || ($month == 7 && $day <= 22)) {
        return "Рак";
    }
    if (($month == 7 && $day >= 23) || ($month == 8 && $day <= 22)) {
        return "Лев";
    }
    if (($month == 8 && $day >= 23) || ($month == 9 && $day <= 22)) {
        return "Дева";
    }
    if (($month == 9 && $day >= 23) || ($month == 10 && $day <= 22)) {
        return "Весы";
    }
    if (($month == 10 && $day >= 23) || ($month == 11 && $day <= 21)) {
        return "Скорпион";
    }
    if (($month == 11 && $day >= 22) || ($month == 12 && $day <= 21)) {
        return "Стрелец";
    }
    if (($month == 12 && $day >= 22) || ($month == 1 && $day <= 19)) {
        return "Козерог";
    }
    return "Неверная дата";
}

function parseDate($dateStr)
{
    $months = [
        "января" => 1,
        "февраля" => 2,
        "марта" => 3,
        "апреля" => 4,
        "мая" => 5,
        "июня" => 6,
        "июля" => 7,
        "августа" => 8,
        "сентября" => 9,
        "октября" => 10,
        "ноября" => 11,
        "декабря" => 12,
    ];

    $dateStr = strtolower(trim($dateStr)); // Приведение к нижнему регистру и удаление пробелов

    // Добавляем поддержку новых разделителей
    foreach ([".", "/", "-", " ", ",", "I", "_", "\\", ":"] as $delimiter) {
        if (strpos($dateStr, $delimiter) !== false) {
            $parts = explode($delimiter, $dateStr);
            break;
        }
    }

    if (count($parts) < 2) {
        return ["Ошибка", "Ошибка"];
    }

    $day = intval($parts[0]);
    $month = is_numeric($parts[1])
        ? intval($parts[1])
        : $months[strtolower($parts[1])] ?? null;

    if (!$month) {
        return ["Ошибка", "Ошибка"];
    }

    return [$day, $month];
}

$date = $_GET["date"];

if (empty($date)) {
    echo "Поле даты не может быть пустым! Введите дату.";
} else {
    list($day, $month) = parseDate($date);
    if ($day === "Ошибка" || $month === "Ошибка") {
        echo "Неверный формат даты! Попробуйте снова.";
    } else {
        echo "Ваш знак зодиака: " . zodiacSign($day, $month);
    }
}

?>
