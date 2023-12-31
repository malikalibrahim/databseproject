

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent A Car</title> 
    <link rel="icon" href="logog4.png" >
    <link rel="stylesheet" href="styleloguitt.css">
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
           <?php
 
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
 
           </div></div>
       </form>
   
   </div>
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