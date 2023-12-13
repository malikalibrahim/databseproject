<?php
session_start();
include "database.php";
include "Users/user.class.php";
include "Users/UserRegistration.php";

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo</title> 
    <meta charset="UTF-8">
    <link rel="stylesheet" href="stylefacc.css">
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
                
                echo '<li><a href="reserveerFormulier.php">Reserveringen</a></li>';
                echo '<li><a href="loguit.php">Uitloggen</a></li>';
            }
        } else {
            echo '<li><a href="login.php">Inloggen</a></li>';
        }
        ?>
            </ul>
    </div>
</nav>
<style>body {
    padding: 0;
    margin: 0;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    background-color: #f4f4f4;
}


@media screen and (max-width: 768px) {
    .pagina {
        width: 100%;
        
    }

    nav img {
        padding-top: 14px;
        padding-left: 15px;
        width: 80px;
        height: 50px;
    }

    .menu-toggle {
        display: block;
    }

    .dropdown {
        display: none;
        position: absolute;
        top: 100px;
        left: 0;
        width: 100%;
        background-color: black;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        z-index: 1;
    }

    .nav-list {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: start;
        margin: 0;
        list-style: none;
        padding: 0;
    }

    .menu-toggle {
        display: block;
    }

    .dropdown.active {
        display: block;
    }

    .nav-list li {
        margin-bottom: 15px;
    }

    .hoofdpagina {
        display: flex;
        flex-direction: column;
        height: 600px;
        padding-top: 150px;
    }

    .car-details img {
        width: 100%;
    }

    .footer {
        height: auto;
    }

    .footer-container {
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }

    .footer-section {
        max-width: none;
    }

    .car-details {
        padding: 20px;
    
        width: 100%;
        text-align: center;
    }

    .factuur li,
    tr,
    td {
  
       
        color: white;
       
        height: 30px;
        margin-bottom: 10px;
        padding: 8px;
    }
    .factuur

     {
        backdrop-filter: blur(30px);
        color: white;
        display: block;
        height: 150px;
        margin-bottom: 10px;
        padding: 8px;
    }

    table {
        width: 100%;
        max-width: 100%;
    }

    th, td {
        font-size: 14px;
        padding: 6px;
    }
    
}
.factuur

     {
        backdrop-filter: blur(30px);
     
        color: white;
        display: block;
        height: 180px;
        margin-bottom: 10px;
        padding: 8px;
    }
    .car-details{
        backdrop-filter: blur(30px);
     text-align: center;
     color: white;
     display: block;
     height: 80px;
     margin-bottom: 10px;
     padding: 8px;
    }

</style>
<div class="hoofdpagina" >
<?php
if ($facturen) {
    // Toon het formulier voor facturen alleen als er bestellingen zijn
    
    echo "<style>.car-details { display: none; }</style>";
  
} else {
    // Verberg het formulier als er geen bestellingen zijn
    echo "<style>.factuur { display: none; }</style>";
    // Toon een bericht als er geen bestellingen zijn
    echo "<div class='car-details' style='max-width: 400px; margin: 0 auto;'>";
    echo "<h2>Je hebt nog geen facturen!</h2>";
    // Voeg hier andere velden toe
    echo "</div>";
}
?>

        <div class="factuur">
          
            <ul>
            <?php foreach ($facturen as $factuur) : ?>
    <li>
        <table>
            <tr>
                <td><strong>FactuurID:</strong></td>
                <td><?php echo $factuur['FactuurID']; ?></td>
            </tr>
            <tr>
                <td><strong>Factuurdatum:</strong></td>
                <td><?php echo $factuur['FactuurDatum']; ?></td>
            </tr>
            <tr>
                <td><strong>TotaalBedrag:</strong></td>
                <td><?php echo $factuur['TotaalBedrag']; ?></td>
            </tr>
            <?php
            // Haal autogegevens op
            $autoID = $factuur['AutoID'];
           
            

            if (!empty($autoDetails)) {
                ?>
                 <tr>
            <td style="text-align: left;"><strong>Merk:</strong></td>
            <td style="text-align: center;">
                <?php
               
                echo "<li>" . $autoDetails[0]['Merk'] . "</li>";
              
                ?>
            </td>
        </tr>
                <tr>
                    <td><strong>Model:</strong></td>
                    <td>
                        <?php
                        
                        echo "<li><strong>Model:</strong> " . $autoDetails[0]['Model'] . "</li>";
                     
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </li>
<?php endforeach; ?>
            </ul>
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

</script>
</body>
</html>