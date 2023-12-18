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
            padding-right: 120px;
            width: 100%;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        table {
            overflow-x: scroll;
           text-align: start;
            width: 50%;
            margin: 20px auto;
            backdrop-filter: blur(15px);
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
            
        }

        th, td {
            color: white;
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
      
        }

        tbody tr:hover {
           
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
      
        
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'poppins',sans-serif;
}

body {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(https://wallpaperaccess.com/full/26894.jpg);
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
}

section {
    position: relative;
    max-width: 400px;
    background-color: transparent;
    border: 2px solid rgba(255, 255, 255, 0.5);
    border-radius: 20px;
    backdrop-filter: blur(55px);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 2rem 3rem;
}

h1 {
    font-size: 2rem;
    color: #fff;
    text-align: center;
}

.inputbox {
    position: relative;
    margin: 30px 0;
    max-width: 310px;
    border-bottom: 2px solid #fff;
}

.inputbox label {
    position: absolute;
    top: 50%;
    left: 5px;
    transform: translateY(-50%);
    color: #fff;
    font-size: 1rem;
    pointer-events: none;
    transition: all 0.5s ease-in-out;
}

input:focus ~ label, 
input:valid ~ label {
    top: -5px;
}

.inputbox input {
    width: 100%;
    height: 60px;
    background: transparent;
    border: none;
    outline: none;
    font-size: 1rem;
    padding: 0 35px 0 5px;
    color: #fff;
}

.inputbox ion-icon {
    position: absolute;
    right: 8px;
    color: #fff;
    font-size: 1.2rem;
    top: 20px;
}

.forget {
    margin: 35px 0;
    font-size: 0.85rem;
    color: #fff;
    display: flex;
    justify-content: space-between;
 
}

.forget label {
    display: flex;
    align-items: center;
}

.forget label input {
    margin-right: 3px;
}

.forget a {
    color: #fff;
    text-decoration: none;
    font-weight: 600;
}

.forget a:hover {
    text-decoration: underline;
}

button {
    width: 100%;
    height: 40px;
    border-radius: 40px;
    background-color: rgb(255, 255,255, 1);
    border: none;
    outline: none;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 600;
    transition: all 0.4s ease;
}

button:hover {
  background-color: rgb(255, 255,255, 0.5);
}

.register {
    font-size: 0.9rem;
    color: #fff;
    text-align: center;
    margin: 25px 0 10px;
}

.register p a {
    text-decoration: none;
    color: #fff;
    font-weight: 600;
}

.register p a:hover {
    text-decoration: underline;
}
    </style>
</head>

<body>


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
    <section>
        <form method="post" action="insertfactuur.php">
            <h1>Factuur Toevoegen</h1>

            <div class="inputbox">
                <ion-icon name="person-outline"></ion-icon>
                <input type="text" id="klantID" name="klantID" required>
                <label for="klantID">Klant ID</label>
            </div>

            <div class="inputbox">
                <ion-icon name="car-outline"></ion-icon>
                <input type="text" id="autoID" name="autoID" required>
                <label for="autoID">Auto ID</label>
            </div>

            <div class="inputbox">
                <ion-icon name="calendar-outline"></ion-icon>
                <input type="" id="verhuurdatum" name="verhuurdatum" required>
                <label for="verhuurdatum">Verhuurdatum</label>
            </div>

            <div class="inputbox">
                <ion-icon name="calendar-outline"></ion-icon>
                <input type="" id="eindVerhuurdatum" name="eindVerhuurdatum" required>
                <label for="eindVerhuurdatum">EindVerhuurdatum</label>
            </div>

            <div class="inputbox">
                <ion-icon name="cash-outline"></ion-icon>
                <input type="text" id="totaalBedrag" name="totaalBedrag" required>
                <label for="totaalBedrag">TotaalBedrag</label>
            </div>

            <button type="submit">Factuur Toevoegen</button>
        </form>
    </section>
</body>

</html>
