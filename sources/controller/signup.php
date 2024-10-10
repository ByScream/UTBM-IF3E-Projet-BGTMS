<?php
$email = $_POST["email"];
$password = $_POST["password"];
$passwordconfirm = $_POST["passwordconfirm"];
$pseudo = $_POST["pseudo"];
$firstname = $_POST["firstname"];
$name = $_POST["name"];
$birthdate = $_POST["birthdate"];
$phonenumber = $_POST["phonenumber"];
$favouritegame = $_POST["favouritegame"];

// Check si mot de passe de confirmation différent ou non
if ($password!=$passwordconfirm) {
    echo "Erreur, le mot de passe est différent de la confirmation du mot de passe.";
} else {
    $bdd = new PDO('mysql:host=localhost;dbname=IF3E_Projet_B', 'root', '');
    $req = $bdd->prepare("SELECT id FROM users WHERE email=?");
    $req->execute([$email]);
    $donnes = $req->fetch();

    // Check si le mail existe déjà
    if ($donnes==null) {

        // Préparation de la requête
        $req = $bdd->prepare("INSERT INTO users (email, password, pseudo, nom, prenom, date_of_birth, phone_number, favourite_game_id) VALUES (?,?,?,?,?,?,?,?);");

        // Exécution de la requête paramétrée
        $req->execute([$email, password_hash($password, PASSWORD_DEFAULT), $pseudo, $name, $firstname, $birthdate, $phonenumber, $favouritegame]);

        // Pas de résultats à récupérer. Redirection de l'utilisateur vers la page de connexion.

        echo "Vous avez bien été enregistré !";
        //header("Location: ../view/login.php");
    } else {
        echo "Erreur, l'adresse $email est déjà enregistrée !";
    }
}
