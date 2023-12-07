<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rent a Car Services</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome voor iconen -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        /* Voeg je bestaande stijlen toe hier */

        body {
         
            margin: 0;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        header {
            background-color: #007bff;
            color: #fff;
            padding: 70px 0;
        }
        #contact{
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(bg.jpg);

    background-position: center;
    background-repeat: no-repeat; 
    background-size: cover; 
     color: white;
        }
       

        section {
            padding: 50px 0;
        }

        footer {
            background-color: black;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

       

        .navbar-dark .navbar-nav .nav-link {
            color: white;
        }

        .navbar-dark .navbar-toggler-icon {
        
        }

        a {
            text-decoration: none;
            color: white;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #007bff;
        }

        /* Aanvullende stijlen voor extra secties */
        .popular-cars {
            background-color: #f8f9fa;
            padding: 50px 0;
        }

        .review {
            background-color: black;
            padding: 70px 0;
        }

        .contact {
            background-color: #f8f9fa;
            padding: 50px 0;
        }

        .icon {
            font-size: 2em;
            margin-right: 10px;
        }

        /* Nieuwe stijlen voor de 2e container met achtergrondafbeelding */
        .container-2 {
            background-image: url('rental-car-background.jpg'); /* Vervang met de link naar je eigen afbeelding */
            background-size: cover;
            background-position: center;
            color: white;
            padding: 50px 0;
        }

        /* Aanvullende stijlen voor sterren */
        .stars {
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
        }

        .stars:before {
            content: "\2605\2605\2605\2605\2605";
            font-size: 24px;
            color: #FFD700;
        }
        .review .card {
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.review .card:hover {
    transform: scale(1.05);
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
}
#services{
    background-color: black;
    color: black;
}
#services h2{
    color: white;
    
}
nav{
    width: 100%;
    height: 100px;
    display: flex; 
    background-color: black;
    position: fixed;
    z-index: 1;
    
    
}
nav img{
    padding-top: 14px;
    padding-left: 15px;
    width: 100px;
    height: 70px;
    display: flex;  
  

}
ul{
    display: flex;
    align-items: center;
    justify-content: end;
    width: 100%;
    height: 100%;
    padding-right: 30px;
    
    
}
a{
    text-decoration: none;
    color: white;
    text-decoration: none;
}
ul li {
    list-style: none;
    padding-left: 60px;
    color: white;
    display: block;
text-decoration: none;
}


    </style>
</head>

<body>

    <!-- Navigatiemenu -->
    <nav>
         
      <a href="homepagina.php"><img src="Haima-logo.jpg" alt="logo" class="logo"></a>
        <ul>
            <li><a href="homepagina.php">Home</a></li>
          
            <li><a href="">Services</a></li>

            <?php
session_start();
include "Database.php";

$db = new Database();

if (isset($_SESSION['email'])) {

    $rol = $db->getRoleByEmail($_SESSION['email']);

    if ($rol == 'Admin') {
      echo '<li><a href="adminPanel.html">Admin</a></li>';
      echo '<li><a href="loguit.php">Uitloggen</a></li>';
    }else if ($rol == 'medewerker'){  
 
        echo '<li><a href="medewerkers.php">Medewerker</a></li>';
        echo '<li><a href="loguit.php">Uitloggen</a></li>';
      } else if ($rol == 0){
        echo '<li>';
echo '<a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart2" viewBox="0 0 16 16">';
echo '<path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>';
echo '</svg></a>';
echo '<li><a href="loguit.php">Uitloggen</a></li>';
      }


} else {
    echo '<li><a href="login.php">Inloggen</a></li>';
}
?>
        </ul>
    </nav>

    <!-- Header met welkomstboodschap -->

    

    <!-- Dienstensectie -->
    <section id="services">
        <div class="container">
            <h2 class="font-weight-bold text-center mb-4">Onze Diensten</h2>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="card-title">Flexibele Autoverhuur</h4>
                            <p class="card-text">Kies uit een divers assortiment voertuigen voor elke gelegenheid.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="card-title">Betrouwbare Chauffeurservice</h4>
                            <p class="card-text">Ontspan en laat onze professionele chauffeurs u veilig naar uw bestemming brengen.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="card-title">Luchthaventransfers</h4>
                            <p class="card-text">Geniet van naadloze transfers van en naar de luchthaven voor uw gemak.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Populaire auto's sectie -->
 

    <!-- Klantrecensies sectie -->
<!-- Klantrecensies sectie -->
<section id="reviews" class="review">
    <div class="container">
        <h2 class="font-weight-bold text-center text-uppercase text-white mb-4">Wat Klanten Zeggen</h2>
        <div class="row">
            <!-- Klantrecensie 1 -->
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Fantastische Service</h5>
                        <div class="stars" data-rating="5"></div>
                        <p class="card-text">Geweldige autoverhuurservice. De auto was schoon en in uitstekende staat. Zeer aan te bevelen!</p>
                    </div>
                </div>
            </div>
            <!-- Klantrecensie 2 -->
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Topauto's</h5>
                        <div class="stars" data-rating="4"></div>
                        <p class="card-text">Een breed scala aan auto's om uit te kiezen. Betaalbare prijzen en uitstekende klantenservice.</p>
                    </div>
                </div>
            </div>
            <!-- Klantrecensie 3 -->
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Snelle en Efficiënte Service</h5>
                        <div class="stars" data-rating="4.5"></div>
                        <p class="card-text">Ik waardeer de snelle en efficiënte service. Het huren van een auto was nog nooit zo eenvoudig.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Aanvullende stijlen voor sterren -->
<style>
    .stars {
        display: flex;
        justify-content: center;
        margin-bottom: 10px;
    }

    .stars:before {
        content: "\2605\2605\2605\2605\2605";
        font-size: 24px;
        color: #FFD700;
    }
</style>


    <!-- Contact sectie -->
    <section id="contact" class="contact">
        <div class="container">
            <h2 class="font-weight-bold text-center mb-4">Neem Contact Met Ons Op</h2>
            <div class="row">
                <div class="col-lg-6">
                    <form>
                        <div class="form-group">
                            <label for="name">Naam:</label>
                            <input type="text" class="form-control" id="name" placeholder="Voer uw naam in">
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="email" class="form-control" id="email" placeholder="Voer uw e-mailadres in">
                        </div>
                        <div class="form-group">
                            <label for="message">Bericht:</label>
                            <textarea class="form-control" id="message" rows="3" placeholder="Typ hier uw bericht"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Verstuur</button>
                    </form>
                </div>
                <div class="col-lg-6">
                    <h4>Contactinformatie</h4>
                    <p><strong>Adres:</strong> Straatnaam 123, Stad</p>
                    <p><strong>Telefoon:</strong> +31 123 456 789</p>
                    <p><strong>E-mail:</strong> info@rentacarservices.com</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 2e container met achtergrondafbeelding -->
    

    <!-- Footer -->
    <footer>
        <div class="container">
            <p class="m-0">© 2023 Rent a Car Services</p>
        </div>
    </footer>

    <!-- Bootstrap JavaScript en afhankelijkheden -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Smooth Scroll Script van W3Schools -->
    <script>
        function smoothScroll(target) {
            var targetElement = document.getElementById(target);
            $('html, body').animate({
                scrollTop: $(targetElement).offset().top
            }, 1000);
        }
    </script>

</body>

</html>
