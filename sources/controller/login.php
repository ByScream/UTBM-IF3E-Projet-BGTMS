<?php
$email = $_POST["email"];
$password = $_POST["password"];

// Connexion à la base de données
$db = new PDO("mysql:host=localhost;dbname=IF3E_Projet_B;charset=utf8", "root", "");

// Préparation de la requête
$req = $db->prepare("SELECT id, email, password, prenom, is_organizer FROM users WHERE email = ?");

// Exécution de la requête paramétrée
$req->execute([$email]);

// Récupération de l'éventuel résultat
$data = $req->fetch();

if($data != null && password_verify($password, $data['password'])) {
    // C'est OK, on connecte l'utilisateur
    session_start();
    $_SESSION["email"] = $email;
    $_SESSION["prenom"] = $data["prenom"];
    $_SESSION["is_organizer"] = $data["is_organizer"];
    $_SESSION["id"] = $data["id"];

    // On le redirige sur son compte
    header("Location: ../view/account.php");
} else {
    // Erreur, utilisateur introuvable, on redirige vers le login
    header("Location: ../view/login.php");
}