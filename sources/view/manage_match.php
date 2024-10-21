<?php
$type_tournoi=$_GET["type"];
$tournament_id=$_GET["tournament_id"];
$bdd = new PDO("mysql:host=localhost;dbname=IF3E_Projet_B;charset=utf8", "root", "");
if ($type_tournoi=="0") {
    $player1=$_GET["player1"];

    $req = $bdd->prepare("SELECT pseudo FROM users WHERE id=?");
    $req->execute([$player1]);
    $data = $req->fetch();
    $player1_name=$data["pseudo"];

    $player2=$_GET["player2"];
    $req = $bdd->prepare("SELECT pseudo FROM users WHERE id=?");
    $req->execute([$player2]);
    $data = $req->fetch();
    $player2_name=$data["pseudo"];

    $req = $bdd->prepare("SELECT score_player1,score_player2, progress FROM match_player WHERE tournament_id=? AND player1=? AND player2=?");
    $req->execute([$tournament_id,$player1,$player2]);
    $data = $req->fetch();
    $player1_score=$data["score_player1"];
    $player2_score=$data["score_player2"];
    $progress=$data["progress"];
} else {
    $team1=$_GET["team1"];
    $req = $bdd->prepare("SELECT team_name FROM teams WHERE team_id=?");
    $req->execute([$team1]);
    $data = $req->fetch();
    $team1_name=$data["team_name"];

    $team2=$_GET["team2"];
    $req = $bdd->prepare("SELECT team_name FROM teams WHERE team_id=?");
    $req->execute([$team2]);
    $data = $req->fetch();
    $team2_name=$data["team_name"];

    $req = $bdd->prepare("SELECT score_team1,score_team2, progress FROM match_team WHERE tournament_id=? AND team1=? AND team2=?");
    $req->execute([$tournament_id,$team1,$team2]);
    $data = $req->fetch();
    $team1_score=$data["score_team1"];
    $team2_score=$data["score_team2"];
    $progress=$data["progress"];
}

$req = $bdd->prepare("SELECT name FROM tournament WHERE id=?");
$req->execute([$tournament_id]);
$data = $req->fetch();
$name_tournoi = $data["name"];
?>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gérer matchs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Projet IF3E</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page">Tournoi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="account.php">Mon compte</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../controller/signout.php">Se déconnecter</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <img src="../images/logo_UTBM_blanc.png" width="85" id="logo" alt="TLC Logo" />
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">

    <h2>Gérer les matchs : <?php echo $name_tournoi ?></h2>
    <?php
    if($type_tournoi=="0"){
        echo "<h5>$player1_name  vs $player2_name :</h5>";

        echo "<form method='post' action='../controller/modify_match.php?type=$type_tournoi&tournament_id=$tournament_id&player1=" . $player1 ."&player2=". $player2 . "'>";

        echo "<br><label for='score1' class='form-label'>Score de $player1_name</label>";
        echo "<input id='score1' type='number' name='score1' value='$player1_score' class='form-control'/>";

        echo "<label for='score2' class='form-label'>Score de $player2_name</label>";
        echo "<input id='score2' type='number' name='score2' value='$player2_score' class='form-control'/>";
    } else {
        echo "<h5>$team1_name  vs $team2_name :</h5>";

        echo "<form method='post' action='../controller/modify_match.php?type=$type_tournoi&tournament_id=$tournament_id&team1=" . $team1 ."&team2=". $team2 . "'>";

        echo "<br><label for='score1' class='form-label'>Score de $team1_name</label>";
        echo "<input id='score1' type='number' name='score1' value='$team1_score' class='form-control'/>";

        echo "<label for='score2' class='form-label'>Score de $team2_name</label>";
        echo "<input id='score2' type='number' name='score2' value='$team2_score' class='form-control'/>";
    }


    ?>

        <label for="progress" class="form-label">Statut</label>
        <select id="progress" name="progress" class="form-select">
            <option <?php if ($progress=="Pas commencé"){echo "selected";}?> value="Pas commencé">Pas commencé</option>
            <option <?php if ($progress=="En cours"){echo "selected";}?> value="En cours">En cours</option>
            <option <?php if ($progress=="Suspendu"){echo "selected";}?> value="Suspendu">Suspendu</option>
            <option <?php if ($progress=="Terminé"){echo "selected";}?> value="Terminé">Terminé</option>
        </select>

        <div class="col-12">
            <button class="btn btn-primary" type="submit">Modifier</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
