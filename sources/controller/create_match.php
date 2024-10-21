<?php
$type_tournoi=$_GET["type"];
$tournament_id=$_GET["tournament_id"];
$location=$_POST["location"];

$bdd = new PDO("mysql:host=localhost;dbname=IF3E_Projet_B;charset=utf8", "root", "");
if ($type_tournoi=="0") {
    $player1=$_POST["player1"];
    $player2=$_POST["player2"];
    if ($player1!=$player2) {
        $req = $bdd->prepare("SELECT * FROM match_player WHERE tournament_id=? AND player1=? AND player2=?");
        $req->execute([$tournament_id, $player1, $player2]);
        $donnes = $req->fetch();

        // Check si le mail existe déjà
        if ($donnes==null) {
            $req = $bdd->prepare("INSERT INTO match_player (tournament_id,player1,player2,location,progress,score_player1,score_player2) VALUES(?,?,?,?,'Pas commencé',0,0)");
            $req->execute([$tournament_id, $player1, $player2,$location]);
            echo "Match créé !";
        } else {
            echo "Erreur, le match existe déjà !";
        }
    } else {
        echo "Erreur, veuillez mettre deux joueurs différents !";
    }
} else {
    $team1=$_POST["team1"];
    $team2=$_POST["team2"];
    if ($team1!=$team2) {
        $req = $bdd->prepare("SELECT * FROM match_team WHERE tournament_id=? AND team1=? AND team2=?");
        $req->execute([$tournament_id, $team1, $team2]);
        $donnes = $req->fetch();

        // Check si le mail existe déjà
        if ($donnes==null) {
            $req = $bdd->prepare("INSERT INTO match_team (tournament_id,team1,team2,location,progress,score_team1,score_team2) VALUES(?,?,?,?,'Pas commencé',0,0)");
            $req->execute([$tournament_id, $team1, $team2,$location]);
            echo "Match créé !";
        } else {
            echo "Erreur, le match existe déjà !";
        }
    } else {
        echo "Erreur, veuillez mettre deux équipes différents !";
    }
}

?>