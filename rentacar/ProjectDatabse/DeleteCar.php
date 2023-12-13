<?php
include 'database.php';

$database = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $klantID = $_GET['id'];

    // Verwijder de gebruiker
    $success = $database->deleteUser($klantID);

    if ($success) {
        // Redirect terug naar de pagina met gebruikerslijst na succesvol verwijderen
        header("Location: medewerker_panel.php");
        exit();
    } else {
        echo "Fout bij het verwijderen van de gebruiker.";
    }
} else {
    echo "Ongeldige toegang tot deze pagina.";
    exit();
}
?>
