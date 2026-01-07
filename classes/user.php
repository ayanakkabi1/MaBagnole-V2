<?php
class user  {
    private int $id;
    private string $nom;
    private string $email;
    private string $motDePasseHash;
    private $date_creation;
    private string $role;

    public function __construct(int $id, string $nom, string $email, string $motDePasseHash,string $role) {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->motDePasseHash = $motDePasseHash;
        $this ->role=$role;
    }

    public function getId(): int 
    { 
        return $this->id; 
    }
    public function getNom(): string { return $this->nom; }
    public function getEmail(): string { return $this->email; }
    public function getRole():string{ return $this->role;}
    public function setNom(string $nom): void { $this->nom = $nom; }
    public function setEmail(string $email): void { $this->email = $email;}
    public function setRole(string $role):string{ return $this->role;}
}
?>