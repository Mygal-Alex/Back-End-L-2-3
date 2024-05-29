<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Виведення даних з таблиці бази даних на веб-сторінку</title>
</head>
<body>
    <h1>Дані з таблиці "grade"</h1>
    <form action="../../CRUD/delete/deleteGrade.php" method="post">
        <table border="1">
            <tr>
                <th></th>
                <th>ID</th>
                <th>created_at</th>
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

            // Запит на вибірку даних
            $sql = "SELECT * FROM grade";
            $result = mysqli_query($connection, $sql);

            // Перевірка результату запиту
            if (mysqli_num_rows($result) > 0) {
                // Визначення максимального значення ID
                $max_id = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row["id"] > $max_id) {
                        $max_id = $row["id"];
                    }
                    echo "<tr>";
                    echo "<td><input type='checkbox' name='delete[]' value='".$row["id"]."'></td>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["created_at"] . "</td>";
                    echo "<td>" . $row["ticket_number"] . "</td>";
                    echo "<td>" . $row["grade_value"] . "</td>";
                    echo "<td>" . $row["student_ID"] . "</td>";
                    echo "<td><a href='../details_pages/table_details/subjectDetails.php?subject_ID=" . $row["subject_ID"] . "'>" . $row["subject_ID"] . "</a></td>";
                    echo "<td><a href='../details_pages/table_details/teacherDetails.php?teacher_ID=" . $row["teacher_ID"] . "'>" . $row["teacher_ID"] . "</a></td>";
                    echo "</tr>";
                }
                // Збільшення ID на 1 для нового запису
                $new_id = $max_id + 1;
            } else {
                echo "<tr><td colspan='7'>Немає даних у таблиці</td></tr>";
                $new_id = 1; // Якщо таблиця порожня, встановлюємо ID на 1
            }

            // Закриття з'єднання з базою даних
            mysqli_close($connection);
            ?>
        </table>
        <input type="submit" value="Видалити обрані записи">
    </form>

    <!-- Форма для додавання нового запису -->
    <h2>Додати нову оцінку</h2>
    <form action="../../CRUD/inserts/insertGrade.php" method="post">
        <label for="id">ID:</label>
        <input type="text" name="id" id="id" value="<?php echo $new_id; ?>" readonly><br>
        <label for="created_at">Дата створення:</label>
        <input type="date" name="created_at" id="created_at" value="<?php echo date('Y-m-d'); ?> " ><br>
        <label for="ticket_number">Номер білету:</label>
        <input type="text" name="ticket_number" id="ticket_number"><br>
        <label for="grade_value">Оцінка:</label>
        <input type="text" name="grade_value" id="grade_value"><br>
        <label for="student_ID">ID студента:</label>
        <input type="text" name="student_ID" id="student_ID"><br>
        <label for="subject_ID">ID предмету:</label>
        <input type="text" name="subject_ID" id="subject_ID"><br>
        <label for="teacher_ID">ID викладача:</label>
        <input type="text" name="teacher_ID" id="teacher_ID"><br>
        <input type="submit" value="Додати оцінку">
    </form>

    <!-- Кнопка для переходу на сторінку з відсортованими даними -->
    <form action="../../CRUD/sort/sortedGrade.php" method="get">
        <input type="submit" value="Перейти на сторінку з відсортованими даними">
    </form>
    <form action="../../index.php" method="get">
        <input type="submit" value="Повернутися на головну">
    </form>
</body>
</html>
