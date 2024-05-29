<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
// Підключення до бази даних
$connection = mysqli_connect("localhost", "admin", "admin", "examGrades_db_3fn");

// Перевірка з'єднання
if (!$connection) {
    die("Помилка з'єднання: " . mysqli_connect_error());
}

// Перевірка, чи було відправлено дані форми
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Перевірка, чи масив delete містить значення
    if (isset($_POST['delete']) && is_array($_POST['delete'])) {
        // Приведення значень до цілочисельного типу для безпеки
        $delete_ids = array_map('intval', $_POST['delete']);
        
        // Формування рядка з ідентифікаторами, щоб використати в запиті SQL
        $ids = implode(',', $delete_ids);

        // SQL-запит на видалення записів з бази даних
        $sql = "DELETE FROM students WHERE id IN ($ids)";

        // Виконання SQL-запиту
        if (mysqli_query($connection, $sql)) {
            echo "Видалено обрані записи успішно";
        } else {
            echo "Помилка під час видалення: " . mysqli_error($connection);
        }
    } else {
        echo "Немає записів для видалення";
    }
}

// Закриття з'єднання з базою даних
mysqli_close($connection);
?>
<form action="../../pages/table_pages/tableStudents.php" method="get">
        <input type="submit" value="Повернутися до таблиці">
    </form>
</body>
</html>
