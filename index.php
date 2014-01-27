<?php
//on inclue les pages connexion.inc.php,haut.inc.php,fonctions.inc.php,et Smarty.class.php
include('includes/connexion.inc.php');
include('includes/haut.inc.php');
include('includes/fonctions.inc.php');
require("libs/Smarty.class.php");
//on crée un nouvel objet smarty
$tpl = new Smarty();
//définition des variables servant à la pagination
//$app contient le nombre d'article que l'on veut mettre par page
$app=2;
//$page contient le n° du premier article affiché sur la page
$page=(var_get('p'))?var_get('p'):1;
//$debut contient l'id du premier article affiché sur la page
$debut=$app*$page-$app;
//connexion a la base de donnée grâce à l'objet PDO
$connexion= new PDO('mysql:host=mysql.hostinger.fr;dbname=u868526152_blog','u868526152_root','rootpass'); 
//on récupère la recherche s'il y en a une
$rech=var_get('r');
//si on a une recherche
if($rech){
    //on evite les injections de code grâce a mysql_real_escape_string
    $rech=mysql_real_escape_string($_GET['r']);
    //on sélectionne les articles contenant le mot recherché ou dont le tag est le mot recherché
    $sql="SELECT * FROM article WHERE titre LIKE '%$rech%' OR texte LIKE '%$rech%' OR tag LIKE '%$rech%' LIMIT $debut, $app";
    $count="SELECT COUNT(*) AS total FROM article WHERE titre LIKE '%$rech%' OR texte LIKE '%$rech%' OR tag LIKE '%$rech%'";
}
else{
    //si il n'y a pas de recherche on sélectionne touts les articles dans la base de données en les divisants selon la pagination
    $sql="SELECT * FROM article ORDER BY date DESC LIMIT $debut, $app";
    //on compte le nombre total d'article
    $count="SELECT COUNT(*) AS total FROM article ";
}

//on exécute les requetes sql
$query=$connexion->prepare($sql);
$query->execute();
$count=$connexion->prepare($count);
$count->execute();
//on récupère le résultat de la requete $count qui est le nombre total d'article 
$nb=$count->fetch();
$total=$nb['total'];
//on calcule le nombre total de page
$nb_pages=($total>0)?ceil($total/$app):1;
//on crée le tableau list_news qui contiendra les articles		
$list_news = array();
//on récupère les données de la requete $sql qui contient les articles
while($data=$query->fetch()){
    
    $id=$data['id'];
    //on recherche si une image a été assignée à l'article et on l'ajoute au tableau de données
	if(file_exists("/data/images/$id.jpg")){
		$data['image']="/data/images/$id.jpg";
            
	}
	else{
		$data['image']=false;
	}
        
	$list_news[]=$data;
}


//assignation des variables
$tpl->assign('list_news',$list_news);
$tpl->assign('connecte',$connecte);
$tpl->assign('app',$app);
$tpl->assign('page',$page);
$tpl->assign('debut',$debut);
$tpl->assign('nb',$total);
$tpl->assign('rech',$rech);
$tpl->assign('nb_pages',$nb_pages);
//on appelle la vue correspondante
$tpl->display("index.tpl");

include('includes/bas.inc.php');
?>