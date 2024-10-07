<?php
$email=$_POST["email"];

$bdd = new PDO('mysql:host=localhost;dbname=IF3E_Projet_B', 'root', '');
$reg = $bdd->prepare("SELECT id FROM users WHERE email=?");
$reg->execute([$email]);

$donnes = $reg->fetch();
if ($donnes==null) {
    header('Location: register_page.php?email='.$email);
} else {
    echo "Erreur, l'adresse $email est déjà enregistrée !";
}


?>