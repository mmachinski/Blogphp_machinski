<?php
//cette page se à deconnecter un utilisateur
//inclusion de la page connexion.inc.php
include('includes/connexion.inc.php');

//on met la variable de session a deconnecté
$_SESSION['connexion']='déconnecté';
//si l'utilisateur est bien connecté
if($connecte)
{
    //on vide l'id de session dans la base de données  grâce au cookie nommé sid
$sql="UPDATE utilisateurs SET sid='' WHERE sid='$sid'";
$query=mysql_query($sql);
}
//on vide le cookie 
setcookie('sid','',-1);
//on redirige vers la page d'accueil
header('Location:index.php');

