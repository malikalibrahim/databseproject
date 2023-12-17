<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent A Car</title> 
    <link rel="icon" href="logog4.png" >
    <link rel="stylesheet" href="stylereserveeringg.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-GLhlTQ8iUc1SZ3q6ZfQr+OpOiS460HWSl5Ll6aZO5e/Z9AnYX2Q+Brdd6zL2T2U" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-3CQGz0wv1ClQH95cLbP0t9zPzFmB+P34MQ3gg8YOQObWBhRTt8wrMkNLp6dSTMLa" crossorigin="anonymous">
</head>
<body>
    
<nav> 
     
<div class="menu-toggle" onclick="toggleMenu()">☰</div>  <a href="homepagina.php"><img src="logog.png" alt="logo" class="logo"></a>
    <div class="dropdown" id="dropdown">
    <ul class="nav-list">
  
   

            <li><a href="homepagina.php">Home</a></li>
            <li><a href="services.php">Services</a></li>
         
        
        
           
            <?php
        error_reporting(0);
        ini_set('display_errors', '0');
        ini_set('log_errors', '1');
        session_start();
        include "Database.php";

        $db = new Database();

        if (isset($_SESSION['email'])) {
            $rol = $db->getRoleByEmail($_SESSION['email']);

            if ($rol == 'Admin') {
              
                echo '<li><a href="admin_panel.php">Admin</a></li>';
                echo '<li><a href="loguit.php"></a></li>';
                echo '<li><a href="loguit.php"></a></li>';
                echo '<ul  class="nav-list2">';
                echo '<li><a href="loguit.php">Uitloggen</a></li>';
                echo '</ul>';
            } else if ($rol == 'medewerker') {
              
                echo '<li><a href="medewerker_panel.php">Medewerker</a></li>';
                echo '<li><a href="loguit.php"></a></li>';
                echo '<li><a href="loguit.php"></a></li>';
                echo '<ul  class="nav-list2">';
                echo '<li><a href="loguit.php">Uitloggen</a></li>';
                echo '</ul>';
               
            } else if ($rol == 0) {  
                echo '<li><a href="facaturen.php">Facturen</a></li>';
                echo '<li><a href="reserveerFormulier.php">Reserveringen</a></li>';
                echo '<ul  class="nav-list2">';
           
                echo '<li><a href="loguit.php">Uitloggen</a></li>';
                echo '</ul>';
            }
        } else {
            
            echo '<li><a href="facaturen.php">Facturen</a></li>';
            echo '<li><a href="reserveerFormulier.php">Reserveringen</a></li>';
            echo '<ul  class="nav-list2">';
            echo '<li><a href="login.php">Inloggen</a></li>';
            echo '</ul>';
        }
        ?>
       
    </ul>
    </div>
</nav>
<div class="contener">
    <div class="hoofdpagina">
       
      <div class=" car-details">
      <?php
      if (isset($_SESSION['klantID'])) {
        $klantID = $_SESSION['klantID'];
    
        // Haal facturen op voor de klant
        $facturen = $db->queryForCustomer("SELECT * FROM facturen WHERE KlantID = :klantID", ['klantID' => $klantID]);
       
        
    } else {
        // Als de klant niet is ingelogd, stuur ze naar de inlogpagina
        header("Location: login.php");
        exit();
    }
