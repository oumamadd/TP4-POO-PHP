<?php
class Personne {
    private string $nom;
    private string $prenom;
    private string $dateNaissance;
    private string $villeNaissance;
    private string $cin;

    public function __construct(
        string $nom,
        string $prenom,
        string $dateNaissance,
        string $villeNaissance,
        string $cin
    ) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance = $dateNaissance;
        $this->villeNaissance = $villeNaissance;
        $this->cin = $cin;
    }

    private function getAge(): int {
        $naissance = new DateTime($this->dateNaissance);
        $aujourdhui = new DateTime();

        return $naissance->diff($aujourdhui)->y;
    }

    public function __toString(): string {
        return $this->prenom . " " . $this->nom
            . " (" . $this->getAge() . " ans)";
    }
}

class Etudiant extends Personne {
    private string $cne;

    public function __construct(
        string $nom,
        string $prenom,
        string $dateNaissance,
        string $villeNaissance,
        string $cin,
        string $cne
    ) {
        parent::__construct(
            $nom,
            $prenom,
            $dateNaissance,
            $villeNaissance,
            $cin
        );

        $this->cne = $cne;
    }

    public function getCne(): string {
        return $this->cne;
    }

         public function __toString(): string {
        return parent::__toString() . " | CNE : " . $this->cne;
    }
}

$etudiants = [];

$etudiants[] = new Etudiant(
    "Hachimi", "Sara", "2000-05-14",
    "Marrakech", "EE123456", "CNE001"
);

$etudiants[] = new Etudiant(
    "Alami", "Ahmed", "2003-02-10",
    "Rabat", "AB123456", "CNE002"
);

$etudiants[] = new Etudiant(
    "Bennani", "Amal", "2004-07-20",
    "Fès", "CD123456", "CNE003"
);

$etudiants[] = new Etudiant(
    "Idrissi", "Youssef", "2002-09-15",
    "Casablanca", "EF123456", "CNE004"
);

$etudiants[] = new Etudiant(
    "Naciri", "Lina", "2005-01-08",
    "Agadir", "GH123456", "CNE005"
);

foreach ($etudiants as $e) {
    echo $e . "<br>";
}