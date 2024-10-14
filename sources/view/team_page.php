<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gérer équipes</title>
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
                    <a class="nav-link active" aria-current="page">Equipe</a>
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
    <h2>Gérer votre appartenance à une ou des équipes</h2>
    <?php
        session_start();
        $bdd = new PDO("mysql:host=localhost;dbname=IF3E_Projet_B;charset=utf8", "root", "");
        $req = $bdd->prepare("SELECT teams.team_name FROM player_team INNER JOIN teams ON teams.team_id=player_team.id_team WHERE player_team.id_user = ".$_SESSION["id"]);
        $req->execute();
        $i = 0;
        while($data = $req->fetch()) {
            if ($i == 0) {
                echo 'Voici les équipes dont vous faites parti :';
            }
            ++$i;
            echo "<br>- ".$data["team_name"];
        }
        if ($i == 0) {
            echo "Vous ne faites parti d'aucune équipe !";
        }
    ?>
    <form method="post" action="../controller/join_team.php">
        <br>
        <label for="teams" class="form-label">Rejoindre une équipe</label>
        <select id="teams" name="teams" class="form-select" required="required">
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
            <button class="btn btn-primary" type="submit">Rejoindre l'équipe</button>
        </div>
    </form>
    <form method="post" action="../controller/create_team.php">
        <br>
        <label for="name" class="form-label">Nom de l'équipe *</label>
        <input id="name" type="text" name="name" class="form-control" required="required"/>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Créer une équipe</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>