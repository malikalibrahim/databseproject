<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent A Car</title> 
    <link rel="icon" href="logog4.png" >
    <link rel="stylesheet" href="stylesree.css">
    
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

<div class="hoofdpagina">
        <header>
            <div class="header-content">
                <img src="logog4.png" alt="Company Logo" class="logopage">
                <h1>Welcome to Our Digital Customer Service</h1>
                <p>At Your Company Name, we are dedicated to providing excellent services to make your experience enjoyable and hassle-free.</p>
            </div>
        </header>

        <section id="services">
            <div class="container">
                <h2>Our Services</h2>

                    <div class="center-serv">
                        <div class="service">
                            <i class="fas fa-shield-alt"></i>
                            <h3>Altijd Support & Protect</h3>
                            <p>With Altijd Support & Protect, ensure the optimal use of your new purchase. Your files are securely stored, devices protected against viruses, and unlimited assistance for all your questions.</p>
                            <a href="#">Learn More</a>
                         
                    </div>

                    <!-- Add more service sections with icons and details -->
                 
                        <div class="service">
                            <i class="fas fa-car"></i>
                            <h3>Flexible Car Rental</h3>
                            <p>Choose from a diverse range of vehicles for every occasion. Convenient and affordable car rental services.</p>
                            <a href="#">Explore Now</a>
                          
                        </div>
                  

                 
                        <div class="service">
                            <i class="fas fa-map-marked-alt"></i>
                            <h3>Reliable Chauffeur Service</h3>
                            <p>Relax and let our professional chauffeurs safely take you to your destination. Enjoy a stress-free journey.</p>
                            <a href="#">Learn More</a>
                        
                           
                   
                    </div>
                </div>
                </div>
            </div>
        </section>

        <section id="additional-services">
            <div class="container">
                <h2>Additional Services</h2>

                <ul>
                    <li><i class="fas fa-sync-alt"></i> <a href="#">Trade-In Service</a></li>
                    <li><i class="fas fa-camera"></i> <a href="#">Photo Services</a></li>
                    <li><i class="fas fa-plane"></i> <a href="#">Airport Transfers</a></li>
                    <!-- Add more services as needed -->
                </ul>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quia vel architecto deleniti, optio eveniet eaque officia quasi non dolorem nostrum suscipit quas quisquam et ipsam, quis recusandae porro delectus, tempore sunt harum nesciunt! Aut nostrum laborum amet a distinctio tempora deserunt? Eum alias vel fugiat magni adipisci optio, cumque numquam.</p>
            </div>
        </section>

        

        <section id="services">
            <div class="container">
                <h2 class="font-weight-bold text-center mb-4">Onze Diensten</h2>
                <div class="row">
                    <div class="dinst">
                        <div class="card h-100">
                            <div class="card-body">
                                <h4 class="card-title">Flexibele Autoverhuur</h4>
                                <p class="card-text">Kies uit een divers assortiment voertuigen voor elke gelegenheid.</p>
                         
                        </div>
                    </div>

               
                        <div class="card h-100">
                            <div class="card-body">
                                <h4 class="card-title">Betrouwbare Chauffeurservice</h4>
                                <p class="card-text">Ontspan en laat onze professionele chauffeurs u veilig naar uw bestemming brengen.</p>
                            
                        </div>
                    </div>

                 
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

        <section id="reviews" class="review">
            <div class="container">
                <h2 class="font-weight-bold text-center text-uppercase text-white mb-4">Wat Klanten Zeggen</h2>
                <div class="row">
                    <!-- Customer Review 1 -->
                   
                        <div class="cardh-1000">
                            <div class="card-body">
                                <h5 class="card-title">Fantastische Service</h5>
                                <div class="stars" data-rating="5"></div>
                                <p class="card-text">Geweldige autoverhuurservice. De auto was schoon en in uitstekende staat. Zeer aan te bevelen!</p>
                       
                        </div>
                    </div>

                    <!-- Customer Review 2 -->
                  
                        <div class="cardh-1000">
                            <div class="card-body">
                                <h5 class="card-title">Topauto's</h5>
                                <div class="stars" data-rating="4"></div>
                                <p class="card-text">Een breed scala aan auto's om uit te kiezen. Betaalbare prijzen en uitstekende klantenservice.</p>
                            </div>
                     
                    </div>

                    <!-- Customer Review 3 -->
                    
                        <div class="cardh-1000">
                            <div class="card-body">
                                <h5 class="card-title">Snelle en Efficiënte Service</h5>
                                <div class="stars" data-rating="4.5"></div>
                                <p class="card-text">Ik waardeer de snelle en efficiënte service. Het huren van een auto was nog nooit zo eenvoudig.</p>
                            </div>
                     
                    </div>
                </div>
            </div>
        </section>
<div class="conn">
        <div id="contact-formulier">

<h2>Contact Us</h2>

<p>If you have any questions or concerns, please fill out the form below, and we will get back to you as soon as possible.</p>

<form action="#" method="post">

    <input type="text" class="invoer-veld" name="naam" placeholder="Your Name">

    <input type="email" class="invoer-veld" name="email" placeholder="Your Email">

    <textarea class="invoer-veld" name="bericht" placeholder="Your Message"></textarea>

    <input type="submit" class="verzend-knop" value="Submit">

</form>

</div><img src="googlemaps-12.jpg" alt="">
    </div></div>
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