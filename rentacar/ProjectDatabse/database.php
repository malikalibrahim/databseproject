<?php

class Database {
    public $pdo; 
  
    private $carsTable = "autos";
    

    public function __construct($db = 'autosverkopen', $user = 'root', $pass = '', $host = 'localhost:3306') {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    public function selectCarByID($autoID) {
        try {
            $autoID = (int)$autoID;

            // Voorbereid statement om SQL Injection te voorkomen
            $stmt = $this->pdo->prepare("SELECT * FROM $this->carsTable WHERE AutoID = ?");
            $stmt->execute([$autoID]);

            // Haal de auto-informatie op
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $result;
            } else {
                return null; // Geen auto gevonden met dit ID
            }
        } catch (PDOException $e) {
            die("Error fetching car information: " . $e->getMessage());
        }
    }

    public function selectAllCars() {
        $sql = "SELECT * FROM $this->carsTable WHERE Beschikbaarheid = 0 ";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
    public function selectadminAllCars() {
        $sql = "SELECT * FROM $this->carsTable";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function deleteCustomer($klantID): bool {
        try {
            // Validate input
            $klantID = (int) $klantID;
    
            // Verwijder klant uit de database
            $sql = "DELETE FROM klanten WHERE KlantID = :KlantID";
            $stmt = $this->pdo->prepare($sql);
            $success = $stmt->execute(['KlantID' => $klantID]);
    
            return $success;
        } catch (PDOException $e) {
            die("Fout bij het verwijderen van de klant: " . $e->getMessage());
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
    
    
    public function selectDataByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM klanten WHERE Emailadres = :Emailadres");
        $stmt->execute(['Emailadres' => $email]);
 
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function addUser(User $user) {
        $sql = "INSERT INTO klanten (Naam, Adres, Rijbewijsnummer,Telefoonnummer,Emailadres, Wachtwoord ) VALUES (:Naam, :Adres, :Rijbewijsnummer, :Telefoonnummer, :Emailadres, :Wachtwoord)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "Naam" => $user->Name,
            "Adres" => $user->Adres,
            "Rijbewijsnummer" => $user->Rijbewijsnummer,
            "Telefoonnummer" => $user->Telefoonnummer,
            "Emailadres" => $user->Emailadres,
            "Wachtwoord" => $user->HashedPassword()
        ]);
    }
    public function customerLogin($email, $password): bool {
        $sql = "SELECT * FROM klanten WHERE Emailadres = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {

            if (password_verify($password, $user['Wachtwoord'])) {
                return true;
            } elseif ($password == $user['Wachtwoord']) {
                return true;
            }
        }
        return false;
    }
    public function getRoleByEmail($email) {
        $sql = "SELECT rol FROM klanten WHERE Emailadres = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['rol'];
    }
    public function employeeLogin(string $username, string $password): bool {
        $sql = "SELECT * FROM medewerkers WHERE Gebruikersnaam = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return ($user && password_verify($password, $user['Wachtwoord']));
    }

    public function addCar($brand, $model, $year, $licensePlate, $availability, $price, $image) : void {
        $brand = $this->validateInput($brand);
        $model = $this->validateInput($model);
        $year = $this->validateInput($year);
        $licensePlate = $this->validateInput($licensePlate);
        $availability = $this->validateInput($availability);
        $price = $this->validateInput($price);
        $image = $this->validateInput($image);
        $sql = "INSERT INTO $this->carsTable (Merk, Model, Jaar, Kenteken, Beschikbaarheid, Prijs, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$brand, $model, $year, $licensePlate, $availability, $price, $image]);
    }
    

    public function addCustomer(string $name, string $address, string $rol, string $licenseNumber, string $phoneNumber, string $email, string $password): void {
        try {
            $name = $this->validateInput($name);
            $address = $this->validateInput($address);
            $rol = $this->validateInput($rol);
            $licenseNumber = $this->validateInput($licenseNumber);
            $phoneNumber = $this->validateInput($phoneNumber);
            $email = $this->validateInput($email);
            $password = password_hash($password, PASSWORD_DEFAULT);
    
            $sql = "INSERT INTO klanten (Naam, Adres, rol, Rijbewijsnummer, Telefoonnummer, Emailadres, Wachtwoord) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$name, $address, $rol, $licenseNumber, $phoneNumber, $email, $password]);
    
        } catch (PDOException $e) {
            die("Error adding customer: " . $e->getMessage());
        }
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
    public function searchCars($searchTerm) {
        try {
            // Use prepared statements to prevent SQL injection
            $searchTerm = "%{$searchTerm}%";
            $sql = "SELECT * FROM $this->carsTable WHERE Merk LIKE ? OR Model LIKE ? OR Jaar LIKE ? OR Kenteken LIKE ? OR Beschikbaarheid LIKE ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Search failed: " . $e->getMessage());
        }
    }
    public function getKlantIDByEmail($email) {
        $sql = "SELECT KlantID FROM klanten WHERE Emailadres = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['KlantID'];
    }
    public function getPricePerDay($autoID) {
        $sql = "SELECT Prijs FROM autos WHERE AutoID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$autoID]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['Prijs'];
    }
    public function getCustomerByID($klantID) {
        $query = "SELECT * FROM klanten WHERE KlantID = :klantID";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':klantID', $klantID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();

        return $stmt;
    }

    public function queryForCustomer($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }
    }
  

