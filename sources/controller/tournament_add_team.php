<?php
session_start();
$team_id = $_POST["add_teams"];
$tournament_id = $_GET["tournament_id"];
// Connexion à la base de données
$db = new PDO("mysql:host=localhost;dbname=IF3E_Projet_B;charset=utf8", "root", "");

// Préparation de la requête
$req = $db->prepare("SELECT * FROM tournaments_teams WHERE tournament_id = ? AND team = ?");

// Exécution de la requête paramétrée
$req->execute([$tournament_id,$team_id]);

// Récupération de l'éventuel résultat
$data = $req->fetch();

if($data != null) {
    // L'utilisateur appartient déjà à l'équipe
    echo "L'équipe appartient déjà au tournoi !";
} else {
    // Préparation de la requête
    $req = $db->prepare("INSERT INTO tournaments_teams (tournament_id, team) VALUES (?, ?)");

    // Exécution de la requête paramétrée
    $req->execute([$tournament_id,$team_id]);

    echo "L'équipe appartient désormais au tournoi !";
}