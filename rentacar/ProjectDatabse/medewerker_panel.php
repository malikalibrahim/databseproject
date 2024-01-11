<?php
session_start();

include_once "database.php";
include_once "Users/user.class.php";
include_once "Users/UserRegistration.php";


$db = new Database();

try {
    $customersQuery = "SELECT COUNT(*) as total_customers FROM klanten";
    $stmtCustomers = $db->query($customersQuery);
    $customersResult = $stmtCustomers->fetch(PDO::FETCH_ASSOC);

    $reservationsQuery = "SELECT COUNT(*) as total_reservations FROM verhuringen";
    $stmtReservations = $db->query($reservationsQuery);
    $reservationsResult = $stmtReservations->fetch(PDO::FETCH_ASSOC);

    $totalRevenueQuery = "SELECT SUM(Kosten) as total_revenue FROM verhuringen";
    $stmtTotalRevenue = $db->query($totalRevenueQuery);
    $totalRevenueResult = $stmtTotalRevenue->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stylee.css">


    <style>
          
    
          .header {
            background-color: rgba(51, 51, 51, 0.8);
            text-align: center;
            padding: 20px;
            margin-bottom: 20px;
            backdrop-filter: blur(5px); /* Blur toegevoegd */
        }

        .content {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .section {
            margin: 20px;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.5); /* Aangepast om de achtergrond donkerder te maken */
            border-radius: 5px;
            width: calc(33.33% - 40px); /* Aangepast om ruimte tussen kaarten toe te voegen */
            text-align: center;
            height: 200px; /* Aangepast naar een vaste hoogte */
            backdrop-filter: blur(5px); /* Blur toegevoegd */
        }

        .dashboard-info h2, .section h2, .dashboard-info p, .section p {
            color: #fff;
        }

        .card {
            margin: 10px;
            padding: 20px;
          
            border-radius: 5px;
            height: 200px; /* Aangepast naar een vaste hoogte */
      
        }

        @media screen and (max-width: 768px) {
            .content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <ul>
            <li>
                <a href="#" class="logo">
                    <span class="icon"><ion-icon name="code-slash-outline"></ion-icon></span>
                    <span class="text">Admin panel</span>
                </a>
            </li>
            <li>
                <a href="homepagina.php">
                    <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="medewerker_users.php">
                    <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                    <span class="text">Add Users</span>
                </a>
            </li>
            <li>
                <a href="reserveeringenmedewerker.php">
                    <span class="icon"><ion-icon name="calendar-outline"></ion-icon></span>
                    <span class="text">Reservations</span>
                </a>
            </li>
            <li>
                <a href="beschikbaar.php">
                    <span class="icon"><ion-icon name="checkbox-outline"></ion-icon></span>
                    <span class="text">Availability</span>
                </a>
            </li>
            <li>
                <a href="add_car.php">
                    <span class="icon"><ion-icon name="car-outline"></ion-icon></ion-icon></span>
                    <span class="text">Add Cars</span>
                </a>
            </li>

          
            <li>
                <a href="#">
                    <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li>
                <a href="loguit.php">
                    <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </div>
 


<div class="content">

    <!-- Top Row -->
    <div class="section dashboard-info">
        <h2>Car Rental Admin Dashboard</h2>
        <p>Welcome to your car rental dashboard. Manage cars, users, reservations, and availability.</p>
    </div>

    <div class="section">
        <h2>Recent Activity</h2>
        <div class="card">
            <h2>Activity Log</h2>
            <p>View recent activities and updates related to car rentals.</p>
        </div>
    </div>

    <div class="section">
        <h2>Car Statistics</h2>
        <div class="card">
            <h2>Car Usage Statistics</h2>
            <p>Explore statistics on car usage, popular models, and more.</p>
        </div>
        <!-- Add more statistics cards as needed -->
    </div>

    <!-- Bottom Row -->
    <div class="section">
        <h2>Number of Customers</h2>
        <div class="card">
            <p>Total Customers: 12</p>
        </div>
    </div>

    <div class="section">
        <h2>Number of Reservations</h2>
        <div class="card">
            <p>Total Reservations: 1</p>
        </div>
    </div>

    <div class="section">
        <h2>Total Revenue from Rentals</h2>
        <div class="card">
            <p>Total Revenue: €70.00</p>
        </div>
    </div>

</div>  
<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Include Font Awesome JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>




    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>