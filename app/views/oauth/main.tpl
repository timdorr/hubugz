<h2>Set Up OAuth - Part 1</h2>

<p>Hubugz needs an Github Client ID and Client Secret to begin. To get one please visit:</p>

<p><a href="http://github.com/account/applications">http://github.com/account/applications</a></p>

<p>Then paste each one into these two boxes:</p>

<p>Client ID:<br /><input name="clientid" /></p>

<p>Client Secret:<br /><input name="clientsecret" /></p>

<div id="results" style="display:none;margin-top:20px">

<p>Finally, copy and paste these two lines into the bottom of your app/Config.php file:</p>
<br />
<pre id="config"></pre>

<p>Now you can reload this page and you should see step 2.</p>

</div>

<script>
$(document).ready(function(){

    $('input').keyup(function(){
        if( $('input[name=clientid]').val().replace(/^\s*/, "").replace(/\s*$/, "") != "" &&
            $('input[name=clientsecret]').val().replace(/^\s*/, "").replace(/\s*$/, "") != "" )
        {
            $('#config').html("$CONFIG['oauth_id'] = '" + $('input[name=clientid]').val().replace(/^\s*/, "").replace(/\s*$/, "") + "';\n$CONFIG['oauth_secret'] = '" + $('input[name=clientsecret]').val().replace(/^\s*/, "").replace(/\s*$/, "") + "';" );
            $('#results').show();
        }
    });

});
</script>