<?php
// Include the Database class
include 'database.php'; // Replace with the actual file name

// Create an instance of the Database class
$database = new Database();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addCustomer'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $address = $_POST['address'];
    $rol = $_POST['rol'];
    $licenseNumber = $_POST['licenseNumber'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Add customer to the database
    $database->addCustomer($name, $address, $rol, $licenseNumber, $phoneNumber, $email, $password);

    // Redirect to the same page to prevent form resubmission on page refresh
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

// Fetch customers for display
$customers = $database->fetchAllCustomers();
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
    <div class="container">
        <div class="forrm">
        <h1 class="mb-4 text-center">Customer Management</h1>
        <h2 class="mb-3">Add Customer</h2>

        <form method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Naam:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="address">Adres:</label>
                    <input type="text" name="address" class="form-control" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="rol">Rol:</label>
                    <input type="text" name="rol" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="licenseNumber">Rijbewijsnummer:</label>
                    <input type="text" name="licenseNumber" class="form-control" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="phoneNumber">Telefoonnummer:</label>
                    <input type="text" name="phoneNumber" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Emailadres:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password">Wachtwoord:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
            </div>
            <button type="submit" name="addCustomer" class="btn btn-primary">Add Customer</button>
        </form>
        </div>
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
                        <th>Action</th>
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
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn-sm"><a href="edit_customer.php?id=<?= $customer['KlantID'] ?>">Edit</a></button>
                                        <button type="button" class="btn-sms"><a href="update_customer.php?id=<?= $customer['KlantID'] ?>">Delete</a></button>
                                    </div>
                                </td>
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
