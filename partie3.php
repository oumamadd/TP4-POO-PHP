<?php
class Personne {
    private string $nom = "";
    private string $prenom = "";
    private string $dateNaissance = "";

        public function __set(string $name, mixed $value): void {
        if (!property_exists($this, $name)) {
            echo "Propriété $name inexistante<br>";
            return;
        }

        if ($name === "nom") {
            if (!is_string($value) || strlen(trim($value)) < 2) {
                throw new InvalidArgumentException(
                    "Le nom doit contenir au moins 2 caractères."
                );
            }

            $value = trim($value);
        }

        $this->$name = $value;
    }

    public function __get(string $name): mixed {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        return null;
    }

    public function __isset(string $name): bool {
        return isset($this->$name);
    }

    public function __unset(string $name): void {
        if (property_exists($this, $name)) {
            $this->$name = "";
        }
    }
}

$p = new Personne();

$p->nom = "Hachimi";
echo $p->nom . "<br>";

var_dump(isset($p->nom));
echo "<br>";

unset($p->nom);

var_dump(isset($p->nom));
echo "<br>";

$p->telephone = "0600000000";
try {
    $p->nom = "A";
} catch (InvalidArgumentException $e) {
    echo $e->getMessage() . "<br>";
}