<?php
$name = $_POST["name"];
$game = $_POST["game"];
$number_of_players = $_POST["number_of_players"];
$rules = $_POST["rules"];
$type = $_POST["type"];

// Connexion à la base de données
$db = new PDO("mysql:host=localhost;dbname=IF3E_Projet_B;charset=utf8", "root", "");

// Préparation de la requête
$req = $db->prepare("INSERT INTO tournament (name, game_id, number_of_players, match_rules, owner, type) VALUES (?, ?,?,?,?,?)");

// Exécution de la requête paramétrée
session_start();
$req->execute([$name, $game, $number_of_players, $rules, $_SESSION["id"], $type]);

echo "Tournoi créé !";