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
    <style>
        body {
            background-color: #e9e9e9;
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            line-height: 1.25;
            letter-spacing: 1px;
            margin: 0;
            padding: 0;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(https://mcdn.wallpapersafari.com/medium/68/20/lqQvO8.jpg );
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            width: 100%;
    height: 100%;
        }
        

        * {
            box-sizing: border-box;
            transition: .25s all ease;
        }

        .login-container {
            display: block;
            position: relative;
            z-index: 0;
            margin: 4rem auto 0;
            padding: 5rem 4rem 0 4rem;
            width: 100%;
            max-width: 525px;
            min-height: 680px;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(https://mcdn.wallpapersafari.com/medium/68/20/lqQvO8.jpg);
            box-shadow: 0 50px 70px -20px rgba(0, 0, 0, 0.85);
        }

        .login-container:after {
            content: '';
            display: inline-block;
            position: absolute;
            z-index: 0;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
      
            box-shadow: 0 -20px 150px -20px rgba(0, 0, 0, 0.5);
        }

        .form-login {
            position: relative;
            z-index: 1;
            padding-bottom: 4.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.25);
        }

        .login__label,
        .login__label--checkbox {
            color: rgba(255, 255, 255, 0.5);
            text-transform: uppercase;
            font-size: .75rem;
            margin-bottom: 1rem;
        }

        .login__label--checkbox {
            display: inline-block;
            position: relative;
            padding-left: 1.5rem;
            margin-top: 2rem;
            margin-left: 1rem;
            color: #ffffff;
            font-size: .75rem;
            text-transform: inherit;
        }

        .login__input {
            color: white;
            font-size: 1.15rem;
            width: 100%;
            padding: .5rem 1rem;
            border: 2px solid transparent;
            outline: none;
            border-radius: 1.5rem;
            background-color: rgba(255, 255, 255, 0.25);
            letter-spacing: 1px;
        }

        .login__input:hover,
        .login__input:focus {
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.5);
            background-color: transparent;
        }

        .login__input+.login__label {
            margin-top: 1.5rem;
        }

        .login__input--checkbox {
            position: absolute;
            top: .1rem;
            left: 0;
            margin: 0;
        }

        .login__submit {
            color: #ffffff;
            font-size: 1rem;
            font-family: 'Montserrat', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 1rem;
            padding: .75rem;
            border-radius: 2rem;
            display: block;
            width: 100%;
            background-color: rgba(17, 97, 237, .75);
            border: none;
            cursor: pointer;
        }

        .login__submit:hover {
            background-color: rgba(17, 97, 237, 1);
        }

        .login__forgot {
            display: block;
            margin-top: 3rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.75);
            font-size: .75rem;
            text-decoration: none;
            position: relative;
            z-index: 1;
        }

        .login__forgot:hover {
            color: rgb(17, 97, 237);
        }
        .a{
            color: #e9e9e9;
        }
      
    </style>
</head>

<body>
    <div class="login-container">
        <h2 class="a">Edit User Information</h2>
        <form method="post" action="" class="form-login">
            <input type="hidden" name="klantID" value="<?php echo $user['KlantID']; ?>">
            
            <label for="login-input-user" class="login__label">
                Name
            </label>
            <input id="login-input-user" class="login__input" type="text" name="name" value="<?php echo $user['Naam']; ?>" required>

            <label for="login-input-address" class="login__label">
                Address
            </label>
            <input id="login-input-address" class="login__input" type="text" name="address" value="<?php echo $user['Adres']; ?>" required>

            <label for="login-input-rol" class="login__label">
                Rol
            </label>
            <input id="login-input-rol" class="login__input" type="text" name="rol" value="<?php echo $user['rol']; ?>" required>

            <label for="login-input-licenseNumber" class="login__label">
                License Number
            </label>
            <input id="login-input-licenseNumber" class="login__input" type="text" name="licenseNumber" value="<?php echo $user['Rijbewijsnummer']; ?>" required>

            <label for="login-input-phoneNumber" class="login__label">
                Phone Number
            </label>
            <input id="login-input-phoneNumber" class="login__input" type="text" name="phoneNumber" value="<?php echo $user['Telefoonnummer']; ?>" required>

            <label for="login-input-email" class="login__label">
                Email
            </label>
            <input id="login-input-email" class="login__input" type="email" name="email" value="<?php echo $user['Emailadres']; ?>" required>

            <label for="login-input-password" class="login__label">
                Password
            </label>
            <input id="login-input-password" class="login__input" type="password" name="password" value="<?php echo $user['Wachtwoord']; ?>" required>

            <button class="login__submit" type="submit" name="editUser">Save Changes</button>
        </form>
      
    </div>
</body>

</html>
