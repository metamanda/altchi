{* smarty *}

{include file="screen_browser.tpl"}

<div class="list">

<table>
<tr>
<th>User name</th>
<th>Real name</th>
{if $admin}
<th>Controls</th>
{/if}
</tr>

{foreach from=$users item="user"}
<tr>
<td><a href="index.php?action=showuser&id={$user.id}">{$user.user}</a></td>
<td nowrap>{$user.firstname} {$user.lastname}</td>
{if $admin}
<td align="right">
{if $user.status!="admin"}
<span title="make admin"><a href="index.php?action=makeadmin&id={$user.id}&index={$index}">a</a></span>
{/if}
<span title="delete user"><a href="index.php?action=deleteuser&id={$user.id}&index={$index}">x</a></span>
</td>
{/if}
</tr>
{foreachelse}
<tr><td>No users.</td></tr>
{/foreach}

</table>

</div>

{include file="screen_browser.tpl"}
