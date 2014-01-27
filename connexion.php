<?php
//cette page sert à connecter un utilisateur au blog
//on inclue les pages connexion.inc.php et fonctions.inc.php
include('includes/connexion.inc.php');
include('includes/fonctions.inc.php');
//on fait appel à la fonction var_post pour savoir si un mot de passe et un mail on été posté dans le formulaire de connexion
$mdp=var_post('mdp');
$email=var_post('email');
//si le formulaire a été rempli
if(($mdp)&&($email)){
    //on applique mysql_real_escape_string sur $mdp et $email pour eviter les injections de code
    $mdp=mysql_real_escape_string($mdp);
    $email=mysql_real_escape_string($email);
    //on vérifie s'il y a bien un utilisateur dans la base qui correspond à ces données
    $sql="SELECT id, email FROM utilisateurs WHERE mdp='$mdp' AND email='$email'";
    $query=mysql_query($sql);
    //si il y en a un
    if($data=mysql_fetch_array($query)){
		
    //cryptage md5 du mail, on concatène le timestamp courant pour qu'une personne qui connaisse le mail ne puisse le transformer en md5
    $sid=md5($data['email'].time());
    //on crée le cookie qui identifie la session
    //se cookie est créé à partir du timestamp courant
    setcookie("sid",$sid,time()+3600);
    //on insére ce cookie à l'utilisateur correspondant dans la base
    $sql="UPDATE utilisateurs SET sid='$sid' WHERE email='$email'";
    $query=mysql_query($sql);
    //on redirige vars la page d'accueil
    header("Location: index.php");
    }
    else{
        //sinon on redirige vers la page de connexion
        header("Location:connexion.php");
    }
}
else{
    //sinon affiche le formulaire de connexion
    //on inclue la page haut.inc.php
    include('includes/haut.inc.php');
?>
    <!-- formulaire de connexion -->
    <h2>Connexion</h2>
    <p>Saisissez les identifiants choisis lors de votre inscription</p>
    <form action="connexion.php" method="POST" id="form_connexion">
	<fieldset>
		<div class="clearfix">
			<label for="email">Email</label>
			<div class="input"><input id="email" name="email" size="30" type="email" value=""/></div>
		</div>
		
		<div class="clearfix">
			<label for="mdp">Mot de passe</label>
			<div class="input"><input id="mdp" name="mdp" size="15" type="password" value=""/></div>
		</div>
		
		<div class="form-actions">
			<input class="btn btn-large btn-primary" id="submit" type="submit" value="Se connecter"/>
		</div>
	</fieldset>
    </form> 
    
<?php
    //on inclue haut.inc.php
    include('includes/bas.inc.php');
}
?>
