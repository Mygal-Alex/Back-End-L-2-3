<?php
// Підключення до бази даних
$connection = mysqli_connect("localhost", "admin", "admin", "examGrades_db_3fn");

// Перевірка з'єднання
if (!$connection) {
    die("Помилка з'єднання: " . mysqli_connect_error());
}

// Отримання початкової та кінцевої дат з форми
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

// Запит на вибірку даних про студентів за діапазоном created_at
$sql = "SELECT * FROM students WHERE created_at BETWEEN '$start_date' AND '$end_date'";
$result = mysqli_query($connection, $sql);

// Перевірка результату запиту
if (mysqli_num_rows($result) > 0) {
    // Виведення даних у вигляді таблиці
    echo "<h2>Результати пошуку:</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>created_at</th><th>Прізвище</th><th>Група</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["created_at"] . "</td>";
        echo "<td>" . $row["last_name"] . "</td>";
        echo "<td>" . $row["group_name"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>Студентів у заданому діапазоні created_at не знайдено.</p>";
}

// Закриття з'єднання з базою даних
mysqli_close($connection);
?>
<form action="../../pages/search_pages/search_type_pages/createdSearchtPage.php" method="get">
    <input type="submit" value="Повернутися до таблиці">
</form>
