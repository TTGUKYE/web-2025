<!DOCTYPE html>
<html>
<head>
    <title>Факториал числа</title>
</head>
<body>
    <form method="POST">
        Введите число:
        <input type="number" name="number" min="0" required>
        <input type="submit" value="Вычислить">
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $number = (int) ($_POST["number"] ?? 0);

        function factorial($n)
        {
            if ($n <= 1) {
                return 1;
            }
            return $n * factorial($n - 1);
        }

        $result = factorial($number);
        echo "<h3>Факториал числа $number: $result</h3>";
    } ?>
</body>
</html>
