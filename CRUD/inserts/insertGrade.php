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
$ticket_number = $_POST['ticket_number'];
$grade_value = $_POST['grade_value'];
$student_ID = $_POST['student_ID'];
$subject_ID = $_POST['subject_ID'];
$teacher_ID = $_POST['teacher_ID'];

// Підготовка та виконання запиту для вставки даних
$sql = "INSERT INTO grade (id, created_at, ticket_number, grade_value, student_ID, subject_ID, teacher_ID) VALUES ('$id','$created_at', '$ticket_number', '$grade_value', '$student_ID', '$subject_ID', '$teacher_ID')";

if (mysqli_query($connection, $sql)) {
    echo "Нова оцінка успішно додана";
} else {
    echo "Помилка: " . $sql . "<br>" . mysqli_error($connection);
}

// Закриття з'єднання з базою даних
mysqli_close($connection);
?>
<form action="../../pages/table_pages/tableGrades.php" method="get">
        <input type="submit" value="Повернутися до таблиці">
    </form>
</body>
</html>
