<?php
class Animal {
    public function manger(): void {
        echo "Je mange.<br>";
    }
}

class Chien extends Animal {
    public function aboyer(): void {
        echo "Wouf !<br>";
    }
}

class Chat extends Animal {
    public function miauler(): void {
        echo "Miaou !<br>";
    }
}

$c = new Chien();
$c->manger();
$c->aboyer();

$chat = new Chat();
$chat->manger();
$chat->miauler();
//$c->miauler();
class Personne {
    public function __construct(protected string $nom) {}

    public function presentation(): string {
        return "Je suis " . $this->nom;
    }
}

class Etudiant extends Personne {
    public function __construct(
        string $nom,
        private string $filiere
    ) {
        parent::__construct($nom);
    }

    public function presentation(): string {
        return parent::presentation()
            . ", étudiant en " . $this->filiere;
    }
}

$e = new Etudiant("Ahmed", "Informatique");
echo $e->presentation() . "<br>";
class Base {
    final public function afficher(): void {
        echo "Méthode finale<br>";
    }
}

final class Outil {
    public const VERSION = "1.0";
}

class Produit {
    public function __construct(
        public readonly string $reference
    ) {}
}

$produit = new Produit("REF-001");
echo $produit->reference . "<br>";
//$produit->reference = "REF-002";