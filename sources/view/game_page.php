<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gérer jeux</title>
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
    <h2>Gérer les jeux disponibles</h2>
    <?php
    session_start();
    $bdd = new PDO("mysql:host=localhost;dbname=IF3E_Projet_B;charset=utf8", "root", "");
    $req = $bdd->prepare("SELECT game_name, type, rules, number_of_players FROM games");
    $req->execute();
    ?>
    Jeux disponibles :
    <table>
        <tr>
            <th>Nom du jeu</th>
            <th>Type</th>
            <th>Règles</th>
            <th>Nombre de joueurs</th>
        </tr>
        <?php
            while($data = $req->fetch()) {
                echo "<tr>";
                echo "<td>" . $data['game_name'] . "</td>";
                if ($data['type'] == 1) {echo "<td>Multijoueur</td>";}else{
                    echo "<td>Solo</td>";
                }
                echo "<td>" . $data['rules'] . "</td>";
                echo "<td>" . $data['number_of_players'] . "</td>";
                echo "</tr>";
            }
        ?>
    </table>

    <form method="post" action="create_game.php">
        <br>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Créer un nouveau jeu</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>