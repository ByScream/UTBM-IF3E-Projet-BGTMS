<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Créer un jeu</title>
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
                    <a class="nav-link active" aria-current="page">Jeux</a>
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
    <form method="post" action="../controller/create_game.php">
        <label for="name" class="form-label">Nom du jeu *</label>
        <input id="name" type="text" name="name" class="form-control" required="required"/>

        <label for="type" class="form-label">Type du jeu *</label>
        <select id="type" name="type" class="form-select" required="required">
            <option value="0">Solo</option>
            <option value="1">Multijoueur</option>
        </select>

        <label for="rules" class="form-label">Règles du jeu *</label>
        <textarea id="rules" name="rules" class="form-control" required="required"></textarea>

        <label for="number_of_players" class="form-label">Nombre de joueurs/équipes *</label>
        <input id="number_of_players" type="number" name="number_of_players" class="form-control" required="required"/>

        <div class="col-12">
            <button class="btn btn-primary" type="submit">Créer</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>