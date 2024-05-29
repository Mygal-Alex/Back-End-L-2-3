<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>main search page</h1>
    <form action="./search_type_pages/lastNameSearchPage.php" method="get">
        <input type="submit" value="пошук студента за прізвищем">
    </form>
    <form action="./search_type_pages/groupSearchPage.php" method="get">
        <input type="submit" value="пошук студентів за групою">
    </form>
    <form action="./search_type_pages/createdSearchtPage.php" method="get">
        <input type="submit" value="Пошук за датою у діапазоні">
    </form>
    <form action="../../index.php" method="get">
        <input type="submit" value="Повернутися на головну">
    </form>
</body>
</html>