if (isset($_GET['id'])) {
    $autoID = $_GET['id'];
    $carInfo = $db->selectCarByID($autoID);
    

$prijsPerDag = $db->getCarPrice($autoID);



    if ($carInfo) {
        // Toon de auto-informatie in een div
        echo "<div style='max-width: 400px; margin: 0 auto;'>"; // Hier wordt max-width ingesteld op 400 pixels, je kunt dit aanpassen aan je behoeften
        echo "<h2>{$carInfo['Merk']} {$carInfo['Model']}</h2>";
        echo "<img src='images/{$carInfo['image']}' alt='{$carInfo['Merk']} {$carInfo['Model']}' style='max-width: 100%; height: auto;'>";
        echo "<p>Jaar: {$carInfo['Jaar']}</p>";
        echo "<p>Kenteken: {$carInfo['Kenteken']}</p>";
        // Voeg hier andere velden toe
        echo "</div>";
    } else {
      
    }
} else {
    echo "<p>Voeg een Auto toe!</p>";
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
        
             <form method="post" action="factuurpagina.php" <?php if (!isset($autoID) || empty($autoID)) echo 'style="display: none;"'; ?>> >
             <div class="pagina" >
              
            <div class="ce">  <h1>Reserveringen</h1>
       
           
            <label for="Verhuurdatum">Startdatum verhuur:</label>
            <input type="date" id="Verhuurdatum" name="Verhuurdatum" oninput="calculateAndDisplay()" required>

            <label for="endVerhuurdatum">Einddatum verhuur:</label>
            <input type="date" id="endVerhuurdatum" name="endVerhuurdatum" oninput="calculateAndDisplay()" required>

            <label for="KlantID">Klant ID:</label>
            <input type="text" id="KlantID" name="KlantID" readonly required value="<?php echo $klantID; ?>">

            <label for="AutoID">Auto ID:</label>
            <input type="text" id="AutoID" name="AutoID" readonly required value="<?php if (isset($autoID)){echo $autoID;
            if ($autoID){
                
            }} ?>">

            <label for="totaalBedrag">Totaal bedrag:</label>
            <input type="text" id="totaalBedrag" name="totaalBedrag" readonly>

            <div class="button-container">
                <button type="submit">Boeken</button>
            </div>
            </div></div>
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
    let ul = document.querySelectorAll("ul");
}

    function fillReservationForm(merk, model, jaar, kenteken) {
        // You can use JavaScript to populate the form fields with the selected car details
        document.getElementById('car').value = merk + ' ' + model;
        document.getElementById('year').value = jaar;
        document.getElementById('license_plate').value = kenteken;

        // You might want to scroll to the reservation form after filling the details
        document.getElementById('reservation-form').scrollIntoView({ behavior: 'smooth' });
    }
    function fillReservationForm(merk, model, jaar, kenteken) {
        // You can use JavaScript to populate the form fields with the selected car details
        document.getElementById('car').value = merk + ' ' + model;
        document.getElementById('year').value = jaar;
        document.getElementById('license_plate').value = kenteken;

        // You might want to scroll to the reservation form after filling the details
        document.getElementById('reservation-form').scrollIntoView({ behavior: 'smooth' });
    }
    
  // Voeg een event listener toe voor het veranderen van de datums
  document.addEventListener('DOMContentLoaded', function() {
            // Haal de geselecteerde datums op
            const startDatumInput = document.getElementsByName("Verhuurdatum")[0];
            const eindDatumInput = document.getElementsByName("endVerhuurdatum")[0];

            // Voeg event listeners toe voor het veranderen van de datums
            startDatumInput.addEventListener('input', updateTotaalBedrag);
            eindDatumInput.addEventListener('input', updateTotaalBedrag);

            function updateTotaalBedrag() {
                // Haal de geselecteerde datums op
                const startDatum = new Date(startDatumInput.value);
                const eindDatum = new Date(eindDatumInput.value);

                // Controleer of de datums geldig zijn
                if (!isNaN(startDatum.getTime()) && !isNaN(eindDatum.getTime())) {
                    // Bereken het aantal dagen tussen de datums
                    const verschilInTijd = eindDatum.getTime() - startDatum.getTime();
                    const aantalDagen = verschilInTijd / (1000 * 3600 * 24);

                    // Haal de prijs per dag op uit de database via een AJAX-verzoek
                    const autoID = document.getElementsByName("AutoID")[0].value;
                    const xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4) {
                            if (this.status == 200) {
                                const prijsPerDag = parseFloat(this.responseText);
                                
                                // Bereken de totale kosten
                                const totaalBedrag = prijsPerDag * aantalDagen;

                                // Update het veld in het formulier
                                document.getElementsByName("totaalBedrag")[0].value = totaalBedrag.toFixed(2);
                            } else {
                                console.error("Er is een probleem opgetreden bij het ophalen van de prijs per dag.");
                            }
                        }
                    };
                    xhttp.open("GET", "getPrijsPerDag.php?autoID=" + autoID, true);
                    xhttp.send();
                } else {
                    console.error("Ongeldige datums ingevoerd.");
                }
            }

            // Roep de functie updateTotaalBedrag aan bij het laden van de pagina
            updateTotaalBedrag();
        }); 
     
        function calculateAndDisplay() {
        let verhuurdatum = document.getElementById("Verhuurdatum").value.trim();
        let endVerhuurdatum = document.getElementById("endVerhuurdatum").value.trim();

        // Perform date validation if needed

        let startDatum = new Date(verhuurdatum);
        let eindDatum = new Date(endVerhuurdatum);
        let verschil = Math.ceil((eindDatum - startDatum) / (1000 * 60 * 60 * 24)); // Calculate difference in days

        // Assume $prijsPerDag is available in your PHP script
        let prijsPerDag = <?php echo $prijsPerDag; ?>;

        // Calculate totaalBedrag
        let totaalBedrag = prijsPerDag * verschil;

        // Display totaalBedrag in the input field
        document.getElementById("totaalBedrag").value = totaalBedrag.toFixed(2);
}

</script>
</body>
</html>