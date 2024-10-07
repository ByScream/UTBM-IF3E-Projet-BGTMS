<html lang="fr">
<head>
    <title>Projet IF3E</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
</head>
<body>
    <?php
    // Connect to the database and execute the request
    $bdd = new PDO("mysql:host=localhost;dbname=IF3E_Projet_B;charset=utf8", "root", "");
    $req = $bdd->prepare("SELECT game_name, type, rules, number_of_players FROM games");
    $req->execute();

    ?>

    <table>
        <tr>
            <th>Game's name</th>
            <th>Number of players</th>
            <th>Type</th>
            <th>Rules</th>
        </tr>
        <?php
        while($data = $req->fetch())
        {
            ?>
            <tr>
                <td><?php echo $data["game_name"]; ?></td>
                <td><?php echo $data["number_of_players"]; ?></td>
                <td><?php if($data["type"]==0){echo "single-player";}else{echo "team-based";} ?></td>
                <td><?php echo $data["rules"]; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <br>
    <form>
        <input name="create_game" type="submit" formaction="create_game_page.php" value="Create a game"/>
    </form>
</body>
</html>