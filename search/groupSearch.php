<?php
// Підключення до бази даних
$connection = mysqli_connect("localhost", "admin", "admin", "examGrades_db_3fn");

// Перевірка з'єднання
if (!$connection) {
    die("Помилка з'єднання: " . mysqli_connect_error());
}

// Отримання назви групи з форми
$group_name = $_POST['group_name'];

// Запит на вибірку даних про студентів за назвою групи
$sql = "SELECT * FROM students WHERE group_name LIKE '%$group_name%'";
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
    echo "<p>Студентів у групі \"$group_name\" не знайдено.</p>";
}

// Закриття з'єднання з базою даних
mysqli_close($connection);
?>
<form action="../../pages/search_pages/search_type_pages/groupSearchPage.php" method="get">
    <input type="submit" value="Повернутися до таблиці">
</form>
