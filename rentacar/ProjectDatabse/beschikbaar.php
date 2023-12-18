<?php
// setBeschikbaarheid.php

session_start();
include "Database.php";

$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['verzend_naar_nul'])) {
        $Kenteken = $_POST['opnull'];
        $updateAutoSql = "UPDATE autos SET Beschikbaarheid = '0' WHERE Kenteken = :Kenteken";
    } elseif (isset($_POST['verzend_naar_een'])) {
        $Kenteken = $_POST['opnul'];
        $updateAutoSql = "UPDATE autos SET Beschikbaarheid = '1' WHERE Kenteken = :Kenteken";
    } else {
        echo "Invalid form submission.";
        exit();
    }

    $updateAutoStmt = $db->pdo->prepare($updateAutoSql);
    $updateAutoStmt->execute(['Kenteken' => $Kenteken]);

    // Voeg andere logica toe indien nodig

    // Stuur de gebruiker terug naar de pagina met de lijst van auto's
    header("Location: homepagina.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beschikbaar</title>
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(#141e30, #243b55);
            width: 100%;
            height: 100vh;
            
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background: rgba(0,0,0,.5);
            box-sizing: border-box;
            box-shadow: 0 15px 25px rgba(0,0,0,.6);
            border-radius: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px 0;
            font-size: 16px;
            color: #fff;
            margin-bottom: 30px;
            border: none;
            border-bottom: 1px solid #fff;
            outline: none;
            background: transparent;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus {
            border-color: #03e9f4;
        }

        input[type="submit"] {
            position: relative;
            display: inline-block;
            padding: 10px 20px;
            color: #03e9f4;
            font-size: 16px;
            text-decoration: none;
            text-transform: uppercase;
            overflow: hidden;
            transition: .5s;
            margin-top: 40px;
            letter-spacing: 4px;
            background: transparent;
            border: 2px solid #03e9f4;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background: #03e9f4;
            color: #fff;
            box-shadow: 0 0 5px #03e9f4, 0 0 25px #03e9f4, 0 0 50px #03e9f4, 0 0 100px #03e9f4;
            border-radius: 5px;
        }

        form > * {
            margin-bottom: 15px;
            color: #ddd;
        }

        h1 {
            text-align: center;
            color: #fff;
        }

        .auto-info {
            backdrop-filter: blur(30px);
            background: rgba(0,0,0,.5);
            width: 150px;
            padding: 10px;
            color: white;
            margin-bottom: 20px;
            border-radius: 8px;
        
        }

        .auto-info h3 {
            color: #white;
        }

        .auto-info p {
            margin: 5px 0;
        }

        .auto-image {
            max-width: 100%;
            height: auto;
            display: block;
            margin-top: 10px;
            border-radius: 4px;
        }

        .hoofdpagina {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            padding-left: 20px;
            width: 98%;
            
            backdrop-filter: blur(15px);
        }
    </style>
</head>
<body>
    <h1>Beschikbaarheid</h1>

    <form action="" method="POST">
        <label for="opnull">Zet auto op Beschikbaar:</label>
        <input type="text" id="opnull" name="opnull" placeholder="Voer een Kenteken">
        <input type="submit" name="verzend_naar_nul" value="Beschikbaar">
    </form>

    <form action="" method="POST">
        <label for="opnul">Verwijder Auto:</label>
        <input type="text" id="opnul" name="opnul" placeholder="Voer een Kenteken">
        <input type="submit" name="verzend_naar_een" value="Niet Beschikbaar">
    </form>

    <div>
        <h1>Verwijderde Auto's</h1>
    </div>
</body>
</html>

    <div class="hoofdpagina">
       
    <?php
    $cars = $db->selectdeletedCars();

    foreach ($cars as $car) {
        ?>
        <div class="auto-info">
            <h3>Auto ID: <?php echo $car['AutoID']; ?></h3>
            <p><strong>Merk:</strong> <?php echo $car['Merk']; ?></p>
            <p><strong>Model:</strong> <?php echo $car['Model']; ?></p>
            <p><strong>Jaar:</strong> <?php echo $car['Jaar']; ?></p>
            <p><strong>Kenteken:</strong> <?php echo $car['Kenteken']; ?></p>
            <p><strong>Beschikbaarheid:</strong> <?php echo $car['Beschikbaarheid']; ?></p>
            <p><strong>Prijs:</strong> <?php echo $car['Prijs']; ?></p>
            <!-- Voeg andere velden toe indien nodig -->

            <!-- Voeg CSS-stijlen toe voor de auto-info div -->
          
        </div>
        <?php
    }
    ?>
</div>

</body>
</html>
