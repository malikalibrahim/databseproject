<?php
// Verbind met de database en haal de reserveringen op
include "database.php";
$db = new Database();

$reserveringen = $db->query("SELECT * FROM facturen");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserveringen</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tbody tr:hover {
            background-color: #f5f5f5;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            margin: 20px;
            border-radius: 5px;
        }

        p {
            text-align: center;
            color: #777;
            margin-top: 20px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            max-width: 100%;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        label {
            display: block;
            text-align: start;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #555;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h1>Reserveringen</h1>

    <?php if ($reserveringen->rowCount() > 0) : ?>
        <table>
            <thead>
                <tr>
                    <th>FactuurID</th>
                    <th>Auto ID</th>
                    <th>Auto Model</th>
                    <th>Klant ID</th>
                    <th>Klant Naam</th>
                    <th>Verhuurdatum</th>
                    <th>EindVerhuurdatum</th>
                    <th>TotaalBedrag</th>
                    <th>FactuurDatum</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reserveringen as $reservering) : ?>
                    <?php
                    // Haal auto-informatie op
                    $auto = $db->query("SELECT * FROM autos WHERE AutoID = :autoID", ['autoID' => $reservering['AutoID']])->fetch(PDO::FETCH_ASSOC);
                    // Haal klant-informatie op
                    $klant = $db->query("SELECT * FROM klanten WHERE KlantID = :klantID", ['klantID' => $reservering['KlantID']])->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <tr>
                        <td><?php echo $reservering['FactuurID']; ?></td>
                        <td><?php echo $reservering['AutoID']; ?></td>
                        <td><?php echo $auto['Model']; ?></td>
                        <td><?php echo $reservering['KlantID']; ?></td>
                        <td><?php echo $klant['Naam']; ?></td>
                        <td><?php echo $reservering['Verhuurdatum']; ?></td>
                        <td><?php echo $reservering['EindVerhuurdatum']; ?></td>
                        <td>&euro; <?php echo number_format($reservering['TotaalBedrag'], 2); ?></td>
                        <td><?php echo $reservering['FactuurDatum']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Er zijn geen reserveringen.</p>
    <?php endif; ?>

    <form method="post" action="insertfactuur.php">
        <label for="klantID">Klant ID:</label>
        <input type="text" id="klantID" name="klantID" required>

        <label for="autoID">Auto ID:</label>
        <input type="text" id="autoID" name="autoID" required>

        <label for="verhuurdatum">Verhuurdatum:</label>
        <input type="date" id="verhuurdatum" name="verhuurdatum" required>

        <label for="eindVerhuurdatum">EindVerhuurdatum:</label>
        <input type="date" id="eindVerhuurdatum" name="eindVerhuurdatum" required>

        <label for="totaalBedrag">TotaalBedrag:</label>
        <input type="text" id="totaalBedrag" name="totaalBedrag" required>

        <button type="submit">Factuur Toevoegen</button>
    </form>
</body>

</html>
