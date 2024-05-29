<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Виведення даних з таблиці бази даних на веб-сторінку</title>
</head>
<body>
    <h1>Дані з таблиці "students"</h1>
    <form action="../../CRUD/delete/deleteStudent.php" method="post">
        <table border="1">
            <tr>
                <th></th>
                <th>ID</th>
                <th>created_at</th>
                <th>last_name</th>
                <th>group_name</th>
            </tr>
            <?php
            // Підключення до бази даних
            $connection = mysqli_connect("localhost", "admin", "admin", "examGrades_db_3fn");

            // Перевірка з'єднання
            if (!$connection) {
                die("Помилка з'єднання: " . mysqli_connect_error());
            }

            // Запит на вибірку даних
            $sql = "SELECT * FROM students";
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
                    echo "<td><a href='../details_pages/table_details/studentDetails.php?id=" . $row["id"] . "'>" . $row["id"] . "</a></td>";
                    echo "<td>" . $row["created_at"] . "</td>";
                    echo "<td>" . $row["last_name"] . "</td>";
                    echo "<td>" . $row["group_name"] . "</td>";
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
    <h2>Додати нового студента</h2>
    <form action="../../CRUD/inserts/inserStudent.php" method="post">
        <label for="id">ID:</label>
        <input type="text" name="id" id="id" value="<?php echo $new_id; ?>" readonly><br>
        <label for="created_at">Дата створення:</label>
        <input type="date" name="created_at" id="created_at" value="<?php echo date('Y-m-d'); ?>"><br>
        <label for="last_name">Призвіще</label>
        <input type="text" name="last_name" id="last_name"><br>
        <label for="group_name">назва групи</label>
        <input type="text" name="group_name" id="group_name"><br>
        <input type="submit" value="Додати студента">
    </form>

    <form action="../../index.php" method="get">
        <input type="submit" value="Повернутися на головну">
    </form>
</body>
</html>
