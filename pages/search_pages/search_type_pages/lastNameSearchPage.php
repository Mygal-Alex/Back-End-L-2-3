<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пошук студента за прізвищем</title>
</head>
<body>
    <h2>Пошук студента за прізвищем</h2>
    <form action="../../../search/lastNameSearch.php" method="post">
        <label for="last_name">Прізвище студента:</label>
        <input type="text" id="last_name" name="last_name" required><br><br>
        <input type="submit" value="Знайти студента">
    </form>
    <form action="../mainSearchPage.php" method="get">
    <input type="submit" value="Повернутися до головної сторінки пошуку">
</form>
</body>
</html>
