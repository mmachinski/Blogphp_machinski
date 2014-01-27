</div>
<nav class="span4">
            <h2>Menu</h2>
				<form action="index.php" method="get"></br>
					<label for="r">Recherche :</label>
					<input type="text" name="r" placeholder="Informatique, ubuntu, ..." value="<?=var_get('r')?>" class="span3">&nbsp;
					<input type="submit" value="OK" class="btn">
				</form>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="article.php">Rédiger un article</a></li>
				<?php if($connecte==false){
				
					echo"<li><a href='connexion.php'>Se connecter</a></li>";
				}
				else{
					echo "<li><a href='deconnexion.php'>Déconnexion</a></li>";
				}?>
            </ul>
            
          </nav>
        </div>
        
      </div>

      <footer>
        <p>&copy; Nilsine & ULCO 2012</p>
                
		<script text="text/javascript">
			$(function(){
				
				$('.cacher_notif').click(function(){
				$('#notif').slideUp('slow');
				
				
				});
				
				
			});

		</script>
		
		
      </footer>

    </div>

  </body>
</html>

