<?php
include 'database.php';

$database = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $klantID = $_GET['id'];

    // Verwijder de gebruiker
    $success = $database->deleteCustomer($klantID);

    if ($success) {
        // Gebruiker succesvol verwijderd, doorverwijzen naar de pagina met gebruikersoverzicht
        header("Location: admin_users.php");
        exit();
    } else {
        echo "Fout bij het verwijderen van de gebruiker.";
    }
} else {
    echo "Ongeldige toegang tot deze pagina.";
}
?>
