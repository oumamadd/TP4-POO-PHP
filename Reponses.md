# TP4 – Réponses aux questions

## Partie 0

### 0.3
Non, $v1 et $v2 ne partagent pas la même valeur de marque.
Chaque objet possède ses propres propriétés :
$v1 a pour marque Toyota et $v2 a pour marque Renault.
## Partie 1

### 1.1
L'accès depuis l'extérieur aux propriétés privées cin et
dateNaissance provoque « Cannot access private property ».
L'appel de getAge() provoque « Call to private method ».

### 1.2
Si cin était public, le code extérieur pourrait lire et modifier
directement cette donnée personnelle, sans contrôle ni validation.

### 1.3
Non, getAge() n'est pas inutile. Une méthode de Personne peut
l'appeler avec $this->getAge(), par exemple pour afficher l'âge.

### 1.4
Depuis l'extérieur, l'accès reste interdit avec protected.
La différence est que les classes filles peuvent accéder
aux membres protected, contrairement aux membres private.
## Partie 2

### 2.1.a
new Voiture("Noire") crée une voiture noire avec une vitesse de 0.

new Voiture(120), sans strict_types, convertit 120 en chaîne :
la couleur devient "120" et la vitesse reste 0.
Avec strict_types=1, cet appel provoquerait une TypeError.

### 2.1.b
La promotion de propriétés permet de déclarer et d'initialiser
les propriétés directement dans les paramètres du constructeur.
Elle réduit le code répétitif.
### 2.2.a
PHP interdit de déclarer deux constructeurs dans une même classe,
même avec des paramètres différents.
L'erreur obtenue est : Cannot redeclare Personne::__construct().

### 2.2.b
On utilise un seul constructeur avec des valeurs par défaut.
Cela permet de créer un objet sans arguments avec new Personne(),
ou avec des informations en passant les arguments.
### 2.2.c
Une méthode statique de fabrique crée et retourne un objet.
Par exemple, Personne::depuisTableau($data) permet de créer
une personne à partir des informations d'un tableau.
Elle s'appelle sur la classe, sans objet préalable.
### 2.3.a
Avec unset(), l'ordre des trois messages de l'exemple est :
1. Voiture Blanche créée.
2. Voiture Blanche détruite.
3. Fin du script.

### 2.3.b
Sans unset(), la destruction a lieu à la fin du script :
1. Voiture Blanche créée.
2. Fin du script.
3. Voiture Blanche détruite.

### 2.3.c
Dans notre test, $b (Verte) est détruit avant $a (Bleue).
Il ne faut pas dépendre de cet ordre dans un programme.

### 2.3.d
Le destructeur ajouté à Personne est :

public function __destruct() {
    echo "Détruire " . __CLASS__ . "<br>";
}

Il affiche « Détruire Personne » à la destruction de chaque objet.
## Partie 3

### 3.1
__set() modifie une propriété existante.
__get() retourne sa valeur, ou null si elle n'existe pas.
__isset() vérifie si sa valeur est définie et non nulle.
__unset() remet sa valeur à une chaîne vide.

Résultats du test :
Hachimi
bool(true)
bool(true)
Propriété telephone inexistante

Le deuxième isset() retourne true car "" n'est pas null.

### 3.2
Sans __set(), modifier une propriété privée depuis l'extérieur
provoque une erreur. Avec __set(), PHP appelle cette méthode,
qui décide si la modification est autorisée.

### 3.3
Oui, un __set() qui autorise toutes les modifications sans contrôle
peut affaiblir l'encapsulation. Il faut contrôler les propriétés
accessibles et valider les valeurs reçues.

### 3.4
Dans __set(), on vérifie que le nom est une chaîne et que
strlen(trim($value)) est supérieur ou égal à 2.
Sinon, on lance une InvalidArgumentException.
## Partie 4

### 4.1
getAge() est accessible depuis __toString() car les deux méthodes
appartiennent à la classe Personne. private interdit l'appel
depuis l'extérieur, mais autorise l'appel dans la classe.

### 4.2
Sans strict_types, l'entier 123 est converti en chaîne "123".
Avec strict_types=1 dans ce fichier, retourner cet entier
provoquerait une TypeError : le retour doit être une chaîne.

### 4.3
__toString() donne une représentation textuelle de l'objet.
Elle est appelée automatiquement, par exemple :
- lors de echo $p ;
- lors d'une concaténation : "Personne : " . $p.

getName() doit être appelée explicitement.
## Partie 5

