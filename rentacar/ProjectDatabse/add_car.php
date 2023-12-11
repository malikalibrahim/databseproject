<?php
include "database.php";

if (isset($_POST['submit'])) {
    $merk = $_POST['merk'];
    $model = $_POST['model'];
    $jaar = $_POST['jaar'];
    $kenteken = $_POST['kenteken'];
    $beschikbaarheid = $_POST['beschikbaarheid'];
    $prijs = $_POST['prijs'];

    // Bestandsverwerking voor afbeelding
    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];
    $target_directory = "images/";
    $target_file = $target_directory . basename($image);

    // Upload de afbeelding naar de server
    if (move_uploaded_file($image_temp, $target_file)) {
        // Als de afbeelding succesvol is geüpload, voeg de auto toe aan de database
        $database = new Database();
        $database->addCar($merk, $model, $jaar, $kenteken, $beschikbaarheid, $prijs, $image);
        echo "Nieuwe auto succesvol toegevoegd!";
    } else {
        echo "Fout bij het uploaden van de afbeelding.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voeg Auto Toe</title>
</head>
<body>
    <h2>Voeg een nieuwe auto toe</h2>
    <form action="add_car.php" method="post" enctype="multipart/form-data">
        <label for="merk">Merk:</label>
        <input type="text" id="merk" name="merk" required><br>

        <label for="model">Model:</label>
        <input type="text" id="model" name="model" required><br>

        <label for="jaar">Jaar:</label>
        <input type="number" id="jaar" name="jaar" required><br>

        <label for="kenteken">Kenteken:</label>
        <input type="text" id="kenteken" name="kenteken" required><br>

        <label for="beschikbaarheid">Beschikbaarheid:</label>
        <input type="text" id="beschikbaarheid" name="beschikbaarheid" required><br>

        <label for="prijs">Prijs:</label>
        <input type="text" id="prijs" name="prijs" required><br>

        <label for="afbeelding">Afbeelding:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br>

        <input type="submit" value="Voeg Auto Toe" name="submit">
    </form>
</body>
</html>
