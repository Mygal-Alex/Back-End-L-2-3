<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Деталі предмета</title>
</head>
<body>
    <h1>Деталі предмета</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Назва предмета</th>
        </tr>
        <?php
        // Підключення до бази даних
        $connection = mysqli_connect("localhost", "admin", "admin", "examGrades_db_3fn");

        // Перевірка з'єднання
        if (!$connection) {
            die("Помилка з'єднання: " . mysqli_connect_error());
        }

        // Отримання subject_ID з URL
        $subject_ID = $_GET['subject_ID'];

        // Запит на вибірку даних про конкретний предмет за його subject_ID
        $sql = "SELECT * FROM subjects_ WHERE id = $subject_ID";
        $result = mysqli_query($connection, $sql);

        // Перевірка результату запиту
        if (mysqli_num_rows($result) > 0) {
            // Виведення даних у вигляді таблиці та форми для редагування
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["subject_name"] . "</td>";
                echo "</tr>";

                // Форма для редагування предмета
                echo "<tr>";
                echo "<td colspan='2'>";
                echo "<form action='../../../CRUD/update/updateSubject.php' method='post'>";
                echo "<input type='hidden' name='subject_ID' value='" . $row['id'] . "'>"; // Приховане поле з ID предмета
                echo "<label for='subject_name'>Назва предмета:</label>";
                echo "<input type='text' name='subject_name' id='subject_name' value='" . $row['subject_name'] . "'><br>";
                echo "<input type='submit' value='Зберегти зміни'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>Немає даних у таблиці</td></tr>";
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
