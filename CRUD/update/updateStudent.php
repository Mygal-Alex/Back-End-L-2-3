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

// Отримання даних з форми
$student_ID = $_POST['student_ID'];
$created_at = $_POST['created_at'];
$last_name = $_POST['last_name'];
$group_name = $_POST['group_name'];

// Запит на оновлення даних студента
$sql = "UPDATE students SET last_name='$last_name', group_name='$group_name', created_at='$created_at' WHERE id=$student_ID";

if (mysqli_query($connection, $sql)) {
    echo "Дані студента успішно оновлено";
} else {
    echo "Помилка оновлення даних студента: " . mysqli_error($connection);
}

// Закриття з'єднання з базою даних
mysqli_close($connection);
?>
<form action="../../pages/table_pages/tableStudents.php" method="get">
    <input type="submit" value="Повернутися до таблиці">
</form>
</body>
</html>
