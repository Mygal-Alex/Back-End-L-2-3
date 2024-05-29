<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Деталі вчителя</title>
</head>
<body>
    <h1>Деталі вчителя</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Прізвище</th>
            <th>Ім'я</th>
        </tr>
        <?php
        // Підключення до бази даних
        $connection = mysqli_connect("localhost", "admin", "admin", "examGrades_db_3fn");

        // Перевірка з'єднання
        if (!$connection) {
            die("Помилка з'єднання: " . mysqli_connect_error());
        }

        // Отримання teacher_ID з URL
        $teacher_ID = $_GET['teacher_ID'];

        // Запит на вибірку даних про конкретного вчителя за його teacher_ID
        $sql = "SELECT * FROM teachers WHERE id = $teacher_ID";
        $result = mysqli_query($connection, $sql);

        // Перевірка результату запиту
        if (mysqli_num_rows($result) > 0) {
            // Виведення даних у вигляді таблиці
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["last_name"] . "</td>";
                echo "<td>" . $row["first_name"] . "</td>";
                echo "</tr>";

                // Форма для редагування вчителя
                echo "<tr>";
                echo "<td colspan='3'>";
                echo "<form action='../../../CRUD/update/updateTeacher.php' method='post'>";
                echo "<input type='hidden' name='teacher_ID' value='" . $row['id'] . "'>"; // Приховане поле з ID вчителя
                echo "<label for='last_name'>Прізвище:</label>";
                echo "<input type='text' name='last_name' id='last_name' value='" . $row['last_name'] . "'><br>";
                echo "<label for='first_name'>Ім'я:</label>";
                echo "<input type='text' name='first_name' id='first_name' value='" . $row['first_name'] . "'><br>";
                echo "<input type='submit' value='Зберегти зміни'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Немає даних у таблиці</td></tr>";
        }

        // Закриття з'єднання з базою даних
        mysqli_close($connection);
        ?>
    </table>

    <form action="../../table_pages/tableGrades.php" method="get">
        <input type="submit" value="Повернутися до таблиці">
    </form>
</body>
</html>
