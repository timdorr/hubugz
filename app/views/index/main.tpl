<h3>Choose your repository:</h3>

<p>
<ul class="blockylist">
{foreach from=$repos item=r}
    <li><a href="/tickets?project={$r->id}">{$r->name}</a></li>
{/foreach}
</ul>
</p>