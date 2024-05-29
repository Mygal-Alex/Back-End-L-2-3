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
            <th>Дата</th>
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
                echo "<td>" . $row["created_at"] . "</td>";
                echo "<td>" . $row["last_name"] . "</td>";
                echo "<td>" . $row["group_name"] . "</td>";
                echo "</tr>";

                // Форма для редагування студента
                echo "<tr>";
                echo "<td colspan='3'>";
                echo "<form action='../../../CRUD/update/updateStudent.php' method='post'>";
                echo "<input type='hidden' name='student_ID' value='" . $row['id'] . "'>"; // Приховане поле з ID студента
                echo "<label for='last_name'>Дата:</label>";
                echo "<input type='date' name='created_at' id='created_at' value='" . $row['created_at'] . "'><br>";
                echo "<label for='last_name'>Прізвище:</label>";
                echo "<input type='text' name='last_name' id='last_name' value='" . $row['last_name'] . "'><br>";
                echo "<label for='group_name'>Група:</label>";
                echo "<input type='text' name='group_name' id='group_name' value='" . $row['group_name'] . "'><br>";
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

    <form action="../../table_pages/tableStudents.php" method="get">
        <input type="submit" value="Повернутися до таблиці">
    </form>
</body>
</html>
