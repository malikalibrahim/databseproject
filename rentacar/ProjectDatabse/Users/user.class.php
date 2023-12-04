<?php
 
class User
{
    public string $Name;
    public string $Adres;
    public string $Rijbewijsnummer;
    public string $Telefoonnummer;
    public string $Emailadres;
    public string $Wachtwoord;
    

 
  
    public function __Construct(string $Name, string $Adres, string $Rijbewijsnummer, string $Telefoonnummer, string $Emailadres, string $Wachtwoord)
    {
        $this->Name = $Name;
        $this->Adres = $Adres;
        $this->Rijbewijsnummer = $Rijbewijsnummer;
        $this->Telefoonnummer = $Telefoonnummer;
        $this->Emailadres = $Emailadres;
        $this->Wachtwoord = $Wachtwoord;
 
        if (empty($this->Name) || empty($this->Adres)  || empty($this->Rijbewijsnummer) || empty($this->Telefoonnummer) || empty($this->Emailadres)
        || empty($this->Wachtwoord )) {
            throw new Exception("Fill in all fields.");
        }
    } 
     public function HashedPassword() : string
    {
        return password_hash($this->Wachtwoord, PASSWORD_DEFAULT);
    }
 
}
 
?>