{if $noglobal eq true}
{include file=$templatefile}
{else}
<!DOCTYPE html> 
<html> 
<head>

    <title>{if $page_title ne ""}{$page_title} | {/if}Hubugz</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    
    <link rel="stylesheet" type="text/css" media="screen" href="/styles/reset.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="/styles/main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="/styles/pages.css" />

    {if $smarty.server.HTTPS eq "on"}<script src="https://www.google.com/jsapi"></script>
    {else}<script src="http://www.google.com/jsapi"></script>
    {/if}<script>
        google.load("jquery", "1.4");
        google.load("jqueryui", "1.8");
    </script>

</head>
<body>

<div id="header">
    <a href="/"><img src="/images/logo.png"></a>
</div>

<div id="main">

{include file=$templatefile}

</div>

</body>
</html>
{/if}