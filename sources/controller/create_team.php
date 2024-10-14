<?php
$name = $_POST["name"];

// Connexion à la base de données
$db = new PDO("mysql:host=localhost;dbname=IF3E_Projet_B;charset=utf8", "root", "");

// Préparation de la requête
$req = $db->prepare("INSERT INTO teams (team_name, owner) VALUES (?,?)");
session_start();
// Exécution de la requête paramétrée
$req->execute([$name, $_SESSION["id"]]);

$id_team = $db->lastInsertId();

// Préparation de la requête
$req = $db->prepare("INSERT INTO player_team (id_user, id_team) VALUES (?,?)");
// Exécution de la requête paramétrée
$req->execute([$_SESSION["id"], $id_team]);

echo "Equipe créé ! ";
