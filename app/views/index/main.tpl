<h3>Choose your repository:</h3>

<p>
<ul class="blockylist">
{foreach from=$repos item=r}
    <li><a href="/tickets?project={$r->url|replace:'https://github.com/':''|replace:'http://github.com/':''}">{$r->name}</a></li>
{/foreach}
</ul>
</p>