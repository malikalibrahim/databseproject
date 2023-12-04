<?php

class Database {
    private $pdo;

    private $carsTable = "autos";
    private $customerTable = "klanten";

    public function __construct($db = 'autosverkopen', $user = 'root', $pass = '', $host = 'localhost:3306') {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    private function validateInput(string $input) : string {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    public function createCustomerAccount($name, $email, $password, $address,  $licenseNumber, $phoneNumber,) : void {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        $sql = "INSERT INTO klanten (Naam, Adres, Rijbewijsnummer, Emailadres, Telefoonnummer, Wachtwoord) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name, $address, $licenseNumber, $email, $phoneNumber, $hashedPassword]);
    }
    
    
    
    
    public function customerLogin($email, $password): bool {
        $sql = "SELECT * FROM klanten WHERE Emailadres = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return ($user && password_verify($password, $user['Wachtwoord']));
    }

    public function employeeLogin(string $username, string $password): bool {
        $sql = "SELECT * FROM medewerkers WHERE Gebruikersnaam = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return ($user && password_verify($password, $user['Wachtwoord']));
    }

    public function addCar($brand, $model, $year, $licensePlate, $availability) : void {
        $brand = $this->validateInput($brand);
        $model = $this->validateInput($model);
        $year = $this->validateInput($year);
        $licensePlate = $this->validateInput($licensePlate);
        $availability = $this->validateInput($availability);
        $sql = "INSERT INTO $this->carsTable (Merk, Model, Jaar, Kenteken, Beschikbaarheid) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$brand, $model, $year, $licensePlate, $availability]);
    }

    public function addCustomer(string $name, string $address, string $licenseNumber, 
                                string $phoneNumber, string $email) :void {
        $name = $this->validateInput($name);
        $address = $this->validateInput($address);
        $licenseNumber = $this->validateInput($licenseNumber);
        $phoneNumber = $this->validateInput($phoneNumber);
        $email = $this->validateInput($email);
        $sql = "INSERT INTO klanten (Naam, Adres, Rijbewijsnummer, Telefoonnummer, Emailadres) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name, $address, $licenseNumber, $phoneNumber, $email]);
    }

    public function rentCar($rentDate, $customerID, $carID, $rentPeriod) {
        try {
            // Stap 1: Validatie van invoer
            $rentDate = $this->validateInput($rentDate);
            $customerID = (int) $customerID;
            $carID = (int) $carID;
            $rentPeriod = $this->validateInput($rentPeriod);

            // Stap 2: Controleer de beschikbaarheid van de auto
            $availability = $this->checkCarAvailability($carID);
            if ($availability !== 'beschikbaar') {
                die("De geselecteerde auto is niet beschikbaar voor verhuur.");
            }

            // Stap 3: Bereken de kosten (voorbeeld: $10 per dag)
            $costPerDay = 10;
            $totalCost = $costPerDay * (int)$rentPeriod;

            // Stap 4: Voeg verhuurinformatie toe aan de database
            $this->pdo->beginTransaction(); // Begin transactie

            $sqlInsert = "INSERT INTO verhuringen (Verhuurdatum, KlantID, AutoID, Huurperiode, Kosten) VALUES (?, ?, ?, ?, ?)";
            $stmtInsert = $this->pdo->prepare($sqlInsert);
            $stmtInsert->execute([$rentDate, $customerID, $carID, $rentPeriod, $totalCost]);

            // Stap 5: Markeer de auto als niet beschikbaar na verhuur
            $this->updateCarAvailability($carID, 'niet beschikbaar');

            $this->pdo->commit(); // Commit transactie

            // Verhuur succesvol
            echo "Auto succesvol verhuurd. Totale kosten: $totalCost euro.";
        } catch (PDOException $e) {
            $this->pdo->rollBack(); // Rollback transactie bij fout
            die("Verhuurproces mislukt: " . $e->getMessage());
        }
    }
    
    // Hulpmethoden
    private function checkCarAvailability($carID): string {
        $sql = "SELECT Beschikbaarheid FROM $this->carsTable WHERE AutoID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$carID]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result['Beschikbaarheid'];
    }
    
    
    private function updateCarAvailability($carID, $availability): void {
        $sql = "UPDATE $this->carsTable SET Beschikbaarheid = ? WHERE AutoID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$availability, $carID]);
    }
    
    

    public function getRentalHistory(): array {
        $sql = "SELECT verhuringen.VerhuurID, verhuringen.Verhuurdatum, klanten.Naam AS KlantNaam, $this->carsTable.Merk, $this->carsTable.Model, verhuringen.Huurperiode, verhuringen.Kosten
                FROM verhuringen
                JOIN klanten ON verhuringen.KlantID = klanten.KlantID
                JOIN $this->carsTable ON verhuringen.AutoID = $this->carsTable.AutoID";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function getReservedCarsForToday(): array {
        $today = date('Y-m-d');
        $sql = "SELECT $this->carsTable.Merk, $this->carsTable.Model, klanten.Naam AS KlantNaam, verhuringen.Huurperiode
                FROM verhuringen
                JOIN klanten ON verhuringen.KlantID = klanten.KlantID
                JOIN $this->carsTable ON verhuringen.AutoID = $this->carsTable.AutoID
                WHERE verhuringen.Verhuurdatum = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$today]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>
