<!-- on modifie le titre -->
{if $rech}
	<h2>{$nb} Resultat(s) pour la recherche "{$rech}"</h2>
{else}
	<h2>Nombres d'article au total: {$nb}</h2>
{/if}
<!-- Pour chaque article on affiche cet article en appelant le partial article.tpl-->
{foreach $list_news as $article}
{include file='partial/_article.tpl'}
{/foreach}
<!-- Code relatif à la pagination -->
<ul class='pagination'>
   
    {if $page!=1}
	<a href='index.php?p={$page-1}'> << </a>
    {/if}
    {for $p=1 to $nb_pages}
	<a href='index.php?p={$p}'>{$p} </a>
    {/for}
    {if $page<$nb_pages}
	<a href='index.php?p={$page+1}'> >> </a></ul>
    {/if}