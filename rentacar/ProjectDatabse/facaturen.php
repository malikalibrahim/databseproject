<?php
session_start();




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent A Car</title> 
    <link rel="icon" href="logog4.png" >
    <link rel="stylesheet" href="stylefacaturenn.css">
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
              echo '<li><a href="rserveerformuli.php">Reserveringen</a></li>';
              echo '<ul  class="nav-list2">';
         
              echo '<li><a href="loguit.php">Uitloggen</a></li>';
              echo '</ul>';
          }
      } else {
          
          echo '<li><a href="facaturen.php">Facturen</a></li>';
          echo '<li><a href="rserveerformuli.php">Reserveringen</a></li>';
          echo '<ul  class="nav-list2">';
          echo '<li><a href="login.php">Inloggen</a></li>';
          echo '</ul>';
      }
      
        ?>
            
         </ul>
         </div>
     </nav>
     <?php
  function queryForCustomer($sql, $params = []) {
    try {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Query failed: " . $e->getMessage();
    }
}
$db = new Database();

if (isset($_SESSION['klantID'])) {
    $klantID = $_SESSION['klantID'];

    // Haal facturen op voor de klant
    $facturen = $db->queryForCustomer("SELECT * FROM facturen WHERE KlantID = :klantID", ['klantID' => $klantID]);
   
    
} else {
    // Als de klant niet is ingelogd, stuur ze naar de inlogpagina
    header("Location: login.php");
    exit();
}

?>
    
<div class="hoofdpagina">
  <?php
  if ($facturen) {
    echo "<style>.car-details { display: none; }</style>";
  } else {
    echo "<style>.factuur { display: none; }</style>";
    echo "<div class='car-details' style='max-width: 400px; margin: 0 auto;'>";
    echo "<h2>Je hebt nog geen facturen!</h2>";
    echo "</div>";
  }
  ?>
  
  <div class="factuur">
    <?php foreach ($facturen as $factuur) : ?>
      <div class="row">
        <div><strong>FactuurID:</strong></div>
        <div><?php echo $factuur['FactuurID']; ?></div>
      </div>
      <div class="row">
        <div><strong>Factuurdatum:</strong></div>
        <div><?php echo $factuur['FactuurDatum']; ?></div>
      </div>
      <div class="row">
        <div><strong>TotaalBedrag:</strong></div>
        <div><?php echo $factuur['TotaalBedrag']; ?></div>
      </div>
      <?php
      $autoID = $factuur['AutoID'];
      if (!empty($autoDetails)) :
      ?>
        <div class="row">
          <div><strong>Merk:</strong></div>
          <div><?php echo $autoDetails[0]['Merk']; ?></div>
        </div>
        <div class="row">
          <div><strong>Model:</strong></div>
          <div><?php echo $autoDetails[0]['Model']; ?></div>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
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