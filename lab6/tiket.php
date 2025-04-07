<!DOCTYPE html>
<html>
<head>
    <title>Поиск счастливых билетов</title>
</head>
<body>
    <form method="GET">
        Начальный номер: <input type="text" name="start" required pattern="\d{6}"><br>
        Конечный номер: <input type="text" name="end" required pattern="\d{6}"><br>
        <input type="submit" value="Найти">
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] === "GET") {
        $start = $_GET["start"];
        $end = $_GET["end"];

        echo "<h3>Результаты для $start - $end:</h3>";

        for ($num = $start; $num <= $end; $num++) {
            $ticket = str_pad($num, 6, "0", STR_PAD_LEFT);
            $sum1 = $ticket[0] + $ticket[1] + $ticket[2];
            $sum2 = $ticket[3] + $ticket[4] + $ticket[5];

            if ($sum1 == $sum2) {
                echo $ticket . "<br>";
            }
        }
    } ?>
</body>
</html>
