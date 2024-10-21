<?php
$type_tournoi=$_GET["type"];
$tournament_id=$_GET["tournament_id"];

$score1=$_POST["score1"];
$score2=$_POST["score2"];
$progress=$_POST["progress"];

$bdd = new PDO("mysql:host=localhost;dbname=IF3E_Projet_B;charset=utf8", "root", "");
if ($type_tournoi=="0") {
    $player1=$_GET["player1"];
    $player2=$_GET["player2"];
    $req = $bdd->prepare("UPDATE match_player SET score_player1=?, score_player2=?, progress=? WHERE tournament_id=? AND player1=? AND player2=?");
    $req->execute([$score1,$score2,$progress,$tournament_id,$player1,$player2]);
} else {
    $team1=$_GET["team1"];
    $team2=$_GET["team2"];
    $req = $bdd->prepare("UPDATE match_team SET score_team1=?, score_team2=?, progress=? WHERE tournament_id=? AND team1=? AND team2=?");
    $req->execute([$score1,$score2,$progress,$tournament_id,$team1,$team2]);
}

echo "Informations du match modifiées !";
?>