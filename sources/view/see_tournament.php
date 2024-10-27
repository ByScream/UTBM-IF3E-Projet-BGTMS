<?php
$id_tournament=$_POST["tournoi"];
$bdd = new PDO("mysql:host=localhost;dbname=IF3E_Projet_B;charset=utf8", "root", "");
$req = $bdd->prepare("SELECT name, type FROM tournament WHERE id=?");
$req->execute([$id_tournament]);
$data = $req->fetch();
$name_tournoi = $data["name"];
$type_tournoi = $data["type"];
?>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Les tournois</title>
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

    <h2>Voir le torunoi : <?php echo $name_tournoi ?></h2>
    Matchs du tournoi :
    <table>
        <tr>
            <?php if($type_tournoi=="0"){ ?>
                <th>Joueur 1</th>
                <th>Joueur 2</th>
            <?php } else {?>
                <th>Equipe 1</th>
                <th>Equipe 2</th>
            <?php } ?>
            <th>Date</th>
            <th>Temps</th>
            <th>Localisation</th>
            <th>Statut</th>
            <th>Score</th>
        </tr>
        <?php
        $bdd = new PDO("mysql:host=localhost;dbname=IF3E_Projet_B;charset=utf8", "root", "");
        if ($type_tournoi==0){
            $req = $bdd->prepare("SELECT player1, P1.pseudo AS pseudo1, player2, P2.pseudo AS pseudo2, date, time, location, progress, score_player1, score_player2 FROM match_player INNER JOIN users P1 ON P1.id=match_player.player1 INNER JOIN users P2 ON P2.id=match_player.player2 WHERE tournament_id = ?");
            $req->execute([$id_tournament]);
            while($data = $req->fetch()) {
                echo "<tr>";
                echo "<td>" . $data['pseudo1'] . "</td>";
                echo "<td>" . $data['pseudo2'] . "</td>";
                echo "<td>" . $data['date'] . "</td>";
                echo "<td>" . $data['time'] . "</td>";
                echo "<td>" . $data['location'] . "</td>";
                echo "<td>" . $data['progress'] . "</td>";
                echo "<td>" . $data['score_player1'] . " - " . $data['score_player2'] . "</td>";;
                echo "</tr>";
            }
        } else {
            $req = $bdd->prepare("SELECT team1, T1.team_name AS name_team1, team2, T2.team_name AS name_team2, date, time, location, progress, score_team1, score_team2 FROM match_team INNER JOIN teams T1 ON T1.team_id=match_team.team1 INNER JOIN teams T2 ON T2.team_id=match_team.team2 WHERE tournament_id = ?");
            $req->execute([$id_tournament]);
            while($data = $req->fetch()) {
                echo "<tr>";
                echo "<td>" . $data['name_team1'] . "</td>";
                echo "<td>" . $data['name_team2'] . "</td>";
                echo "<td>" . $data['date'] . "</td>";
                echo "<td>" . $data['time'] . "</td>";
                echo "<td>" . $data['location'] . "</td>";
                echo "<td>" . $data['progress'] . "</td>";
                echo "<td>" . $data['score_team1'] . " - " . $data['score_team2'] . "</td>";
                echo "</tr>";
            }
        }

        ?>
    </table><br><br>
    Classment actuel du tournoi :
    <table>
        <tr>
            <?php if($type_tournoi=="0"){ ?>
                <th>Joueur</th>
            <?php } else {?>
                <th>Equipe</th>
            <?php } ?>
            <th>Nombre de match joués</th>
            <th>Gagné</th>
            <th>Nul</th>
            <th>Perdu</th>
            <th>Nb points</th>
        </tr>
        <?php
        $bdd = new PDO("mysql:host=localhost;dbname=IF3E_Projet_B;charset=utf8", "root", "");
        if ($type_tournoi==0){
            $req = $bdd->prepare("SELECT player, COUNT(*) AS nombre_de_victories
FROM (
    SELECT player1 AS player, score_player1 AS score, score_player2 AS adversaire_score
    FROM match_player
    WHERE score_player1 > score_player2

    UNION ALL

    SELECT player2 AS player, score_player2 AS score, score_player1 AS adversaire_score
    FROM match_player
    WHERE score_player2 > score_player1
) AS victoires
GROUP BY player
ORDER BY nombre_de_victories ASC;");
            $req->execute();
            while($data = $req->fetch()) {
                echo "<tr>";
                echo "<td>" . $data['player'] . "</td>";
                echo "<td>" . $data['nombre_de_victories'] . " - " . $data['nombre_de_victories'] . "</td>";;
                echo "</tr>";
            }
        } else {
            $req = $bdd->prepare("SELECT team1, T1.team_name AS name_team1, team2, T2.team_name AS name_team2, date, time, location, progress, score_team1, score_team2 FROM match_team INNER JOIN teams T1 ON T1.team_id=match_team.team1 INNER JOIN teams T2 ON T2.team_id=match_team.team2 WHERE tournament_id = ?");
            $req->execute();
            while($data = $req->fetch()) {
                echo "<tr>";
                echo "<td>" . $data['name_team1'] . "</td>";
                echo "<td>" . $data['name_team2'] . "</td>";
                echo "<td>" . $data['date'] . "</td>";
                echo "<td>" . $data['time'] . "</td>";
                echo "<td>" . $data['location'] . "</td>";
                echo "<td>" . $data['progress'] . "</td>";
                echo "<td>" . $data['score_team1'] . " - " . $data['score_team2'] . "</td>";
                echo "</tr>";
            }
        }

        ?>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
