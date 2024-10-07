<?php
$email=$_POST["email"];
$password=$_POST["password"];

$bdd = new PDO('mysql:host=localhost;dbname=IF3E_Projet_B', 'root', '');
$reg = $bdd->prepare("SELECT password FROM users WHERE email=?");
$reg->execute([$email]);

$donnes = $reg->fetch();
if ($donnes!=null) {
    if ($password==$donnes["password"]) {
        echo "Vous êtes bien connecté. Redirection dans 5 secondes...";
        session_start();
        $_SESSION["email"]=$email;

        //TODO
        sleep(5);
        header("Location:user_page.php");
    } else {
        echo "Erreur, mot de passe incorrect.";
    }
} else {
    echo "Erreur, le compte n'existe pas !";
}


?>