### 5.1
Le mot de passe ne figure pas dans la chaîne, car __serialize()
retourne uniquement le nom et l'âge.

### 5.2
Sans __serialize(), le mot de passe apparaît dans la chaîne,
même si la propriété est privée. La sérialisation ne chiffre
pas les données : cela peut exposer des informations sensibles.

### 5.3
Après unserialize(), le mot de passe vaut "" car __unserialize()
le réinitialise. Dans une vraie application, il faut prévoir
une authentification et stocker un hachage du mot de passe,
jamais le mot de passe en clair.

### 5.4
Des données non fiables peuvent provoquer une injection d'objets
PHP : la reconstruction d'objets peut déclencher des méthodes
magiques et des comportements dangereux.
Pour échanger des données, on préfère JSON avec json_encode()
et json_decode(), puis on valide les données reçues.
## Partie 6

### 6.1.a
La classe Chat hérite d'Animal avec extends et définit
sa propre méthode miauler(). Elle hérite aussi de manger().

### 6.1.b
Non, $c->miauler() provoque :
Call to undefined method Chien::miauler().
La méthode appartient à Chat, pas à Chien ni à Animal.

### 6.2.a
Sans parent::__construct($nom), la propriété nom n'est pas
initialisée. L'appel de presentation() provoque :
Typed property Personne::$nom must not be accessed before initialization.

### 6.2.b
protected permet à Personne et à ses classes filles d'accéder
directement à nom. private réserverait cet accès à Personne.
Dans cet exemple précis, private fonctionnerait aussi, car
Etudiant utilise les méthodes du parent pour manipuler nom.
### 6.3.a
1. Redéfinir afficher() dans Fille provoque :
   Cannot override final method Base::afficher().

2. Faire hériter SousOutil d'Outil provoque :
   Class SousOutil cannot extend final class Outil.

3. Modifier la référence déjà initialisée provoque :
   Cannot modify readonly property Produit::$reference.

### 6.3.b
readonly convient à un identifiant qui doit rester fixe
après la création de l'objet, comme la référence d'un produit.

final convient à une méthode de calcul dont on veut empêcher
la redéfinition dans les classes filles, ou à une classe
qu'on ne souhaite pas autoriser à étendre.
### 6.4.a
L'appel direct à getAge() depuis Etudiant provoque une erreur,
car la méthode est privée dans Personne.
La visibilité protected permettrait cet appel.

### 6.4.b
dateNaissance est privée dans Personne. Elle n'est donc pas
directement accessible depuis Etudiant, malgré l'héritage.
Le test produit : Undefined property: Etudiant::$dateNaissance.

### 6.4.c
parent::__toString() réutilise l'affichage défini dans Personne.
Cela évite de répéter le code et facilite sa maintenance.
Etudiant ajoute seulement le CNE.
## Partie 7

### 7.1
L'expression $this->montant 1 contient une erreur de syntaxe :
aucun opérateur ne sépare $this->montant et 1.

### 7.2
La bonne formule après un an est :
montant = montant * (1 + interet / 100).

### 7.3
L'énoncé demande le montant initial puis l'intérêt.
Le code proposé utilise l'ordre inverse, ce qui risque de faire
confondre le montant et le taux lors de la création d'un compte.
Le constructeur corrigé utilise : montantInitial, interet.

### 7.4
Le code corrigé utilise des propriétés et paramètres float,
un retour float pour get_montant() et void pour un_an().
number_format() affiche les montants avec deux décimales.

Après 10 ans :
- Compte 1 : 1 037,50 DH.
- Compte 2 : 4 072,24 DH.
## Questions de synthèse

### 1. Différence entre classe et objet
Une classe est un modèle qui définit des propriétés et des méthodes.
Un objet est une instance de cette classe, créée avec new.

### 2. Trois avantages de la POO
- Organiser le code en classes.
- Réutiliser le code grâce à l'héritage et à la composition.
- Protéger les données grâce à l'encapsulation.

### 3. Pourquoi private ou protected ?
Ces visibilités limitent l'accès direct aux propriétés.
Les méthodes de la classe peuvent ainsi contrôler les modifications
et valider les valeurs.

### 4. Différence entre private et protected
Un membre private est accessible uniquement dans la classe
qui le déclare.
Un membre protected est aussi accessible dans les classes filles.

### 5. Visibilité des méthodes magiques
Les méthodes magiques doivent être publiques, sauf __construct(),
__destruct() et __clone(), qui peuvent avoir une autre visibilité.