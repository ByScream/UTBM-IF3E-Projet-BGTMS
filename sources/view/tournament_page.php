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
    <h2>Voir les tournois</h2>
    <?php
    session_start();
    $bdd = new PDO("mysql:host=localhost;dbname=IF3E_Projet_B;charset=utf8", "root", "");
    $req = $bdd->prepare("SELECT tournament.id, tournament.name, 
tournament.number_of_players, tournament.match_rules, 
tournament.type, users.pseudo, games.game_name 
FROM tournament INNER JOIN 
users ON users.id=tournament.owner INNER JOIN 
games ON games.id=tournament.game_id INNER JOIN 
tournament_players ON 
tournament_players.tournament_id=tournament.id
WHERE tournament_players.player=?;");
    $req->execute([$_SESSION["id"]]);
    ?>
    Tournois dont vous faite parti :
    <table>
        <tr>
            <th>Nom du tournoi</th>
            <th>Jeu</th>
            <th>Règles</th>
            <th>Nombre de joueurs</th>
            <th>Type</th>
            <th>Créateur</th>
        </tr>
        <?php
        while($data = $req->fetch()) {
            echo "<tr>";
            echo "<td>" . $data['name'] . "</td>";
            echo "<td>" . $data['game_name'] . "</td>";
            echo "<td>" . $data['match_rules'] . "</td>";
            echo "<td>" . $data['number_of_players'] . "</td>";
            if ($data['type'] == 1) {echo "<td>Multijoueur</td>";}else{
                echo "<td>Solo</td>";
            }
            echo "<td>" . $data['pseudo'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <br><br>
    <?php
    $req = $bdd->prepare("SELECT DISTINCT tournament.id, tournament.name, 
tournament.number_of_players, tournament.match_rules, 
tournament.type, users.pseudo, games.game_name 
FROM tournament INNER JOIN 
users ON users.id=tournament.owner INNER JOIN 
games ON games.id=tournament.game_id INNER JOIN 
tournaments_teams ON 
tournaments_teams.tournament_id=tournament.id
INNER JOIN teams ON teams.team_id=tournaments_teams.team
INNER JOIN player_team ON player_team.id_team=teams.team_id
WHERE player_team.id_user=?;");
    $req->execute([$_SESSION["id"]]);
    ?>
    Tournois dont vos équipes font parti :
    <table>
        <tr>
            <th>Nom du tournoi</th>
            <th>Jeu</th>
            <th>Règles</th>
            <th>Nombre de joueurs</th>
            <th>Type</th>
            <th>Créateur</th>
        </tr>
        <?php
        while($data = $req->fetch()) {
            echo "<tr>";
            echo "<td>" . $data['name'] . "</td>";
            echo "<td>" . $data['game_name'] . "</td>";
            echo "<td>" . $data['match_rules'] . "</td>";
            echo "<td>" . $data['number_of_players'] . "</td>";
            if ($data['type'] == 1) {echo "<td>Multijoueur</td>";}else{
                echo "<td>Solo</td>";
            }
            echo "<td>" . $data['pseudo'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <form method="post" action="see_tournament.php">
        <br>
        <label for="tournoi" class="form-label">Regarder les infos d'un tournoi</label>
        <select id="tournoi" name="tournoi" class="form-select" required="required">
            <?php
            $req = $bdd->prepare("SELECT id, name FROM tournament;");
            $req->execute();
            while($data = $req->fetch()) {
                ?>
                <option value="<?php echo $data["id"]?>"><?php echo $data["name"]?></option>
                <?php
            }
            ?>
        </select>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Voir</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>