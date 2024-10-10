<?php
$email = $_POST["email"];
$password = $_POST["password"];

// Connexion à la base de données
$db = new PDO("mysql:host=localhost;dbname=IF3E_Projet_B;charset=utf8", "root", "");

// Préparation de la requête
$req = $db->prepare("SELECT email, password FROM users WHERE email = ?");

// Exécution de la requête paramétrée
$req->execute([$email]);

// Récupération de l'éventuel résultat
$data = $req->fetch();

if($data != null && password_verify($password, $data['password'])) {
    // C'est OK, on connecte l'utilisateur
    session_start();
    $_SESSION["email"] = $email;

    // On le redirige sur son compte
    header("Location: ../view/account.php");
} else {
    // Erreur, utilisateur introuvable, on redirige vers le login

    echo "L'utilisateur n'existe pas !";
    //header("Location: ../view/login.php");
}