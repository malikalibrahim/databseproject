<?php
include 'database.php';

$database = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $autoID = $_GET['id'];

    // Verwijder de auto
    $success = $database->deleteCar($autoID);

    if ($success) {
        // Redirect terug naar de pagina met autolijst na succesvol verwijderen
        header("Location: homepagina.php");
        exit();
    } else {
        echo "Fout bij het verwijderen van de auto.";
    }
} else {
    echo "Ongeldige toegang tot deze pagina.";
    exit();
}
?>
