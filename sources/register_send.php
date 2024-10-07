<?php
    $email=$_POST["email"];
    $password=$_POST["password"];
    $passwordconfirm=$_POST["passwordconfirm"];
    $pseudo=$_POST["pseudo"];
    $nom=$_POST["nom"];
    $prenom=$_POST["prenom"];
    $dateofbirth=$_POST["dateofbirth"];
    $phonenumber=$_POST["phonenumber"];
    $preferredgame=$_POST["favourite_game"];

    if ($password!=$passwordconfirm) {
        echo "Erreur, le mot de passe est différent de la confirmation du mot de passe.";
    } else {
        $bdd = new PDO("mysql:host=localhost;dbname=IF3E_Projet_B;charset=utf8", "root", "");
        $req = $bdd->prepare("INSERT INTO users(email, password, pseudo, nom, prenom, date_of_birth, phone_number, favourite_game_id) VALUES (?,?,?,?,?,?,?,?);");

        $req->execute([$email, $password, $pseudo, $nom, $prenom, $dateofbirth, $phonenumber, $preferredgame]);
        echo "Votre compte a bien été créé !";
    }
?>