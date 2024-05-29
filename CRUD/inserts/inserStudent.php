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
$id = $_POST['id'];
$created_at = $_POST['created_at'];
$last_name = $_POST['last_name'];
$group_name = $_POST['group_name'];


// Підготовка та виконання запиту для вставки даних
$sql = "INSERT INTO students (id, created_at, last_name, group_name) VALUES ('$id', '$created_at', '$last_name', '$group_name')";

if (mysqli_query($connection, $sql)) {
    echo "нового студента успішно додано";
} else {
    echo "Помилка: " . $sql . "<br>" . mysqli_error($connection);
}

// Закриття з'єднання з базою даних
mysqli_close($connection);
?>
<form action="../../pages/table_pages/tableStudents.php" method="get">
    <input type="submit" value="Повернутися до таблиці">
</form>
</body>
</html>
