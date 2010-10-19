<h2>Log In</h2><br />

{if $err}<div class="error">{$err}</div>{/if}

<form method="post" action="/login">

<p>
    Email:<br />
    <input name="email" />
</p>

<p>
    Password:<br />
    <input type="password" name="password" />
</p>

<p><input type="submit" value="Log In" /></p>

</form>