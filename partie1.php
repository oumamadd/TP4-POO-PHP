<?php
class Personne {
    public string $nom;
    public string $prenom;

    private string $dateNaissance;
    private string $villeNaissance;
    private string $cin;

    public function __construct(
        string $nom = "",
        string $prenom = "",
        string $dateNaissance = "",
        string $villeNaissance = "",
        string $cin = ""
    ) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance = $dateNaissance;
        $this->villeNaissance = $villeNaissance;
        $this->cin = $cin;

        echo "Création " . __CLASS__ . "<br>";
    }
        public static function depuisTableau(array $data): self {
        return new self(
            $data["nom"] ?? "",
            $data["prenom"] ?? "",
            $data["dateNaissance"] ?? "",
            $data["villeNaissance"] ?? "",
            $data["cin"] ?? ""
        );
    }
        public function __destruct() {
        echo "Détruire " . __CLASS__ . "<br>";
    }

    public function getName(): string {
        return $this->prenom . " " . $this->nom;
    }

    private function getAge(): int {
        $naissance = new DateTime($this->dateNaissance);
        $aujourdhui = new DateTime();

        return $naissance->diff($aujourdhui)->y;
    }
}

$p = new Personne(
    "Hachimi",
    "Sara",
    "2000-05-14",
    "Marrakech",
    "EE123456"
);

echo $p->getName() . "<br>";
echo $p->nom . "<br>";

// Tests d'accès interdit :
// echo $p->cin;
// echo $p->dateNaissance;
// echo $p->getAge();

$pVide = new Personne();

$pComplet = new Personne(
    "Hachimi",
    "Sara",
    "2000-05-14",
    "Marrakech",
    "EE123456"
);
$pTableau = Personne::depuisTableau([
    "nom" => "Alami",
    "prenom" => "Amal",
    "dateNaissance" => "2002-03-10",
    "villeNaissance" => "Rabat",
    "cin" => "AB123456"
]);

echo $pTableau->getName() . "<br>";