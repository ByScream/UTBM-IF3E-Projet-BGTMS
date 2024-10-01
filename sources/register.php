<?php
    $email=$_GET["email"];
    $password=$_GET["password"];

    $bdd = new PDO('mysql:host=localhost;dbname=IF3E_Projet_B', 'root', '');
    $reg = $bdd->prepare("SELECT id FROM users WHERE email=?");
    $reg->execute([$email]);

    $donnes = $reg->fetch();
    if ($donnes==null) {
        $reg = $bdd->prepare("INSERT INTO users(email,password) VALUES ('$email','$password')");
        $reg->execute();
        echo "Votre compte a bien été créé !";
    } else {
        echo "Erreur, l'adresse $email est déjà enregistrée !";
    }


?>