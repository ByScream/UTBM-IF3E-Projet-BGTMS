<html>
<head>
    <title>Projet IF3E</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
</head>
<body>
    <h1>Please enter your personal information</h1>
    <form method="post" action="register_send.php">
        <label>
            Email : <input name="email" type="email" value="<?php echo $_GET["email"]?>" required="required" readonly="true"/>
        </label><br>
        <label>
            Password : <input name="password" type="password" placeholder="Votre mot de passe..." required="required"/>
        </label><br>
        <label>
            Confirm password : <input name="passwordconfirm" type="password" placeholder="Votre mot de passe..." required="required"/>
        </label><br>
        <label>
            Pseudo : <input name="pseudo" type="text" required="required"/>
        </label><br>
        <label>
            First name : <input name="prenom" type="text" required="required"/>
        </label><br>
        <label>
            Last name : <input name="nom" type="text" required="required"/>
        </label><br>
        <label>
            Date of birth : <input name="dateofbirth" type="date" required="required"/>
        </label><br>
        <label>
            Phone number : <input name="phonenumber" type="tel" required="required"/>
        </label><br>
        <label>
            Select your favorite game :
            <select name="favourite_game" required="required">
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
        </label><br>
        <input name="register_send" type="submit" value="Register"/>
    </form>
</body>
</html>