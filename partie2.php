<?php
class Voiture {
    public function __construct(
        public string $couleur = "Blanche",
        public int $vitesse = 0
    ) {}
        public function __destruct() {
        echo "Voiture {$this->couleur} détruite.<br>";
    }

    public function afficher(): void {
        echo "Couleur : {$this->couleur}"
            . " | Vitesse : {$this->vitesse} km/h<br>";
    }
}

$v1 = new Voiture();
$v2 = new Voiture("Rouge", 50);

$v1->afficher();
$v2->afficher();
$v3 = new Voiture("Noire");
$v3->afficher();

$v4 = new Voiture(120);
$v4->afficher();
echo "Avant unset.<br>";
//unset($v1);
$a = new Voiture("Bleue");
$b = new Voiture("Verte");
echo "Fin du script.<br>";