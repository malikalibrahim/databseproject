<?php
// insert_factuur.php

// Assuming you have a Database class to handle database interactions
include "database.php";

// Create a Database instance
$db = new Database();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get values from the form
    $klantID = $_POST["klantID"];
    $autoID = $_POST["autoID"];
    $verhuurdatum = $_POST["verhuurdatum"];
    $eindVerhuurdatum = $_POST["eindVerhuurdatum"];
    $totaalBedrag = $_POST["totaalBedrag"];

    // SQL query to insert data into the "facturen" table
    $sql = "INSERT INTO facturen (KlantID, AutoID, Verhuurdatum, EindVerhuurdatum, TotaalBedrag) 
            VALUES (:klantID, :autoID, :verhuurdatum, :eindVerhuurdatum, :totaalBedrag)";

    // Parameters for the query
    $params = [
        ":klantID" => $klantID,
        ":autoID" => $autoID,
        ":verhuurdatum" => $verhuurdatum,
        ":eindVerhuurdatum" => $eindVerhuurdatum,
        ":totaalBedrag" => $totaalBedrag,
    ];

    // Execute the query
    $result = $db->execute($sql, $params);

    if ($result) {
        header('Location: reserveeringenmedewerker.php');
    } else {
        echo "Er is een fout opgetreden bij het toevoegen van de factuur.";
    }
}
?>