<?php
session_start();
include "database.php";
include "Users/user.class.php";
include "Users/UserRegistration.php";

$db = new Database();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo</title> 
     <link rel="stylesheet" href="stylelogin.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-GLhlTQ8iUc1SZ3q6ZfQr+OpOiS460HWSl5Ll6aZO5e/Z9AnYX2Q+Brdd6zL2T2U" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <title>Social Media Links</title>

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
               <div class="ce">  
             <h1>Login</h1>
            <label for="Emailadres">E-mail</label>
            <input type="email" name="Emailadres"><br>
            
            <label for="Wachtwoord">Wachtwoord</label>
            <input type="password" name="Wachtwoord"><br>

            <input type="submit" name="submit">
            <a href="registreren.php">Geen acccount? registreer hier!</a>
            <?php


if (isset($_POST['submit'])) {
    $email = $_POST['Emailadres'];
    $wachtwoord = $_POST['Wachtwoord'];

    if ($db->customerLogin($email, $wachtwoord)) {
      $klantID = $db->getKlantIDByEmail($email);
      $_SESSION['klantID'] = $klantID;
        $_SESSION['email'] = $email;  
        $_SESSION['rol'];
        header("Location: homepagina.php");
        exit();
    } else {
        
        echo '<p style="color: red;">Ongeldig e-mailadres of wachtwoord!</p>';


    }
}


?>
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