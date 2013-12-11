{* smarty *}

<h1>All reviewers -- warning! includes duplicates</h1>

<table width=100%>
    <tr><th>first</th><th>last</th><th>affiliation</th><th>email</th></tr>
	<div class="list">
	{foreach from=$posts item="post"}
	  <tr>
		<td>{$post.user.firstname}</td>
		<td>{$post.user.lastname}</td>
		<td>{$post.user.affiliation}</td>
		<td>{$post.user.email}</td>
	  </tr>
	{/foreach}
	</div>
</table>