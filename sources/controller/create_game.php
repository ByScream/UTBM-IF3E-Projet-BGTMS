<?php
$name = $_POST["name"];
$number_of_players = $_POST["number_of_players"];
$rules = $_POST["rules"];
$type = $_POST["type"];

// Connexion à la base de données
$db = new PDO("mysql:host=localhost;dbname=IF3E_Projet_B;charset=utf8", "root", "");

// Préparation de la requête
$req = $db->prepare("INSERT INTO games (game_name, type, rules, number_of_players) VALUES (?,?,?,?)");

// Exécution de la requête paramétrée
$req->execute([$name, $type, $rules, $number_of_players]);

echo "Jeu créé !";