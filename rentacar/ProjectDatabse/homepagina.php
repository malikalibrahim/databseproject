<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent A Car</title> 
    <link rel="icon" href="logog4.png" >
    <link rel="stylesheet" href="stylehomee.css">
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
                echo '<li><a href="#"></a></li>';
                echo '<li><a href="#"></a></li>';
                echo '<ul  class="nav-list2">';
                echo '<li><a href="loguit.php">Uitloggen</a></li>';
                echo '</ul>';
            } else if ($rol == 'medewerker') {
              
                echo '<li><a href="medewerker_panel.php">Medewerker</a></li>';
                echo '<li><a href=""></a></li>';
                echo '<li><a href=""></a></li>';
                echo '<ul  class="nav-list2">';
                echo '<li><a href="loguit.php">Uitloggen</a></li>';
                echo '</ul>';
               
            } else if ($rol == 0) {  
                echo '<li><a href="facaturen.php">Facturen</a></li>';
               
                echo '<li><a href="rserveerformuli.php">Reserveren</a></li>';
                echo '<ul  class="nav-list2">';
                echo '<li><a href="gegevensbewerken.php">Profile</a></li>';
                echo '<li><a href="loguit.php">Uitloggen</a></li>';
                echo '</ul>';
            }
        } else {
            
            echo '<li><a href="facaturen.php">Facturen</a></li>';
            echo '<li><a href="rserveerformuli.php">Reserveren</a></li>';
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
            <div class="pagina">
            <div class="container">
  <div class="typewriter">Welkom bij Rent A Car!</div>
</div>
                <p>Bij Rent a Car zijn we gepassioneerd over het leveren van uitzonderlijke auto-ervaringen. Als een toonaangevende speler in de industrie zijn we trots op het aanbieden van een gevarieerd assortiment hoogwaardige voertuigen en diensten die aansluiten bij de unieke behoeften en voorkeuren van onze gewaardeerde klanten. Of je nu op zoek bent naar een luxe auto voor een bijzondere gelegenheid, een betrouwbare gezinsauto voor dagelijks gebruik, of een avontuurlijke terreinwagen voor een roadtrip, Rent a Car staat klaar om aan al jouw mobiliteitsbehoeften te voldoen. Onze toewijding aan kwaliteit, klantenservice en flexibiliteit maakt ons de ideale keuze voor het huren van jouw volgende voertuig.</p>

              <div class="bot">  <div class="bot2"><button class="hf-bt" onclick="scrollDown(890)">Ontdek onze acties</button>
                <button class="hf-bt" ><a href="services.php">Onze Services</a></button></div><div></div>
                <div class="social-icons">
            <a href="#" target="_blank" class="social-icon facebook"><i class="fab fa-facebook fa-2x"></i></a>
            <a href="#" target="_blank" class="social-icon twitter"><i class="fab fa-twitter fa-2x"></i></a>
            <a href="#" target="_blank" class="social-icon instagram"><i class="fab fa-instagram fa-2x"></i></a>
            <a href="#" target="_blank" class="social-icon linkedin"><i class="fab fa-linkedin fa-2x"></i></a>
            <a href="#" target="_blank" class="social-icon pinterest"><i class="fab fa-pinterest fa-2x"></i></a>
            <!-- Add more icons as needed -->
        </div>
                </div>
            </div>
        </div>
        <div class="auto">
 
        <div class="container">
                <form method="GET" action="">
                    
                    <input id="search" type="text" name="search" placeholder="Zoek iets" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                    <button class="button" type="submit">Search</button>
                </form>
            </div>

</div>

<div class="voeg-auto">
    <?php
if ($rol == 'Admin' || $rol == 'medewerker') {
     $cars = $db->selectadminAllCars();
} else {
   $cars = $db->selectAllCars();
}
    // Check if the search parameter is set
    if (isset($_GET['search'])){
        // Retrieve information for cars that match the search criteria
        $cars = $db->searchCars($_GET['search']);
    } else {
        // Retrieve information for all cars
       
    }

    if ($cars) {
        $rol = $db->getRoleByEmail($_SESSION['email']);

        foreach ($cars as $car) {
            $imageurl = "images/" . $car['image'];
    
            echo "<div class='car-details'>";
            echo "<h2>{$car['Merk']} {$car['Model']}</h2>";
            echo "<div class='image-container'>";
            echo "<img class='autoss' src='{$imageurl}' alt='{$car['Merk']} {$car['Model']}'>";
            echo "</div>";
            echo "<p>Year: {$car['Jaar']}</p>";
            echo "<p>Kenteken: {$car['Kenteken']}</p>";
           
    
            echo "<div class='add-car-button-container'>";
    
            // Check if the user is an admin or medewerker
            if ($rol == 'Admin' || $rol == 'medewerker') {
                // Provide a link for admins/medewerkers to edit the car
                $cars = $db->selectadminAllCars();
                echo "<a href='editCar.php?id={$car['AutoID']}' class='add-car-button'>bewerken</a>";
                // Provide additional functionality for admins/medewerkers, e.g., reserve or delete
                echo "<a href='beschikbaar.php?id={$car['AutoID']}' class='add-car-button2'>verwijder</a>";
            } else {
                $cars = $db->selectAllCars();
                // For non-admin and non-medewerker users, show the "Add a Car" button
                echo "<a href='rserveerformuli.php?id={$car['AutoID']}' class='add-car-button'>Reserveren   </a>";
            }
    
            echo "</div>";
            echo "</div>";
        }
    }

    ?>
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

</script>
</body>
</html>