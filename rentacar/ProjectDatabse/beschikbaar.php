<?php
// setBeschikbaarheid.php

session_start();
include "Database.php";

$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['verzend_naar_nul'])) {
        $id = $_POST['opnull'];
        $updateAutoSql = "UPDATE autos SET Beschikbaarheid = '0' WHERE AutoID = :AutoID";
    } elseif (isset($_POST['verzend_naar_een'])) {
        $id = $_POST['opnul'];
        $updateAutoSql = "UPDATE autos SET Beschikbaarheid = '1' WHERE AutoID = :AutoID";
    } else {
        echo "Invalid form submission.";
        exit();
    }

    $updateAutoStmt = $db->pdo->prepare($updateAutoSql);
    $updateAutoStmt->execute(['AutoID' => $id]);

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
        /* Reset some default styles and set a base font */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        /* Style the forms */
        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        /* Style the input fields */
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border 0.3s;
        }

        /* Change input border color on focus */
        input[type="text"]:focus {
            border-color: #4caf50;
        }

        /* Style the submit buttons */
        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        /* Change button background color on hover */
        input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Add some spacing between form elements */
        form > * {
            margin-bottom: 15px;
        }

        /* Style the page title */
        h1 {
            text-align: center;
            color: #4caf50;
        }
       
                .auto-info {
                    border: 1px solid #ddd;
                    width: 150px;
                    padding: 10px;
                    margin-bottom: 20px;
                    border-radius: 8px;
                    background-color: #f9f9f9;
                }

                .auto-info h3 {
                    color: #333;
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
                .hoofdpagina{
                    display: flex;
                    flex-wrap: wrap;
                    gap: 14px;
                    padding-left: 20px
                }
         
    </style>
</head>
<body>
    <h1>Beschikbaarheid</h1>

    <form action="" method="POST">
        <label for="opnull">Zet auto op Beschikbaar:</label>
        <input type="text" id="opnull" name="opnull" placeholder="Voer een ID">
        <input type="submit" name="verzend_naar_nul" value="Beschikbaar">
    </form>

    <form action="" method="POST">
        <label for="opnul">Verwijder Auto:</label>
        <input type="text" id="opnul" name="opnul" placeholder="Voer een ID ">
        <input type="submit" name="verzend_naar_een" value="Niet Beschikbaar">
    </form>
    <div><h1>Verwijderde Auto's</h1></div> 
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
