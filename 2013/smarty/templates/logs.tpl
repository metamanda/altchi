{* smarty *}

<html>
<body>

<table>
<tr>
<th>time</th>
<th>user id</th>
<th>category</th>
<th>event</th>
<th>details</th>
</tr>
{foreach from=$logs item="log"}
<tr>
<td>{$log.time}</td>
<td>{$log.userid}</td>
<td>{$log.category}</td>
<td>{$log.event}</td>
<td>{$log.details}</td>
</tr>
{/foreach}
</table>

</body>
</html>
