<!-- affichage de l'article -->
<h3>{$article.titre|escape:'htmlall'}</h3>
<h5>Créé le {$article.date|date_format:"%d %B %Y"}</h5>
{if $article.image}
	<img src="{$article.image}" width="200">
{/if}
<p>{$article.texte|escape:'htmlalt'|nl2br}</p>
{if $connecte}
    
    <a href="article.php?id={$article.id}" class="btn btn-primary">Modifier</a>
    <a href="supprimer_article.php?id={$article.id}" class="btn btn-primary">Supprimer</a>
{/if}
			
