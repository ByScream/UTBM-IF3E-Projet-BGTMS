<?php
$id_tournoi = $_POST["tournoi"];
$bdd = new PDO("mysql:host=localhost;dbname=IF3E_Projet_B;charset=utf8", "root", "");
$req = $bdd->prepare("SELECT name, type FROM tournament WHERE id=?");
$req->execute([$id_tournoi]);
$data = $req->fetch();
$name_tournoi = $data["name"];
$type_tournoi = $data["type"];
?>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gérer tournois</title>
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

    <h2>Gérer le tournoi : <?php echo $name_tournoi ?></h2>
    <?php
    if ($type_tournoi == 1) {
        $req = $bdd->prepare("SELECT team, teams.team_name FROM tournaments_teams INNER JOIN teams ON team_id = team WHERE tournament_id=?");
        $req->execute([$id_tournoi]);
        $i = 0;
        while($data = $req->fetch()) {
            if ($i == 0) {
                echo 'Voici les équipes qui font parti de ce tournoi :';
            }
            ++$i;
            echo "<br>- ".$data["team_name"];
        }
        if ($i == 0) {
            echo "Il n'y a aucune équipe dans ce tournoi !";
        }
    } else {
        $req = $bdd->prepare("SELECT player, users.pseudo FROM tournament_players INNER JOIN users ON users.id = player WHERE tournament_id=?");
        $req->execute([$id_tournoi]);
        $i = 0;
        while($data = $req->fetch()) {
            if ($i == 0) {
                echo 'Voici les joueurs qui font parti de ce tournoi :';
            }
            ++$i;
            echo "<br>- ".$data["pseudo"];
        }
        if ($i == 0) {
            echo "Il n'y a aucun joueur dans ce tournoi !";
        }
    }


    ?>
    <br><br><br>
    <?php
    if ($type_tournoi == 1) { ?>
        <form method="post" action="../controller/tournament_add_team.php?tournament_id=<?php echo $id_tournoi ?>">
            <br>
            <label for="add_teams" class="form-label">Ajouter une équipe au tournoi</label>
            <select id="add_teams" name="add_teams" class="form-select" required="required">
                <?php
                $req = $bdd->prepare("SELECT team_id, team_name FROM teams;");
                $req->execute();
                while($data = $req->fetch()) {
                    ?>
                    <option value="<?php echo $data["team_id"]?>"><?php echo $data["team_name"]?></option>
                    <?php
                }
                ?>
            </select>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Ajouter l'équipe</button>
            </div>
        </form>
    <?php } else {?>
        <form method="post" action="../controller/tournament_add_player.php?tournament_id=<?php echo $id_tournoi ?>">
            <br>
            <label for="add_players" class="form-label">Ajouter un joueur au tournoi</label>
            <select id="add_players" name="add_players" class="form-select" required="required">
                <?php
                $req = $bdd->prepare("SELECT id, pseudo FROM users;");
                $req->execute();
                while($data = $req->fetch()) {
                    ?>
                    <option value="<?php echo $data["id"]?>"><?php echo $data["pseudo"]?></option>
                    <?php
                }
                ?>
            </select>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Ajouter le joueur</button>
            </div>
        </form>
    <?php }?>
    <form method="post" action="../view/manage_matchs.php?tournament_id=<?php echo $id_tournoi ?>">
        <br>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Gérer les matchs</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
