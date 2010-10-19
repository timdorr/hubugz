{if $err}
<p>Something went wrong. Go back and try again!</p>
{else}
<h2>Set Up OAuth - Part 2</h2>

<p>We have a token, so copy and paste this line into the end of your app/Config.php file:</p>
<br />
<pre>$CONFIG['oauth_token'] = '{$token}';</pre>

<p>Now reload the page and you should be all set!</p>
{/if}