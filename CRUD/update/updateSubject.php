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

// Отримання даних з форми редагування
$subject_ID = $_POST['subject_ID'];
$subject_name = $_POST['subject_name'];

// Запит на оновлення даних про предмет
$sql = "UPDATE subjects_ SET subject_name = '$subject_name' WHERE id = $subject_ID";

// Виконання запиту
if (mysqli_query($connection, $sql)) {
    echo "Дані про предмет успішно оновлено";
} else {
    echo "Помилка при оновленні даних про предмет: " . mysqli_error($connection);
}

// Закриття з'єднання з базою даних
mysqli_close($connection);
?>
<form action="../../pages/table_pages/tableGrades.php" method="get">
    <input type="submit" value="Повернутися до таблиці">
</form>
</body>
</html>
