<html>
<head>
    <title>Projet IF3E</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
</head>
<body>
<h1>Create a game</h1>
<form method="post" action="create_game_send.php">
    <label>
        Game's name : <input name="name" type="text" required="required"/>
    </label><br>
    <label>
        Number of players : <input name="number_of_players" type="text" required="required"/>
    </label><br>
    <label>
        Type : <select name="type" required="required">
            <option value="0">single-player</option>
            <option value="1">team-based</option>
        </select>
    </label><br>
    <label>
        Rules : <textarea name="rules" cols="40" required="required"></textarea>
    </label><br>
    <input name="create_game_send" type="submit" value="Create game"/>
</form>
</body>
</html>