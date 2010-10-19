<h2>Set Up OAuth - Part 2</h2>

<p>Now Hubugz needs access to your account to be able to show tickets.<br />
Make sure you're logged into the appropriate account on github.com and then proceed here:</p>

<p><a href="https://github.com/login/oauth/authorize?client_id={$config.oauth_id}&scope=repo&redirect_uri=http://{$url|urlencode}oauth/callback">https://github.com/login/oauth/authorize?client_id={$config.oauth_id}&scope=repo&redirect_uri=http://{$url}oauth/callback</a></p>