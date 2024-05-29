<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Деталі студента</title>
</head>
<body>
    <h1>Деталі студента</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Прізвище</th>
            <th>Група</th>
        </tr>
        <?php
        // Підключення до бази даних
        $connection = mysqli_connect("localhost", "admin", "admin", "examGrades_db_3fn");

        // Перевірка з'єднання
        if (!$connection) {
            die("Помилка з'єднання: " . mysqli_connect_error());
        }

        // Отримання student_id з URL
        $student_ID = $_GET['id'];

        // Запит на вибірку даних про конкретного студента за його student_id
        $sql = "SELECT * FROM students WHERE id = $student_ID";
        $result = mysqli_query($connection, $sql);

        // Перевірка результату запиту
        if (mysqli_num_rows($result) > 0) {
            // Виведення даних у вигляді таблиці
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["last_name"] . "</td>";
                echo "<td>" . $row["group_name"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Немає даних у таблиці</td></tr>";
        }

        // Закриття з'єднання з базою даних
        mysqli_close($connection);
        ?>
    </table>

    <form action="../../statistics_pages/statistics.php" method="get">
        <input type="submit" value="Повернутися до сторінки інформації">
    </form>
</body>
</html>
