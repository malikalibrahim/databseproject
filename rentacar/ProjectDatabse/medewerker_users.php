<?php
// Include the Database class
include 'database.php'; // Replace with the actual file name

// Create an instance of the Database class
$database = new Database();

// Fetch customers for display
$customers = $database->selectklanten();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Management</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="styleadminuser.css">

</head>

<body>
  
      <div class="containerr">
        <!-- Display Customers -->
        <h2 class="mt-4 mb-3">Customers</h2>
        <div class="table-responsive">
            <table class="table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th>KlantID</th>
                        <th>Naam</th>
                        <th>Adres</th>
                        <th>Rol</th>
                        <th>Rijbewijsnummer</th>
                        <th>Telefoonnummer</th>
                        <th>Emailadres</th>
                        <th >Wachtwoord</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($customers)) : ?>
                        <?php foreach ($customers as $customer) : ?>
                            <tr id="wachtwoord">
                                <td><?= $customer['KlantID'] ?></td>
                                <td><?= $customer['Naam'] ?></td>
                                <td><?= $customer['Adres'] ?></td>
                                <td><?= $customer['rol'] ?></td>
                                <td><?= $customer['Rijbewijsnummer'] ?></td>
                                <td><?= $customer['Telefoonnummer'] ?></td>
                                <td><?= $customer['Emailadres'] ?></td>
                                <td ><?= $customer['Wachtwoord'] ?></td>
                             
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="9" class="text-center">No customers available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
       
    </div>

    <!-- Bootstrap JS (Popper.js and jQuery are required for Bootstrap) -->

</body>

</html>
