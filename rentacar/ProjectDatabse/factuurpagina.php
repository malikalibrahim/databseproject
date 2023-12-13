<?php
session_start();
include "database.php";
include "Users/user.class.php";
include "Users/UserRegistration.php";

$db = new Database();

// Controleer of de klant is ingelogd
if (isset($_SESSION['klantID'])) {
    $klantID = $_SESSION['klantID'];
    
    // Haal de klantgegevens op
    $klantData = $db->getCustomerByID($klantID);
    $verhuurdatum = $_POST['Verhuurdatum'];
$eindVerhuurdatum = $_POST['endVerhuurdatum'];
$klantID = $_POST['KlantID'];
$autoID = $_POST['AutoID'];
$totaalBedrag = $_POST['totaalBedrag'];

// Haal klantgegevens op
$klantGegevens = $db->getCustomerByID($klantID);

// Haal autodetails op
$autoDetails = $db->selectCarByID($autoID);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $verhuurdatum = $_POST['Verhuurdatum'];
    $eindVerhuurdatum = $_POST['endVerhuurdatum'];
    $autoID = $_POST['AutoID'];
    $totaalBedrag = $_POST['totaalBedrag'];

    // Voeg factuurinformatie toe aan de database
    $query = "INSERT INTO facturen (KlantID, AutoID, Verhuurdatum, EindVerhuurdatum, TotaalBedrag)
              VALUES ($klantID, $autoID, '$verhuurdatum', '$eindVerhuurdatum', $totaalBedrag)";

$result = $db->query($query);

if ($result) {
    // Update de beschikbaarheid van de auto naar 'Niet beschikbaar'
    $updateAutoSql = "UPDATE autos SET Beschikbaarheid = '1' WHERE AutoID = :AutoID";
    $updateAutoStmt = $db->pdo->prepare($updateAutoSql);
    $updateAutoStmt->execute(['AutoID' => $autoID]);

    // Voeg andere logica toe als dat nodig is

} else {
    echo "Fout bij het opslaan van factuurinformatie: ";
}
}
    // Als de klant niet is ingelogd, stuur ze naar de inlogpagina
   
}


// Je kunt hier verdere verwerking doen, zoals het genereren van een uniek factuurnummer, berekenen van belastingen, etc.

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factuur</title>
    <style>
        /* Voeg hier je CSS-styling toe voor de factuur */
        body {
    font-family: 'Arial', sans-serif;
    margin: 20px;
    background-color: #f5f5f5;
}

.container {
    display: flex;
    justify-content: center;
}

.invoice {
    width: 60%;
    margin: 20px;
    padding: 20px;
    border: 1px solid #ddd;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease-in-out;
}

.invoice:hover {
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
}

.invoice h2 {
    color: #333;
    border-bottom: 2px solid #ddd;
    padding-bottom: 10px;
}

.invoice p {
    margin: 10px 0;
    color: #555;
}

.invoice strong {
    margin-right: 5px;
    color: #333;
}

.klantgegevens, .auto-informatie, .factuur-totaal {
    margin-top: 20px;
}

.factuur-totaal {
    padding-top: 20px;
    border-top: 2px solid #ddd;
}

.button-container {
    margin-top: 20px;
}

.button-container button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
}

.button-container button:hover {
    background-color: #0056b3;
}

.footer {
    margin-top: 50px;
    padding: 20px 0;
    background-color: #333;
    color: #fff;
    text-align: center;
}

.footer a {
    color: #fff;
    text-decoration: none;
    margin: 0 10px;
    transition: color 0.3s ease-in-out;
}

.footer a:hover {
    color: #007bff;
}

        /* Andere stijlregels hier ... */
    </style>
</head>
<body>
    <div class="container">
    <div class="invoice">
        <h2>Factuur</h2>
        <p><strong>Factuurnummer:</strong> <?php echo uniqid('FACT-'); ?></p>
        <p><strong>Factuurdatum:</strong> <?php echo date('Y-m-d'); ?></p>

        <h3>Klantgegevens</h3>
        <p><strong>Naam:</strong> <?php echo $klantGegevens['Naam']; ?></p>
        <p><strong>Adres:</strong> <?php echo $klantGegevens['Adres']; ?></p>
        <p><strong>Rijbewijsnummer:</strong> <?php echo $klantGegevens['Rijbewijsnummer']; ?></p>

        <h3>Auto Details</h3>
        <p><strong>Merk:</strong> <?php echo $autoDetails['Merk']; ?></p>
        <p><strong>Model:</strong> <?php echo $autoDetails['Model']; ?></p>
        <p><strong>Jaar:</strong> <?php echo $autoDetails['Jaar']; ?></p>
        <p><strong>Kenteken:</strong> <?php echo $autoDetails['Kenteken']; ?></p>

        <h3>Verhuurinformatie</h3>
        <p><strong>Verhuurdatum:</strong> <?php echo $verhuurdatum; ?></p>
        <p><strong>Eindverhuurdatum:</strong> <?php echo $eindVerhuurdatum; ?></p>
        <p><strong>Totaalbedrag:</strong> <?php echo $totaalBedrag; ?></p>
        <div class="factuur-container">
        

        <!-- Klantgegevens sectie -->
        <div class="klantgegevens">
            <h3>Klantgegevens</h3>
            <p><strong>Naam:</strong> <?php echo $klantData['Naam']; ?></p>
            <p><strong>Adres:</strong> <?php echo $klantData['Adres']; ?></p>
            <p><strong>Rijbewijsnummer:</strong> <?php echo $klantData['Rijbewijsnummer']; ?></p>
            <p><strong>Telefoonnummer:</strong> <?php echo $klantData['Telefoonnummer']; ?></p>
            <p><strong>Emailadres:</strong> <?php echo $klantData['Emailadres']; ?></p>
            <!-- Voeg andere klantgegevens toe zoals nodig -->
        </div>

        <!-- Auto-informatie sectie -->
        

        <!-- Rest van de factuursectie -->
    </div>
    </div>
    </div>
</body>
</html>
