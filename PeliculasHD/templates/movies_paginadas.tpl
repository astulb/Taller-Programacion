<div id="paginacion">
    <button  id="previous" class="btn btn-primary" {if ($page<=1)}disabled{/if}>Previous</button>
    {$page} / {$pages}
    <button  id="next" class="btn btn-primary" {if ($page>=$pages)}disabled{/if}>Next</button>
</div> 
                
<div id="movies">
    {foreach from=$movies item=movie}
        {include file="movieCard.tpl" movie=$movie}
    {/foreach}
</div>
                
