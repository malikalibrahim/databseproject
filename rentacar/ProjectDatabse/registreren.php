<?php
session_start();
 
include "database.php";
include "Users/user.class.php";
include "Users/UserRegistration.php";
 
$db = new Database();
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['Naam'];
    $adres = $_POST['Adres'];
    $Rijbewijsnummer = $_POST['Rijbewijsnummer'];
    $Telefoonnummer = $_POST['Telefoonnummer'];
    $Emailadres = $_POST['Emailadres'];
    $Wachtwoord = $_POST['Wachtwoord'];
 
    $newUser = new User($name, $adres, $Rijbewijsnummer,$Telefoonnummer, $Emailadres, $Wachtwoord  );
    $userRegistration = new UserRegistration();
    $klantID = $userRegistration->registerUser($db, $newUser);
    $_SESSION['klantID'] = $klantID;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo</title> 
     <link rel="stylesheet" href="styleloguit.css">
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
            <li><a href="login.php">Inloggen</a></li>
            </ul>
    </div>
</nav>
    <div class="contener">
    <div class="hoofdpagina">
       
            
        <form action="" method="POST">
            
             <div class="pagina">
              
            <div class="ce">  <h1>Registreren</h1>
       
            <label for="Naam">Naam:</label>
            <input type="text" name="Naam">

            <label for="Adres">Adres:</label>
            <input type="text" name="Adres">

            <label for="Rijbewijsnummer">Rijbewijsnummer:</label>
            <input type="tel" name="Rijbewijsnummer">

            <label for="Telefoonnummer">Telefoonnummer:</label>
            <input type="tel" name="Telefoonnummer">

            <label for="Emailadres">E-mail:</label>
            <input type="text" name="Emailadres">
            
            <label for="Wachtwoord">Wachtwoord:</label>
            <input type="password" name="Wachtwoord"><br>

            <input type="submit" name="submit">
            <a href="login.php">Heb je al een account?</a>
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
}


</script>
</body>
</html>