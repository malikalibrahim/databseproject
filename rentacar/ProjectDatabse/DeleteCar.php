<?php
include "database.php";

// Check if car ID is provided in the URL
if (isset($_GET['id'])) {
    $autoID = $_GET['id'];

    // Create a database instance
    $database = new Database();

    // Check if the car exists
    $car = $database->selectCarByID($autoID);

    if ($car) {
        // Car found, delete it
        $success = $database->deleteCar($autoID);

        if ($success) {
            echo "Auto succesvol verwijderd!";
        } else {
            echo "Fout bij het verwijderen van de auto.";
        }
    } else {
        echo "Auto niet gevonden.";
    }
} else {
    echo "Auto ID ontbreekt.";
}

// Redirect to homepagina.php after 2 seconds
echo "<script>
        setTimeout(function() {
            window.location.href = 'homepagina.php';
        }, 2000);
      </script>";
?>
