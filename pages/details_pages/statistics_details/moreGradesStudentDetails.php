<?php
// Підключення до бази даних
$connection = mysqli_connect("localhost", "admin", "admin", "examGrades_db_3fn");

// Перевірка з'єднання
if (!$connection) {
    die("Помилка з'єднання: " . mysqli_connect_error());
}

// Отримання ID студента з URL
$student_ID = $_GET['id'];

// Запит на вибірку даних про конкретного студента за його ID
$sql_student_info = "SELECT * FROM students WHERE id = $student_ID";
$result_student_info = mysqli_query($connection, $sql_student_info);

// Перевірка результату запиту
if (mysqli_num_rows($result_student_info) > 0) {
    // Виведення даних про студента
    echo "<h2>Інформація про студента:</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Прізвище</th><th>Група</th></tr>";
    while ($row = mysqli_fetch_assoc($result_student_info)) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["last_name"] . "</td><td>" . $row["group_name"] . "</td></tr>";
    }
    echo "</table>";

    // Запит на отримання оцінок студента
    $sql_student_grades = "SELECT * FROM grade WHERE student_ID = $student_ID";
    $result_student_grades = mysqli_query($connection, $sql_student_grades);

    // Перевірка результату запиту
    if (mysqli_num_rows($result_student_grades) > 0) {
        // Виведення даних про оцінки студента
        echo "<h2>Оцінки студента:</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Предмет</th><th>Оцінка</th><th>Дата створення</th></tr>";
        while ($row = mysqli_fetch_assoc($result_student_grades)) {
            // Отримання назви предмету за його ID
            $subject_ID = $row["subject_ID"];
            $sql_subject_name = "SELECT subject_name FROM subjects_ WHERE id = $subject_ID";
            $result_subject_name = mysqli_query($connection, $sql_subject_name);
            $row_subject_name = mysqli_fetch_assoc($result_subject_name);
            $subject_name = $row_subject_name['subject_name'];

            echo "<tr><td>" . $row["id"] . "</td><td>" . $subject_name . "</td><td>" . $row["grade_value"] . "</td><td>" . $row["created_at"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Студент не має жодних оцінок</p>";
    }
} else {
    echo "Немає даних про студента";
}

// Закриття з'єднання з базою даних
mysqli_close($connection);
?>
<form action="../../statistics_pages/statistics.php" method="get">
    <input type="submit" value="Повернутися до сторінки інформації">
</form>
