<html>
<head>
    <title>Projet IF3E</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
</head>
<body>

    <h1>Board Game Tournament Management System</h1>
    <h2>Hi there !</h2>
    <form method="post">
        <label>
        Email : <input name="email" type="email" required="required" placeholder="Votre email..."/>
        </label><br>
        <label>
            Mot de passe : <input name="password" type="password" placeholder="Votre mot de passe..."/>
        </label><br>
        <input name="register" type="submit" formaction="register.php" value="Register"/>
        <input name="login" type="submit" formaction="/action_page2.php" value="Login"/>
    </form>
    <form>
        <br>
        <br>
        <br>
        <input name="manage_games" type="submit" formaction="manages_games.php" value="Manage games"/>
    </form>
</body>
</html>