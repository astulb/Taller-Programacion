
<h3>{$genre.nombre}</h3>

{foreach from=$movies item=movie}
    {include file="movieCard.tpl" movie=$movie}
{/foreach}
<div id="paginacion">
    <button id="anterior" class="previous btn btn-primary" {if ($page<=1)}disabled{/if}>Anterior</button>
    Pagina {$page} de {$pages}
    <button id="siguiente" class="next btn btn-primary" {if ($page>=$pages)}disabled{/if}>Siguiente</button>
</div>
