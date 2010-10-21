<div class="floatr"><a href="/tickets"><img src="/images/back.png" /></a></div>

<h2 style="margin:15px">{$ticket->title} (#{$ticket->number})</h2>

<hr />

<p>{$ticket->body}</p>

<hr />

<h5>Comments:</h5>

{foreach from=$comments item=c}
<div class="comment">
    {$c->body}
</div>
{/foreach}