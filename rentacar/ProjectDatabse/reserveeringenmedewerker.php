<?php
// Verbind met de database en haal de reserveringen op
include "Database.php";
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
</body>

</html>
