{* smarty *}

<html>
<body>

<table>
<tr>
<th>bug id</th>
<th>user id</th>
<th>status</th>
<th>bug description</th>
</tr>
{foreach from=$bugs item="bug"}
<tr>
<td>{$bug.id}</td>
<td>{$bug.userid}</td>
<td>{$bug.status}</td>
<td>{$bug.text}</td>
</tr>
{/foreach}
</table>

</body>
</html>
