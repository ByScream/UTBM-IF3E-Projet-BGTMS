<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Créer un tournoi</title>
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
    <h2>Créer un tournoi</h2>
    <form method="post" action="../controller/create_tournament.php">
        <label for="name" class="form-label">Nom du tournoi *</label>
        <input id="name" type="text" name="name" class="form-control" required="required"/>

        <label for="game" class="form-label">Jeu du tournoi *</label>
        <select id="game" name="game" class="form-select" required="required">
            <?php
            $bdd = new PDO("mysql:host=localhost;dbname=IF3E_Projet_B;charset=utf8", "root", "");
            $req = $bdd->prepare("SELECT id, game_name FROM games;");
            $req->execute();
            while($data = $req->fetch()) {
                ?>
                <option value="<?php echo $data["id"]?>"><?php echo $data["game_name"]?></option>
                <?php
            }
            ?>
        </select>

        <label for="number_of_players" class="form-label">Nombre de joueurs/équipes *</label>
        <input id="number_of_players" type="number" name="number_of_players" class="form-control" required="required"/>

        <label for="rules" class="form-label">Règles du tournoi *</label>
        <textarea id="rules" name="rules" class="form-control" required="required"></textarea>

        <label for="type" class="form-label">Type de tournoi *</label>
        <select id="type" name="type" class="form-select" required="required">
            <option value="0">Solo</option>
            <option value="1">Multijoueur</option>
        </select>
        <div class="col-12">
            <input class="btn btn-primary" type="submit">Créer</input>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>