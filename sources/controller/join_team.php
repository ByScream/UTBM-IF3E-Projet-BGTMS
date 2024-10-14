<?php
session_start();
$team_id = $_POST["teams"];
$id_user = $_SESSION["id"];

// Connexion à la base de données
$db = new PDO("mysql:host=localhost;dbname=IF3E_Projet_B;charset=utf8", "root", "");

// Préparation de la requête
$req = $db->prepare("SELECT id_user FROM player_team WHERE id_user = ? AND id_team = ?");

// Exécution de la requête paramétrée
$req->execute([$id_user,$team_id]);

// Récupération de l'éventuel résultat
$data = $req->fetch();

if($data != null) {
    // L'utilisateur appartient déjà à l'équipe
    echo "Vous faites déjà parti de cette équipe !";
} else {
    // Préparation de la requête
    $req = $db->prepare("INSERT INTO player_team (id_user, id_team) VALUES (?, ?)");

    // Exécution de la requête paramétrée
    $req->execute([$id_user,$team_id]);

    echo "Vous appartenez désormais à cette équipe !";
}