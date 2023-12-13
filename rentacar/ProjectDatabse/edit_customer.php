<?php
include 'database.php';

$database = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editUser'])) {
    $klantID = $_POST['klantID'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $rol = $_POST['rol'];
    $licenseNumber = $_POST['licenseNumber'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Bewerk de gebruikersinformatie
    $database->editUser($klantID, $name, $address, $rol, $licenseNumber, $phoneNumber, $email, $password);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $klantID = $_GET['id'];

    // Haal de gebruikersinformatie op
    $user = $database->getCustomerByID($klantID);

    if (!$user) {
        echo "Gebruiker niet gevonden.";
        exit();
    }
} else {
    header("Location:admin_users.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>

<body>
    <h2>Edit User Information</h2>
    <form method="post" action="">
        <input type="hidden" name="klantID" value="<?php echo $user['KlantID']; ?>">
        
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $user['Naam']; ?>" required><br>

        <label>Address:</label>
        <input type="text" name="address" value="<?php echo $user['Adres']; ?>" required><br>

        <label>Rol:</label>
        <input type="text" name="rol" value="<?php echo $user['rol']; ?>" required><br>

        <label>License Number:</label>
        <input type="text" name="licenseNumber" value="<?php echo $user['Rijbewijsnummer']; ?>" required><br>

        <label>Phone Number:</label>
        <input type="text" name="phoneNumber" value="<?php echo $user['Telefoonnummer']; ?>" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $user['Emailadres']; ?>" required><br>

        <label>Password:</label>
        <input type="password" name="password" value="<?php echo $user['Wachtwoord']; ?>" required><br>

        <button type="submit" name="editUser">Save Changes</button>
    </form>
</body>

</html>
