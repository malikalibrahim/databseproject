<?php
// setBeschikbaarheid.php

session_start();
include "Database.php";

$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['verzend_naar_nul'])) {
        $id = $_POST['opnull'];
        $updateAutoSql = "UPDATE autos SET Beschikbaarheid = '0' WHERE AutoID = :AutoID";
    } elseif (isset($_POST['verzend_naar_een'])) {
        $id = $_POST['opnul'];
        $updateAutoSql = "UPDATE autos SET Beschikbaarheid = '1' WHERE AutoID = :AutoID";
    } else {
        echo "Invalid form submission.";
        exit();
    }

    $updateAutoStmt = $db->pdo->prepare($updateAutoSql);
    $updateAutoStmt->execute(['AutoID' => $id]);

    // Voeg andere logica toe indien nodig

    // Stuur de gebruiker terug naar de pagina met de lijst van auto's
    header("Location: homepagina.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <input type="text" name="opnull">
        <input type="submit" name="verzend_naar_nul" value="Set naar 0">
    </form>

    <form action="" method="POST">
        <input type="text" name="opnul">
        <input type="submit" name="verzend_naar_een" value="Set naar 1">
    </form>
</body>
</html>
