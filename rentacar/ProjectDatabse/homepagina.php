<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo</title> 
     <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-GLhlTQ8iUc1SZ3q6ZfQr+OpOiS460HWSl5Ll6aZO5e/Z9AnYX2Q+Brdd6zL2T2U" crossorigin="anonymous">
</head>
<body>
    <nav>
        <img src="Haima-logo.jpg" alt="logo" class="logo">
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="">Onze modellen</a></li>
            <li><a href="">Services</a></li>
            <li><a href="">bestellingen</a></li>
            <?php
session_start();
include "Database.php";

$db = new Database();

if (isset($_SESSION['email'])) {

    $rol = $db->getRoleByEmail($_SESSION['email']);

    if ($rol == 1) {
      echo '<li><a href="adminPanel.html">Admin</a></li>';
    }

    echo '<li><a href="loguit.php">Uitloggen</a></li>';
} else {
    echo '<li><a href="login.php">Inloggen</a></li>';
}
?>
        </ul>
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
                <i class="fas fa-search"></i>
                <input id="search" type="text" placeholder="Zoek iets">
              </div>
            </div>
            <div class="voeg-auto">
        </div>
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
              <a href="#" target="_blank"><i class="fab fa-facebook"></i>facebook</a>
              <a href="#" target="_blank"><i class="fab fa-twitter"></i>instagram</a>
              <a href="#" target="_blank"><i class="fab fa-instagram"></i>twitter</a>
              <a href="#" target="_blank"><i class="fab fa-linkedin"></i>linkidn</a>
            </div>
          </div>
          
        </div>
        <div class="footer-bottom">
          <p>&copy; 2023 Demo. All rights reserved.</p>
        </div>
      </footer>

      <script>
          function scrollDown(amount) {
            window.scrollBy({
                top: amount,
                behavior: 'smooth'
            });
        }
      </script>
</body>
</html>