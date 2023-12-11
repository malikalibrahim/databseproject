<?php
include "database.php";

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $autoID = $_POST['autoID'];
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

    // Upload de afbeelding naar de server (alleen als er een nieuwe afbeelding is geselecteerd)
    if (!empty($image) && move_uploaded_file($image_temp, $target_file)) {
        // Als de afbeelding succesvol is geüpload, werk de auto-informatie bij in de database met nieuwe afbeelding
        $database = new Database();
        $success = $database->editCar($autoID, $image, $merk, $model, $jaar, $kenteken, $beschikbaarheid, $prijs);

        // Wacht 2 seconden voordat je de gebruiker doorstuurt
        sleep(2);

        if ($success) {
            echo "Auto-informatie inclusief nieuwe afbeelding succesvol bijgewerkt!";
        } else {
            echo "Fout bij het bijwerken van auto-informatie.";
        }
    } else {
        // Als er geen nieuwe afbeelding is geselecteerd, werk de auto-informatie bij zonder afbeelding te wijzigen
        $database = new Database();
        $success = $database->editCarWithoutImage($autoID, $merk, $model, $jaar, $kenteken, $beschikbaarheid, $prijs);

        if ($success) {
            echo "Auto-informatie succesvol bijgewerkt!";
        } else {
            echo "Fout bij het bijwerken van auto-informatie.";
        }
    }

    // Redirect naar homepagina.php
    header("Location: homepagina.php");
    exit();
}

// Haal de auto-informatie op voor bewerking
if (isset($_GET['id'])) {
    $autoID = $_GET['id'];
    $database = new Database();
    $car = $database->selectCarByID($autoID);
} else {
    // Redirect naar de pagina met de lijst van auto's als geen ID is opgegeven
    header("Location: homepagina.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bewerk Auto</title>
    <link rel="stylesheet" href="editcar.css">
</head>
<body>
    <h2>Bewerk de auto</h2>
    <form action="editcar.php?id=<?php echo $car['AutoID']; ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="autoID" value="<?php echo $car['AutoID']; ?>">

        <label for="merk">Merk:</label>
        <input type="text" id="merk" name="merk" value="<?php echo $car['Merk']; ?>" required><br>

        <label for="model">Model:</label>
        <input type="text" id="model" name="model" value="<?php echo $car['Model']; ?>" required><br>

        <label for="jaar">Jaar:</label>
        <input type="number" id="jaar" name="jaar" value="<?php echo $car['Jaar']; ?>" required><br>

        <label for="kenteken">Kenteken:</label>
        <input type="text" id="kenteken" name="kenteken" value="<?php echo $car['Kenteken']; ?>" required><br>

        <label for="beschikbaarheid">Beschikbaarheid:</label>
        <input type="text" id="beschikbaarheid" name="beschikbaarheid" value="<?php echo $car['Beschikbaarheid']; ?>" required><br>

        <label for="prijs">Prijs:</label>
        <input type="text" id="prijs" name="prijs" value="<?php echo $car['Prijs']; ?>" required><br>

        <label for="afbeelding">Afbeelding wijzigen:</label>
        <input type="file" id="image" name="image" accept="image/*"><br>

        <input type="submit" value="Werk Auto Bij" name="submit">
    </form>
</body>
</html>
