<h2>Create A Ticket</h2><br />

{if $err}<div class="error">{$err}</div>{/if}

<form action="/tickets/create" method="post">

<p>
    <span class="radio">
        <input type="radio" name="type" value="bug" {if $input.type == 'bug'}checked="checked" {/if}/>
        Bug Report
    </span>
    <span class="radio">    
        <input type="radio" name="type" value="feature" {if $input.type == 'feature'}checked="checked" {/if}/>    
        Feature Request
    </span>
</p>

<p>
    Title:<br />
    <input name="title" value="{$input.title}" />
</p>

<p>
    Message:<br />
    <textarea name="body">{$input.body}</textarea>
</p>

<p class="desc">Please be sure to be as descriptive as possible. When filing a bug report, please be sure to include relevant information, such as usernames or ID numbers. If certain steps are required to recreate the condition of a bug, please describe them in detail. The more information, the better and faster they can be fixed and implemented.</p>

<p><input type="submit" value="Create Ticket" /></p>

</form>