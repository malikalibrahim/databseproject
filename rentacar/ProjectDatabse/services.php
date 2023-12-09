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
    <link rel="stylesheet" href="styleser.css">
    
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
                
                echo '<li><a href="reserveerFormulier.php">Reserveeringen</a></li>';
                echo '<li><a href="loguit.php">Uitloggen</a></li>';
            }
        } else {
            echo '<li><a href="login.php">Inloggen</a></li>';
        }
        ?>
        </ul>
        </div>
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
