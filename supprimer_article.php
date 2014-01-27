<?php
//Cette page contient les éléments permettant la suppression d'article du blog

//inclusion des fichiers connexion.inc.php et fonctions.inc.php
include('includes/connexion.inc.php');
include('includes/fonctions.inc.php');

//Si la variable $connecte est à true donc si l'utilisateur est connecté
if($connecte){
    //récupération de l'id passé dans l'URL    
    $id=(int)var_get('id');
    //on récupère le tag de l'article
    $sql_recup="SELECT tag FROM article WHERE id=$id";
    $req_recup=mysql_query($sql_recup);
    $data=mysql_fetch_array($req_recup);
    $tag_a_supp=$data['tag'];
    //on supprime l'article de la base grâce à l'id récupéré
    $sql="DELETE FROM article WHERE id=$id";
    $_SESSION['article']='supprimé';
    $req=mysql_query($sql);
    //on vérifie si aucun autre article ne contient le tag de l'article a supprimer 
    $sql_compte_tag="SELECT COUNT(*)as compte FROM article WHERE tag='$tag_a_supp'";
    $req_compte=mysql_query($sql_compte_tag);
    $data=mysql_fetch_array($req_compte);
    //si aucun article ne contient ce tag on le supprime de la table tag
    if($data['compte']==0){
          $sql_supp_tag="DELETE FROM tag WHERE tag='$tag_a_supp'";
          $req_supp_tag=mysql_query($sql_supp_tag);
    }
    //redirection vers la page d'index
    header("Location: index.php");
}
//sinon on empeche l'accès à la suppression et on renvoie l'utilisateur sur la page de connexion
else{
    $_SESSION['connexion']='pas accès';
    header("Location: connexion.php");
}