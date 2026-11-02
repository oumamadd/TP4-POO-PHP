<?php
class Compte {
    private float $montant;
    private float $interet;

    public function __construct(
        float $montantInitial,
        float $interet
    ) {
        $this->montant = $montantInitial;
        $this->interet = $interet;
    }

    public function get_montant(): float {
        return $this->montant;
    }

    public function un_an(): void {
        $this->montant *= (1 + $this->interet / 100);
    }
}

$c1 = new Compte(400, 10);
$c2 = new Compte(2500, 5);

for ($i = 1; $i <= 10; $i++) {
    $c1->un_an();
    $c2->un_an();
}

echo "Compte 1 après 10 ans : "
    . number_format($c1->get_montant(), 2, ',', ' ')
    . " DH<br>";

echo "Compte 2 après 10 ans : "
    . number_format($c2->get_montant(), 2, ',', ' ')
    . " DH<br>";