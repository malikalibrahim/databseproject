<?php
session_start();
include "database.php";
include "Users/user.class.php";
include "Users/UserRegistration.php";

$db = new Database();

if (isset($_POST['submit'])) {
    $email = $_POST['Emailadres'];
    $wachtwoord = $_POST['Wachtwoord'];

    if ($db->customerLogin($email, $wachtwoord)) {
        
        $_SESSION['email'] = $email;  
        $_SESSION['rol'];
        header("Location: homepagina.php");
        exit();
    } else {
        
        echo "Login failed. Invalid email or password.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo</title> 
     <link rel="stylesheet" href="stylelog.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-GLhlTQ8iUc1SZ3q6ZfQr+OpOiS460HWSl5Ll6aZO5e/Z9AnYX2Q+Brdd6zL2T2U" crossorigin="anonymous">
</head>
<body>
    <nav>
        <img src="Haima-logo.jpg" alt="logo" class="logo">
        <ul>
            <li><a href="homepagina.html">Home</a></li>
            <li><a href="">Onze modellen</a></li>
            <li><a href="">Services</a></li>
            <li><a href="">bestellingen</a></li>
            <li><a href="">Inloggen</a></li>
        </ul>
    </nav>
    <div class="contener">
    <div class="hoofdpagina">
       
            
        <form action="" method="POST">
            
             <div class="pagina">
               <div class="ce">  
             <h1>Login</h1>
            <label for="Emailadres">E-mail</label><br>
            <input type="email" name="Emailadres"><br>
            
            <label for="Wachtwoord">Wachtwoord</label><br>
            <input type="password" name="Wachtwoord"><br>

            <input type="submit" name="submit">
            <a href="registreren.php">Maak hier acccount</a>
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
</body>
</html>