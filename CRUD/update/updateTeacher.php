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

// Отримання даних з форми редагування вчителя
$teacher_ID = $_POST['teacher_ID'];
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];

// Запит на оновлення даних вчителя
$sql = "UPDATE teachers SET last_name='$last_name', first_name='$first_name' WHERE id=$teacher_ID";

// Виконання запиту
if (mysqli_query($connection, $sql)) {
    echo "Дані вчителя успішно оновлено.";
} else {
    echo "Помилка при оновленні даних вчителя: " . mysqli_error($connection);
}

// Закриття з'єднання з базою даних
mysqli_close($connection);
?>
<form action="../../pages/table_pages/tableGrades.php" method="get">
    <input type="submit" value="Повернутися до таблиці">
</form>
</body>
</html>
