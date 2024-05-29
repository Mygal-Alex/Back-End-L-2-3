<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пошук студента за прізвищем</title>
</head>
<body>
    <h2>Пошук студента за групою</h2>
    <form action="../../../search/groupSearch.php" method="post">
        <label for="group_name">Група студента:</label>
        <input type="text" id="group_name" name="group_name" required><br><br>
        <input type="submit" value="Знайти студента">
    </form>
    <form action="../mainSearchPage.php" method="get">
    <input type="submit" value="Повернутися до головної сторінки пошуку">
</form>
</body>
</html>
