<?php
//la variable $croix contient une croix qui permettra de fermer certaines notifications
$croix="<a href='#' class='cacher_notif'>&times;</a>";
//si on a une variable de session concernant l'article
if(isset($_SESSION['article'])){
    //Pour la variable de session article
    switch($_SESSION['article']){
        //Dans le cas où la variable a pour valeur 'ajouté'
        case 'ajouté':
            //on crée une notification
            echo "<div class='alert alert-info' id='notif'>".$croix."<p>Votre article a bien été ajouté.</p></div>";
	break;
        //Dans le cas où la variable a pour valeur 'modifié'
        case 'modifié':
            //on crée une notification
            echo"<div class='alert alert-info' id='notif'>".$croix."<p>Votre article a bien été modifié.</p></div>";
	break;
	//Dans le cas où la variable a pour valeur 'supprimé'
	case 'supprimé':
            //on crée une notification
            echo "<div class='alert alert-info' id='notif'>".$croix."<p>La suppression de votre article a été prise en compte.</p></div>";
	break;
	//Sinon 
	Default:
            //on crée une notification
            echo"<div class='alert alert-error' id='notif'>".$croix."<p>Votre action n'a pas pu être prise en compte à cause d'une erreur.</p></div>";
	break;
    }
    //on supprime les variables de session
    unset($_SESSION['article']);
}//sinon
else{
    //on met une notification vide
    echo"<div class='alert alert-info hide'  id='notif'>".$croix."<p></p></div>";
}
//si on a une variable de session pour la connexion
if(isset($_SESSION['connexion'])){
    //Pour la variable de session connexion
    switch($_SESSION['connexion']){
	//si la variable de session connexion contient 'déconnecté'
        case 'déconnecté':
            //on crée une notification
            echo "<div class='alert alert-info' id='notif'><p>Vous avez été déconnecté.</p></div>";
	break;
        //si la variable de session connexion contient 'déconnecté'
	case 'pas accès':
            //on crée une notification
            echo "<div class='alert alert-error' id='notif'><p>Vous ne pouvez pas accéder à cette page sans être connecté.</p></div>";
	break;
        //Sinon
	Default://on ne fait rien
	break;
    }
    //on supprime les variables de session
    unset($_SESSION['connexion']);
}