<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Відсортовані дані з таблиці "grade"</title>
</head>
<body>
    <h1>Відсортовані дані з таблиці "grade"</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>ticket_number</th>
            <th>grade_value</th>
            <th>student_ID</th>
            <th>subject_ID</th>
            <th>teacher_ID</th>
        </tr>
        <?php
        // Підключення до бази даних
        $connection = mysqli_connect("localhost", "admin", "admin", "examGrades_db_3fn");

        // Перевірка з'єднання
        if (!$connection) {
            die("Помилка з'єднання: " . mysqli_connect_error());
        }

        // Запит на вибірку даних та сортування
        $sql = "SELECT * FROM grade ORDER BY grade_value DESC";
        $result = mysqli_query($connection, $sql);

        // Перевірка результату запиту
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["ticket_number"] . "</td>";
                echo "<td>" . $row["grade_value"] . "</td>";
                echo "<td>" . $row["student_ID"] . "</td>";
                echo "<td>" . $row["subject_ID"] . "</td>";
                echo "<td>" . $row["teacher_ID"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Немає даних у таблиці</td></tr>";
        }

        // Закриття з'єднання з базою даних
        mysqli_close($connection);
        ?>
    </table>
    <form action="../../pages/table_pages/tableGrades.php" method="get">
        <input type="submit" value="Повернутися до таблиці">
    </form>
</body>
</html>
