<?php
session_start();
$player_id = $_POST["add_players"];
$tournament_id = $_GET["tournament_id"];
// Connexion à la base de données
$db = new PDO("mysql:host=localhost;dbname=IF3E_Projet_B;charset=utf8", "root", "");

// Préparation de la requête
$req = $db->prepare("SELECT * FROM tournament_players WHERE tournament_id = ? AND player = ?");

// Exécution de la requête paramétrée
$req->execute([$tournament_id,$player_id]);

// Récupération de l'éventuel résultat
$data = $req->fetch();

if($data != null) {
    // L'utilisateur appartient déjà à l'équipe
    echo "Le joueur appartient déjà au tournoi !";
} else {
    // Préparation de la requête
    $req = $db->prepare("INSERT INTO tournament_players (tournament_id, player) VALUES (?, ?)");

    // Exécution de la requête paramétrée
    $req->execute([$tournament_id,$player_id]);

    echo "Le joueur appartient désormais au tournoi !";
}