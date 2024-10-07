<?php
$name=$_POST["name"];
$number_of_players=$_POST["number_of_players"];
$type=$_POST["type"];
$rules=$_POST["rules"];

$bdd = new PDO("mysql:host=localhost;dbname=IF3E_Projet_B;charset=utf8", "root", "");
$req = $bdd->prepare("INSERT INTO games(game_name, number_of_players, type, rules) VALUES (?,?,?,?);");

    $req->execute([$name, $number_of_players, $type, $rules]);
    echo "Le jeu a bien été inséré !";

?>