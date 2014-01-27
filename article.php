<?php
//on inclue les pages connexion.inc.php et fonctions.inc.php
include('includes/connexion.inc.php');
include('includes/fonctions.inc.php');
	
//si la variable $connecte existe et n'est pas à false
if($connecte){
    //on récupère l'id 
    $id=var_post('id');
    //si on a un titre
    if((isset($_POST['titre']))&& $_POST['titre']){
        //on fait un mysql_real_escape_string sur titre,tag et texte qui permet d'éviter les injections SQL
        $titre=mysql_real_escape_string($_POST['titre']);
	$texte=mysql_real_escape_string($_POST['texte']);
        $tag=mysql_real_escape_string($_POST['tag']);
        $tag=strtolower($tag);
        $tag=trim($tag);
	//si on a un id
	if ($id){
            //on récupère le tag de l'article
            $sql_verif="SELECT tag FROM article WHERE id=$id";
            $req_verif=mysql_query($sql_verif);
            $data=mysql_fetch_array($req_verif);
            $tag_a_supp=$data['tag'];
            //Si le tag entré est différent du premier
            if($tag!=$tag_a_supp){
                //on met à jour la table article dans la base de données grâce à l'id récupéré
                $sql="UPDATE article SET titre='$titre', texte='$texte', tag='$tag' WHERE id=$id";
                //on exécute la requete contenue dans la variable $sql
                $query=mysql_query($sql);
                //on regarde si le tag n'existe pas déjà dans la base de données
                $verif_tag="SELECT COUNT(*)as cpt FROM tag where tag='$tag'";
                $req_verif_tag=mysql_query($verif_tag);
                $data=mysql_fetch_array($req_verif_tag);
                if($data['cpt']==0){
                      // si il n'existe pas déja dans la base on le crée si le tag n'est pas vide	
                      if($tag!=''){
                            $insert_tag="INSERT INTO tag (tag) VALUES ('$tag')";
                            $res_insert_tag=mysql_query($insert_tag);
                      }
                }
                //on vérifie si aucun article autre ne contient l'ancien tag de l'article 
                $sql_compte_tag="SELECT COUNT(*)as compte FROM article WHERE tag='$tag_a_supp'";
                $req_compte=mysql_query($sql_compte_tag);
                $data=mysql_fetch_array($req_compte);
                //si aucun article ne contient ce tag on le supprime de la table tag
                if($data['compte']==0){
                    $sql_supp_tag="DELETE FROM tag WHERE tag='$tag_a_supp'";
                    $req_supp_tag=mysql_query($sql_supp_tag);
                }
                        
            }
            //la variable de session $_SESSION['article'] est à modifié
            $_SESSION['article']='modifié';
	}
	else{
            //si aucun id n'est récupéré, on insére un nouvel article dans la base de données
            $sql="INSERT INTO article (titre, texte,date,tag) VALUES ('$titre','$texte',UNIX_TIMESTAMP(),'$tag')";
            //on exécute la requete contenue dans la variable $sql
            $query=mysql_query($sql);
            $id_img=mysql_insert_id();
            //on regarde si le tag n'existe pas déjà dans la base de données
            $verif_tag="SELECT COUNT(*)as cpt FROM tag where tag='$tag'";
            $req_verif_tag=mysql_query($verif_tag);
            $data=mysql_fetch_array($req_verif_tag);
            if($data['cpt']==0){
                // si il n'existe pas déja dans la base on le crée si le tag n'est pas vide
		if($tag!=''){      
                    $insert_tag="INSERT INTO tag (tag) VALUES ('$tag')";
                    $res_insert_tag=mysql_query($insert_tag);
                }
            }
            //on met la variable de session $_SESSION['article'] a 'ajouté'
            $_SESSION['article']='ajouté';
       }
       //upload de l'image
       move_uploaded_file($_FILES['image']['tmp_name'],dirname(__FILE__)."/data/images/$id_img.jpg");
       //echo mysql_error();
       //redirection vers la page d'accueil
       header("Location: index.php");
       //on indique au serveur de ne plus exécuter le code qui suit
       exit();
    }
    else{
     //on inclue la page haut.inc.php
     include('includes/haut.inc.php');
        //on crée les variables de la page et les initialise à vide
        $texte='';
        $titre='';
        $tag='';
        $action='Ajouter';
        $titre_page='Rédiger un article';
        //si on a récupéré un id dans l'URL par la méthode GET
        if((isset($_GET['id']))&& $_GET['id']){
            //conversion de l'id en int car int est un entier pour eviter de mettre mysql_real_escape_string
            $id=(int)$_GET['id'];	
            //on récupère les données de l'article
            $sql="SELECT * FROM article WHERE id=$id";
            $query=mysql_query($sql);
            if($data=mysql_fetch_assoc($query)){
                extract($data);
                $titre_page='Modifier un article';
                $action='Modifier';
            }
        }//formulaire de création ou de modification d'article 
        //en cas d'id existant, on a une modification et les données ont été préalablement récupérées et les variables remplies.
        ?>
        <h2><?= $titre_page?></h2>
        <form action="article.php" id ='form_art' method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?=$id?>"/>
            <div class="clearfix">
                    <label for="titre">Titre</label>
                    <div class="input"><input type="text" name="titre" id="titre" value="<?=$titre?>"/></div>
            </div>
            <div class="clearfix">
                    <label for="image">Ajouter une image:</label>
                    <div class="input"><input type="file" name="image"/></div>
            </div>
            <div class="clearfix">
                    <label for="texte">Texte</label>
                    <div class="input"><textarea name="texte" id="texte" ><?=$texte ?></textarea></div>
            </div>
            <div class="clearfix">
                    <label for="tag">Tag</label>
                    <div class="input"><input type="text" name="tag" id="tag" value="<?=$tag ?>"/></div>
            </div>
            <div class='form-actions'>
                    <input type="submit" value="<?=$action?>" class="btn btn-primary"/>
            </div>
        </form>
        <!-- JQuery qui vérifie si les champs du formulaire ont été correctement remplis et en cas d'erreur, l'indique à l'utilisateur-->
        <script text="text/javascript">
            $(function(){
                //lorsque le formulaire est soumis
		$("#form_art").submit(function(){
                        //si le titre et le texte sont vide
			if($("#titre,#texte").val()==''){
                            //on affiche un message dans la console du navigateur
                            console.log("Titre et texte non saisi");
                            //on efface les classes appliquée à l'élément qui a pour id notif 
                            $("#notif").removeClass();
                            //on ajoute une classe et un message a l'élément qui a pour id notif					
                            $("#notif").addClass("alert alert-error ");
                            $("#notif>p").html("Veuillez compléter le titre et le texte.");
                            $("#notif").slideDown("slow");
                            //on arrete l'exécution du code
                            return false;
			}//sinon si le titre est vide
			else if($("#titre").val()==''){
                            //on affiche un message dans la console du navigateur
                            console.log("Titre non saisi");
                            $("#notif").removeClass();
                            $("#notif").addClass("alert alert-error ");
                            $("#notif>p").html("Veuillez compléter le titre.");
                            $("#notif").slideDown("slow");
                            return false;
			}//sinon si le texte est vide
                        else if ($("#texte").val()==''){
                            console.log("Texte non saisi");
                            $("#notif").removeClass();
                            $("#notif").addClass("alert alert-error");
                            $("#notif>p").html("Veuillez compléter le texte.");
                            $("#notif").slideDown("slow");
					
                            return false;
			}
			else{
                            return true;
			}
		});
							
            });
	</script>
	<?php include('includes/bas.inc.php');
    } 
}
else{
    $_SESSION['connexion']='pas accès';
    header("Location:connexion.php");
}
?>
