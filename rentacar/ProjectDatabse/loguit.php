<?php
session_start();
session_destroy();  // Vernietig alle sessievariabelen
header("Location: homepagina.php");  // Stuur de gebruiker terug naar het inlogscherm
exit();
?>