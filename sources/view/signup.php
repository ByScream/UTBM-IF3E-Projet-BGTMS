<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription</title>
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
                    <a class="nav-link active" aria-current="page" href="signup.php">S'inscrire</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Se connecter</a>
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
    <h2>Inscription</h2>
    <form method="post" action="../controller/signup.php">
        <label for="email" class="form-label">Email *</label>
        <input id="email" type="email" name="email" class="form-control" required="required"/>

        <label for="password" class="form-label">Mot de passe *</label>
        <input id="password" type="password" name="password" class="form-control" required="required"/>
        <label for="passwordconfirm" class="form-label">Confirmer mot de passe *</label>
        <input id="passwordconfirm" type="password" name="passwordconfirm" class="form-control" required="required"/>

        <label for="pseudo" class="form-label">Pseudo</label>
        <input id="pseudo" type="text" name="pseudo" class="form-control" />

        <label for="firstname" class="form-label">Prénom *</label>
        <input id="firstname" type="text" name="firstname" class="form-control" required="required"/>

        <label for="name" class="form-label">Nom *</label>
        <input id="name" type="text" name="name" class="form-control" required="required"/>

        <label for="birthdate" class="form-label">Date de naissance</label>
        <input id="birthdate" type="date" name="birthdate" class="form-control"/>

        <label for="phonenumber" class="form-label">Numéro de téléphone</label>
        <input id="phonenumber" type="tel" name="phonenumber" class="form-control"/>

        <label for="favouritegame" class="form-label">Jeu favori</label>
        <select id="favouritegame" name="favouritegame" class="form-select">
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

        <div class="col-12">
            <button class="btn btn-primary" type="submit">S'inscrire</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>