{* Index page *}

<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css" />
<title>alt.chi 2013</title>
</head>
<body>

<div id="pagewidth">

{include file="header.tpl"}

<div id="main">

{if $hidemenu!="true"}

<div id="leftmenu">
{if $logged_in}
{include file="usermenu.tpl"}
{* include file="listmenu.tpl" title="Top rated" list=$topratedsubmissions listnumbers=true *}

{* include file="listmenu.tpl" title="Top reviewers" list=$topreviewers listnumbers=true *}

{if $admin}
{include file="adminmenu.tpl"}
{/if}

{include file="searchmenu.tpl"}

{else}
{include file="loginform.tpl"}
{/if}
</div> {* leftmenu *}

{/if}

<div id="content">

<div id="errors">
{foreach from=$error item="msg"}
<span class="errormessage">{$msg}</span><br>
{/foreach}
</div> {* errors *}

{if not $logged_in}
<div>
</div>

{/if}

{if $center}
{include file="$center"}
{/if}

</div> {* content*}

<div id="rightpanel">&nbsp;</div>

</div> {* main *}

{include file="footer.tpl"}

</div> {* pagewidth *}

</body>
</html>
