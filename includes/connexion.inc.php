<?php
    //connexion base de données blog
    mysql_connect('mysql.hostinger.fr', 'u868526152_root' ,'rootpass');
    mysql_select_db('u868526152_blog');
    //creation d'une session
    session_start();
    //verification utilisateur par le sid
    if(isset($_COOKIE['sid'])){
	$sid=mysql_real_escape_string($_COOKIE['sid']);
	$sql="SELECT email FROM utilisateurs WHERE sid='$sid'";
	$query=mysql_query($sql);
	//echo mysql_error();
	if($infos_util=mysql_fetch_array($query)){
            $connecte=true;
	}
	else{
            $connecte=false;
	}
    }
    else{
	$connecte=false;
    }