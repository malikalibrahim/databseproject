<?php
 

session_start();
include "database.php";
include "Users/user.class.php";
include "Users/UserRegistration.php";
 
$db = new Database();
$klantID = $_SESSION['klantID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo</title> 
     <link rel="stylesheet" href="stylereserveeringg.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-GLhlTQ8iUc1SZ3q6ZfQr+OpOiS460HWSl5Ll6aZO5e/Z9AnYX2Q+Brdd6zL2T2U" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>
<nav>
    <a href="homepagina.php"><img src="Haima-logo.jpg" alt="logo" class="logo"></a>
    <div class="menu-toggle" onclick="toggleMenu()">☰</div>
    <div class="dropdown" id="dropdown">
        <ul class="nav-list">

            <li><a href="homepagina.php">Home</a></li>
            <li><a href="services.php">Services</a></li>
            <?php
        
    
        if (isset($_SESSION['email'])) {
            $rol = $db->getRoleByEmail($_SESSION['email']);

            if ($rol == 'Admin') {
                echo '<li><a href="adminPanel.html">Admin</a></li>';
                echo '<li><a href="loguit.php">Uitloggen</a></li>';
            } else if ($rol == 'medewerker') {
                echo '<li><a href="medewerkers.php">Medewerker</a></li>';
                echo '<li><a href="loguit.php">Uitloggen</a></li>';
            } else if ($rol == 0) {
                
                echo '<li><a href="reserveerFormulier.php">Reserveeringen</a></li>';
                echo '<li><a href="loguit.php">Uitloggen</a></li>';
            }
        } else {
            echo '<li><a href="login.php">Inloggen</a></li>';
        }
        ?>
            </ul>
    </div>
</nav>

    <div class="contener">
    <div class="hoofdpagina">
       
      <div class=" car-details">
      <?php
if (isset($_GET['id'])) {
    $autoID = $_GET['id'];
    $carInfo = $db->selectCarByID($autoID);
    

$prijsPerDag = $db->getCarPrice($autoID);



    if ($carInfo) {
        // Toon de auto-informatie in een div
        echo "<div style='max-width: 400px; margin: 0 auto;'>"; // Hier wordt max-width ingesteld op 400 pixels, je kunt dit aanpassen aan je behoeften
        echo "<h2>{$carInfo['Merk']} {$carInfo['Model']}</h2>";
        echo "<img src='imagess/{$carInfo['image']}' alt='{$carInfo['Merk']} {$carInfo['Model']}' style='max-width: 100%; height: auto;'>";
        echo "<p>Jaar: {$carInfo['Jaar']}</p>";
        echo "<p>Kenteken: {$carInfo['Kenteken']}</p>";
        // Voeg hier andere velden toe
        echo "</div>";
    } else {
        echo "<p>Geen auto gevonden met dit ID.</p>";
    }
} else {
    echo "<p>Auto ID niet opgegeven.</p>";
}

$totaalBedrag = 0.00; // Initialiseer de variabele

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verkrijg de ingediende gegevens
    $verhuurdatum = $_POST['Verhuurdatum'];
    $eindVerhuurdatum = $_POST['endVerhuurdatum'];
    $klantID = $_POST['KlantID'];
    $autoID = $_POST['AutoID'];

    // Bereken het aantal dagen tussen de start- en einddatum
    $startDatum = new DateTime($verhuurdatum);
    $eindDatum = new DateTime($eindVerhuurdatum);
    $verschil = $startDatum->diff($eindDatum);
    $aantalDagen = $verschil->days;

    // Haal de prijs per dag op uit de database
    $db = new Database; // Pas dit aan aan je implementatie
    $prijsPerDag = $db->getCarPrice($autoID);

    // Bereken de totale kosten
    $totaalBedrag = $prijsPerDag * $aantalDagen;
}
?>




    </div>      
        <form action="" method="POST">
            
             <div class="pagina">
              
            <div class="ce">  <h1>Reserveeringen</h1>
       
            <form method="post" action="jouw_php_script.php" >
    <label for="Verhuurdatum">Startdatum verhuur:</label>
    <input type="date" name="Verhuurdatum" required>

    <label for="endVerhuurdatum">Einddatum verhuur:</label>
    <input type="date" name="endVerhuurdatum" required>

    <label for="KlantID">Klant ID:</label>
    <input type="text" name="KlantID" readonly required value="<?php echo $klantID; ?>" >

    <label for="AutoID">Auto ID:</label>
    <input type="text" name="AutoID" readonly required value="<?php echo $autoID; ?>">

    <label for="totaalBedrag">Totaal bedrag:</label>
            <input type="text" name="totaalBedrag" value="<?php echo number_format($totaalBedrag, 2); ?>" readonly>
   <div class=" button-container"> <button type="submit">Boeken</button><button type="submit">berekenprijs</button>
            </div></div></div>
        </form>
    
    </div>
</div>
<footer class="footer">
    <div class="footer-container">
        <div class="footer-section">
            <h3>Info</h3>
            <p>Amstelveen</p>
            <p>E-mail: info@demo.com</p>
            <p>Tel: 061234567</p>
        </div>

        <div class="footer-section">
            <h3>Volg ons</h3>
            <div class="social-icons">
                <a href="#" target="_blank"><i class="fab fa-facebook"></i> Facebook</a>
                <a href="#" target="_blank"><i class="fab fa-twitter"></i> Twitter</a>
                <a href="#" target="_blank"><i class="fab fa-instagram"></i> Instagram</a>
                <a href="#" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2023 Demo. All rights reserved.</p>
    </div>
</footer>
<script>
    function scrollDown(amount) {
        var currentPosition = window.scrollY || window.pageYOffset;
        var targetPosition = currentPosition + amount;

        window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
        });
    }
    function toggleMenu() {
    var dropdown = document.getElementById("dropdown");
    dropdown.classList.toggle("active");
}


  // Voeg een event listener toe voor het veranderen van de datums
  document.getElementById('reserveringFormulier').addEventListener('input', function() {
        // Haal de geselecteerde datums op
        const startDatum = new Date(document.getElementsByName("Verhuurdatum")[0].value);
        const eindDatum = new Date(document.getElementsByName("endVerhuurdatum")[0].value);

        // Bereken het aantal dagen tussen de datums
        const verschilInTijd = eindDatum.getTime() - startDatum.getTime();
        const aantalDagen = verschilInTijd / (1000 * 3600 * 24);

        // Haal de prijs per dag op uit de database via een AJAX-verzoek
        const autoID = document.getElementsByName("AutoID")[0].value;
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const prijsPerDag = parseFloat(this.responseText);
                
                // Bereken de totale kosten
                const totaalBedrag = prijsPerDag * aantalDagen;

                // Update het veld in het formulier
                document.getElementsByName("totaalBedrag")[0].value = totaalBedrag.toFixed(2);
            }
        };
        xhttp.open("GET", "getPrijsPerDag.php?autoID=" + autoID, true);
        xhttp.send();
    });
</script>
</body>
</html>