    public function getCarPrice($autoID) {
        $sql = "SELECT Prijs FROM autos WHERE AutoID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$autoID]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['Prijs'];
    }
    public function editUser($klantID, $name, $address, $rol, $licenseNumber, $phoneNumber, $email, $password): bool {
        try {
            // Validate input
            $klantID = (int)$klantID;
            $name = $this->validateInput($name);
            $address = $this->validateInput($address);
            $rol = $this->validateInput($rol);
            $licenseNumber = $this->validateInput($licenseNumber);
            $phoneNumber = $this->validateInput($phoneNumber);
            $email = $this->validateInput($email);
            $password = password_hash($password, PASSWORD_DEFAULT);
    
            // Update gebruikersinformatie
            $sql = "UPDATE klanten SET Naam = ?, Adres = ?, rol = ?, Rijbewijsnummer = ?, Telefoonnummer = ?, Emailadres = ?, Wachtwoord = ? WHERE KlantID = ?";
            $stmt = $this->pdo->prepare($sql);
            $success = $stmt->execute([$name, $address, $rol, $licenseNumber, $phoneNumber, $email, $password, $klantID]);
    
            return $success;
        } catch (PDOException $e) {
            die("Fout bijwerken gebruikersinformatie: " . $e->getMessage());
        }
    }
    
    public function addReservering($verhuurdatum, $eindVerhuurdatum, $klantID, $autoID, $totaalBedrag) {
        $sql = "INSERT INTO verhuringen (Verhuurdatum, endVerhuurdatum, KlantID, AutoID, Huurperiode, Kosten) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$verhuurdatum, $eindVerhuurdatum, $klantID, $autoID, $totaalBedrag]);
    }
    public function editCarWithoutImage($autoID, $merk, $model, $jaar, $kenteken, $beschikbaarheid, $prijs): void {
        try {
            // Validate input
            $autoID = (int) $autoID;
            $merk = $this->validateInput($merk);
            $model = $this->validateInput($model);
            $jaar = (int) $jaar;
            $kenteken = $this->validateInput($kenteken);
            $beschikbaarheid = $this->validateInput($beschikbaarheid);
            $prijs = (float) $prijs;
    
            // Update car information
            $sql = "UPDATE $this->carsTable SET Merk = ?, Model = ?, Jaar = ?, Kenteken = ?, Beschikbaarheid = ?, Prijs = ? WHERE AutoID = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$merk, $model, $jaar, $kenteken, $beschikbaarheid, $prijs, $autoID]);
    
            echo "Auto-informatie (zonder afbeelding) succesvol bijgewerkt.";
        } catch (PDOException $e) {
            die("Fout bijwerken auto-informatie: " . $e->getMessage());
        }
    }
    
    public function editCar($autoID, $image, $merk, $model, $jaar, $kenteken, $beschikbaarheid, $prijs): void {
        try {
            // Validate input
            $autoID = (int) $autoID;
            $image = $this->validateInput($image);
            $merk = $this->validateInput($merk);
            $model = $this->validateInput($model);
            $jaar = (int) $jaar;
            $kenteken = $this->validateInput($kenteken);
            $beschikbaarheid = $this->validateInput($beschikbaarheid);
            $prijs = (float) $prijs;
    
            // Update car information
            $sql = "UPDATE $this->carsTable SET image = ?, Merk = ?, Model = ?, Jaar = ?, Kenteken = ?, Beschikbaarheid = ?, Prijs = ? WHERE AutoID = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$image, $merk, $model, $jaar, $kenteken, $beschikbaarheid, $prijs, $autoID]);
    
            echo "Auto-informatie succesvol bijgewerkt.";
        } catch (PDOException $e) {
            die("Fout bijwerken auto-informatie: " . $e->getMessage());
        }
    }
    public function deleteCar($autoID): bool {
        try {
            // Validate input
            $autoID = (int) $autoID;
    
            // Delete car from the database
            $sql = "DELETE FROM $this->carsTable WHERE AutoID = :AutoID";
            $stmt = $this->pdo->prepare($sql);
            $success = $stmt->execute(['AutoID' => $autoID]);
    
            return $success;
        } catch (PDOException $e) {
            die("Fout bij verwijderen auto: " . $e->getMessage());
        }
    }
    
    public function addAdminUser($name, $email, $password, $address, $licenseNumber, $phoneNumber) : void {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO admins (Name, Address, LicenseNumber, Email, PhoneNumber, Password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name, $address, $licenseNumber, $email, $phoneNumber, $hashedPassword]);
    }

    // Add a new method to edit an admin user
    public function editAdminUser($adminID, $name, $email, $address, $licenseNumber, $phoneNumber) {
        try {
            // Validate input
            $adminID = (int) $adminID;
            $name = $this->validateInput($name);
            $email = $this->validateInput($email);
            $address = $this->validateInput($address);
            $licenseNumber = $this->validateInput($licenseNumber);
            $phoneNumber = $this->validateInput($phoneNumber);

            // Update admin user information
            $sql = "UPDATE admins SET Name = ?, Address = ?, LicenseNumber = ?, Email = ?, PhoneNumber = ? WHERE AdminID = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$name, $address, $licenseNumber, $email, $phoneNumber, $adminID]);

            echo "Admin Gebruikerinformatie succesvol bijgewerkt.";
        } catch (PDOException $e) {
            die("Fout bijwerken admin gebruikerinformatie: " . $e->getMessage());
        }
    }
    public function fetchAllCustomers() {
        try {
            $sql = "SELECT * FROM klanten";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error fetching customers: " . $e->getMessage());
        }
    }

    public function selectklanten() {
        try {
            $sql = "SELECT * FROM klanten WHERE rol = '0' OR rol = 'medewerker'";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error fetching customers: " . $e->getMessage());
        }
    }
}    
    

    

?>
