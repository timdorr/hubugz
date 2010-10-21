<div class="floatr"><a href="/tickets"><img src="/images/back.png" /></a></div>

<h2 style="margin:15px">{$ticket->title} (#{$ticket->number})</h2>

<hr />

<p>{$ticket->body}</p>

<hr />

<h5>Comments:</h5>

{foreach from=$comments item=c}
<div class="comment">
    <p class="title">{$c->user} - {$c->created_at}</p>
    <p>{$c->body|trim|nl2br}</p>
</div>
{/foreach}

<hr />

<form action="/tickets/show/{$ticket->number}" method="post">

<p>
    <h5>Add A Comment:</h5>
    {if $err}<div class="error">{$err}</div>{/if}
    <textarea name="body"></textarea>
</p>

<p><input type="submit" value="Add Comment" /></p>


</form>