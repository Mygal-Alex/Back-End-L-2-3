<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пошук студентів за діапазоном created_at</title>
</head>
<body>
    <h1>Пошук студентів за діапазоном created_at</h1>
    <form action="../../../search/createdSearcht.php" method="post">
        <label for="start_date">Початкова дата:</label>
        <input type="date" id="start_date" name="start_date" required><br><br>
        <label for="end_date">Кінцева дата:</label>
        <input type="date" id="end_date" name="end_date" required><br><br>
        <input type="submit" value="Шукати">
    </form>
<form action="../mainSearchPage.php" method="get">
    <input type="submit" value="Повернутися до головної сторінки пошуку">
</form>
</body>
</html>
