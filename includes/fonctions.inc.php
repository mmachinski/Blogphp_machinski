<?php
//cette page contient les fonctions qui seront répétées dans l'ensemble des pages	
//cette fonction prend en paramètre un mot envoyé dans l'URL
//elle retourne la variable si elle existe sinon retourne false
function var_get($nom){
    return (isset($_GET[$nom]))?$_GET[$nom]:false;
}
//cette fonction prend en paramètre un mot envoyé dans un formulaire
//elle retourne la variable si elle existe sinon retourne false
function var_post($nom){
    return (isset($_POST[$nom]))?$_POST[$nom]:false;
}
//cette fonction crée les variable de session 
function requete_notif($req,$var_notif,$val_notif){
    if(mysql_query($req)){
	$_SESSION[$var_motif]=$val_motif;
    }
    else{
	$_SESSION[$var_motif]='erreur';
    }
}