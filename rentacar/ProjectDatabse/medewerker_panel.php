
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
    <title>Car Rental Medewerkers Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex !important;
            justify-content: center !important;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
        }

        #sidebar {
            width: 250px;
            
            height: 100%;
            background-color: #000;
            color: white;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
            padding-left: 20px;
            position: fixed;
            z-index: 1;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            left: -250px;
        }

        #sidebar a {
            padding: 15px;
            display: block;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        #sidebar a:hover {
            background-color: #333;
        }

        #menu-icon {
            cursor: pointer;
            padding: 20px;
            background-color: transparent;
           
            text-align: center;
            position: fixed;
            z-index: 2;
            transition: margin-left 0.5s, background-color 0.5s;
            top: 20px;
            left: 20px;
        }

        #menu-icon i {
            font-size: 24px;
        }

        #menu-icon.closed {
            background-color: transparent;
        }

        .content {
            width: 700px;
            height: 400px !important;
            transition: margin-left 0.5s;
            padding: 16px;
            flex-grow: 1;
            margin-left: 0;
        }

        a {
            display: block;
            padding: 10px;
            margin: 10px;
            background-color: #3498db;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #2980b9;
        }

        .add-car-button {
            background-color: #27ae60;
        }

        .card {
            margin: 10px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        .dashboard-info {
            background-color: #3498db;
            color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        @media screen and (max-width: 768px) {
            #sidebar {
                width: 0;
                box-shadow: none;
            }

            #menu-icon {
                margin-left: 20px;
            }

            .content {
                margin-left: 0;
            }

            #menu-icon.closed {
                background-color: transparent;
            }

            #menu-icon i {
                font-size: 32px;
            }
        }

        @media screen and (min-width: 769px) {
            #menu-icon i {
                display: none;
            }
        }

        .quick-links {
            margin-top: 20px;
        }

        .quick-links a {
            background-color: #e74c3c;
        }

        .quick-links a:hover {
            background-color: #c0392b;
        }

        .statistics {
            margin-top: 20px;
        }

        .statistics .card {
            background-color: #ecf0f1;
            color: #333;
        }
        .infoo{
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div id="sidebar">
        <a href="#" onclick="toggleNav()"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="add_car.php"><i class="fas fa-car"></i> Add New Car</a>
        <a href="medewerker_users.php"><i class="fas fa-user"></i> Add User</a>
        <a href="reserveeringenmedewerker.php"><i class="fas fa-calendar"></i> Reservations</a>
        <a href="beschikbaar.php" class="add-car-button"><i class="fas fa-calendar-check"></i> Availability</a>







        <!-- Add other links as needed -->
        <div class="quick-links">
         
          
            <a href="loguit.php"><i class=""></i>Uitloggen</a>
        </div>
    </div>

    <div id="menu-icon" onclick="toggleNav()"><i class="fas fa-bars"></i></div>

    <div class="content">
        <div class="dashboard-info">
            <h2>Car Rental Medewerker Dashboard</h2>
            <p>Welcome to your car rental dashboard. Manage cars, users, reservations, and availability.</p>
        </div>

        <h1>Recent Activity</h1>
        <div class="card">
            <h2>Activity Log</h2>
            <p>View recent activities and updates related to car rentals.</p>
        </div>

        <h1>Car Statistics</h1>
        <div class="statistics">
            <div class="card">
                <h2>Car Usage Statistics</h2>
                <p>Explore statistics on car usage, popular models, and more.</p>
            </div>
            <!-- Add more statistics cards as needed -->
        </div>

        <!-- Add more sections and elements as needed -->

    </div>
    <div  class="infoo">
    <div class="card">
        <h2>Number of Customers</h2>
        <p>Total Customers: <?php echo isset($customersResult['total_customers']) ? $customersResult['total_customers'] : 'N/A'; ?></p>
    </div>

    <div class="card">
        <h2>Number of Reservations</h2>
        <p>Total Reservations: <?php echo isset($reservationsResult['total_reservations']) ? $reservationsResult['total_reservations'] : 'N/A'; ?></p>
    </div>

    <div class="card">
        <h2>Total Revenue from Rentals</h2>
        <p>Total Revenue: <?php echo isset($totalRevenueResult['total_revenue']) ? '€' . number_format($totalRevenueResult['total_revenue'], 2) : 'N/A'; ?></p>
    </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

    <script>
        function toggleNav() {
            var sidebar = document.getElementById("sidebar");
            var menuIcon = document.getElementById("menu-icon");
            var content = document.getElementById("content");

            if (sidebar.style.left === "0px") {
                sidebar.style.left = "-250px";
                menuIcon.classList.add("closed");
                content.style.marginLeft = "0";
            } else {
                sidebar.style.left = "0";
                menuIcon.classList.remove("closed");
                content.style.marginLeft = "250px";
            }
        }
    </script>
    
</body>

</html>
 