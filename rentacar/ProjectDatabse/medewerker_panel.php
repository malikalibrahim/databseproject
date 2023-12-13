<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<style>/* adminpanel.css */

body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    color: #333;
    padding: 20px;
    background-color: #fff;
    margin: 0;
}

a {
    display: block;
    padding: 10px;
    margin: 10px;
    background-color: #3498db;
    color: #fff;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

a:hover {
    background-color: #2980b9;
}

.add-car-button {
    background-color: #27ae60;
}
</style>
<body>
    <h1>Admin Panel</h1>

    <!-- Voeg een link toe naar het formulier om een nieuwe auto toe te voegen -->
    <a href="add_car.php">Voeg een nieuwe auto toe</a>
    <a href="medewerker_users.php">overzicht klanten</a>
    <a href="reserveeringenmedewerker.php">Reserveeringen</a>
    <a href="admin_users.php">edit / delete </a>
    <!-- Voeg andere adminpanel-inhoud toe zoals nodig -->
</body>

</html>
