<!DOCTYPE html>
<html>
<head>
    <title>Проверка високосного года</title>
</head>
<body>
    <h2>Проверка года на високосность</h2>

    <form method="GET">
        Введите год:
        <input type="number" name="year" min="1" max="30000" required>
        <input type="submit" value="Проверить">
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] === "GET") {
        $year = isset($_GET["year"]) ? (int) $_GET["year"] : 0;
        function isLeapYear($year)
        {
            return ($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0;
        }
        echo "<h3>Результат:</h3>";
        if ($year >= 1 && $year <= 30000) {
            echo isLeapYear($year) ? "YES" : "NO";
        } else {
            echo "Ошибка: введите год от 1 до 30000";
        }
    } ?>
</body>
</html>
