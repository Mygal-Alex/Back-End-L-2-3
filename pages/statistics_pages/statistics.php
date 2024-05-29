<?php
// Підключення до бази даних
$connection = mysqli_connect("localhost", "admin", "admin", "examGrades_db_3fn");

// Перевірка з'єднання
if (!$connection) {
    die("Помилка з'єднання: " . mysqli_connect_error());
}

// Запит на отримання ID найновішого студента
$sql_latest_student_id = "SELECT id FROM students ORDER BY created_at DESC LIMIT 1";
$result_latest_student_id = mysqli_query($connection, $sql_latest_student_id);
$row_latest_student_id = mysqli_fetch_assoc($result_latest_student_id);
$latest_student_id = $row_latest_student_id['id'];

// Запит на визначення загальної кількості записів у таблиці оцінок (grade)
$sql_grade_count = "SELECT COUNT(*) AS count FROM grade";
$result_grade_count = mysqli_query($connection, $sql_grade_count);
$row_grade_count = mysqli_fetch_assoc($result_grade_count);
$total_grade_records = $row_grade_count['count'];

// Запит на визначення загальної кількості записів у таблиці студентів (students)
$sql_students_count = "SELECT COUNT(*) AS count FROM students";
$result_students_count = mysqli_query($connection, $sql_students_count);
$row_students_count = mysqli_fetch_assoc($result_students_count);
$total_students_records = $row_students_count['count'];

// Запит на визначення кількості записів за останній місяць у таблиці оцінок (grade)
$sql_grade_last_month_count = "SELECT COUNT(*) AS count FROM grade WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
$result_grade_last_month_count = mysqli_query($connection, $sql_grade_last_month_count);
$row_grade_last_month_count = mysqli_fetch_assoc($result_grade_last_month_count);
$grade_last_month_records = $row_grade_last_month_count['count'];

// Запит на визначення кількості записів за останній місяць у таблиці студентів (students)
$sql_students_last_month_count = "SELECT COUNT(*) AS count FROM students WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
$result_students_last_month_count = mysqli_query($connection, $sql_students_last_month_count);
$row_students_last_month_count = mysqli_fetch_assoc($result_students_last_month_count);
$students_last_month_records = $row_students_last_month_count['count'];

// Запит для визначення студента з найбільшою кількістю оцінок
$sql_max_grades_student = "
    SELECT g.student_ID, COUNT(*) AS total_grades
    FROM grade g
    GROUP BY g.student_ID
    ORDER BY total_grades DESC
    LIMIT 1
";

$result_max_grades_student = mysqli_query($connection, $sql_max_grades_student);

// Перевірка результату запиту
if ($result_max_grades_student) {
    $row_max_grades_student = mysqli_fetch_assoc($result_max_grades_student);
    $max_grades_student_ID = $row_max_grades_student['student_ID'];
} else {
    // Обробка помилки
    echo "Помилка при визначенні студента з найбільшою кількістю оцінок: " . mysqli_error($connection);
}

// Запит для отримання інформації про студента з найбільшою кількістю оцінок
$sql_max_grades_student_info = "SELECT * FROM students WHERE id = $max_grades_student_ID";
$result_max_grades_student_info = mysqli_query($connection, $sql_max_grades_student_info);
$row_max_grades_student_info = mysqli_fetch_assoc($result_max_grades_student_info);

// Закриття з'єднання з базою даних
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Статистика веб-сайту</title>
</head>
<body>
    <h1>Статистика веб-сайту</h1>
    <p>Загальна кількість записів у таблиці оцінок (grade): <?php echo $total_grade_records; ?></p>
    <p>Загальна кількість записів у таблиці студентів (students): <?php echo $total_students_records; ?></p>
    <p>Кількість записів у таблиці оцінок (grade) за останній місяць: <?php echo $grade_last_month_records; ?></p>
    <p>Кількість записів у таблиці студентів (students) за останній місяць: <?php echo $students_last_month_records; ?></p>
    <p>Найновіший студент: <a href="../details_pages/statistics_details/lastStudentDetails.php?id=<?php echo $latest_student_id; ?>">Детальна інформація</a></p>
    <?php
    
    if ($row_max_grades_student_info) {
        echo "<p><a href='../details_pages/statistics_details/moreGradesStudentDetails.php?id=" . $max_grades_student_ID . "'>студент найбільшою кількістю оцінок</a></p>";
    }
    ?>
    <form action="../../index.php" method="get">
        <input type="submit" value="Повернутися на головну">
    </form>
</body>
</html>
