<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo</title> 
   <link rel="stylesheet" href="stylee.css">
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
        session_start();
        include "Database.php";

        $db = new Database();

        if (isset($_SESSION['email'])) {
            $rol = $db->getRoleByEmail($_SESSION['email']);

            if ($rol == 'Admin') {
                echo '<li><a href="adminPanel.html">Admin</a></li>';
                echo '<li><a href="loguit.php">Uitloggen</a></li>';
            } else if ($rol == 'medewerker') {
                echo '<li><a href="medewerkers.php">Medewerker</a></li>';
                echo '<li><a href="loguit.php">Uitloggen</a></li>';
            } else if ($rol == 0) {
                echo '<li><a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart2" viewBox="0 0 16 16">';
                echo '<path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>';
                echo '</svg></a></li>';
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
            <div class="pagina">
                <h1>Welkom bij Demo - Jouw Betrouwbare Partner in Auto's</h1>
                <p>Bij Demo zijn we gepassioneerd over het leveren van uitzonderlijke auto-ervaringen. Als een toonaangevende speler in de industrie zijn we trots op het aanbieden van een gevarieerd assortiment hoogwaardige voertuigen en diensten die aansluiten bij de unieke behoeften en voorkeuren van onze gewaardeerde klanten.</p>
                <button class="hf-bt" onclick="scrollDown(890)">Ontdek onze acties</button>
            </div>
        </div>
        <div class="auto">
 
        <div class="container">
                <form method="GET" action="">
                    <i class="fas fa-search"></i>
                    <input id="search" type="text" name="search" placeholder="Zoek iets" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                    <button class="button" type="submit">Search</button>
                </form>
            </div>

</div>

            <div class="voeg-auto">
        <?php
        $db = new Database;

        // Check if the search parameter is set
        if (isset($_GET['search'])) {
            // Retrieve information for cars that match the search criteria
            $cars = $db->searchCars($_GET['search']);
        } else {
            // Retrieve information for all cars
            $cars = $db->selectAllCars();
        }

        if ($cars) {
            // Loop through each car
            foreach ($cars as $car) {
                // Construct the image URL for each car
                $imageurl = "fotos/" . $car['image'];

                echo "<div class='car-details'>";
                echo "<h2>{$car['Merk']} {$car['Model']}</h2>";

                // Display the image with specified height and width
                echo "<div class='image-container'>";
                echo "<img class='autoss' src='{$imageurl}' alt='{$car['Merk']} {$car['Model']}'>";
                echo "</div>"; // Close the image container div
                echo "<p>Year: {$car['Jaar']}</p>";
                echo "<p>Kenteken: {$car['Kenteken']}</p>";
                echo "<p>Beschikbaarheid: {$car['Beschikbaarheid']}</p>";
                
                // Add a unique identifier to the button, for example, car ID
                echo "<div class='add-car-button-container'>";
                echo "<button class='add-car-button' onclick='addToNavigation({$car['AutoID']})'>Add a Car</button>";
                echo "</div>";
                
                echo "</div>";
            }

            echo "</div>";
        } else {
            echo "<p>No cars available</p>";
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
}


</script>
</body>
</html>