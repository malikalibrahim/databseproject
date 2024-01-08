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
                <a href="admin_users.php">
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
    <div id="menu-icon" onclick="toggleNav()"><i class="fas fa-bars"></i></div>

<div class="content">
    <div class="dashboard-info">
        <h2>Car Rental Admin Dashboard</h2>
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


    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>