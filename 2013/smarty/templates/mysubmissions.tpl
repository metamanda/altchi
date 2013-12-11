<h1>My Submissions</h1>

<div class="list">

<table width="100%">

<tr>
<th style="width: 100%;" nowrap>Title</th>
{* <th style="width: 1px;" nowrap>Author</th> *}
<th style="width: 1px;" nowrap>Type</th>
<th style="width: 1px;" nowrap>Rating</th>
</tr>

{foreach from=$submissions item="submission"}
<tr>
<td>
<a href="index.php?action=showsubmission&id={$submission.id}">{$submission.title|truncate:60:"..."}</a>
</td>
{* <td nowrap class="silentlink"><span style="white-space:nowrap"><a href="index.php?action=showuser&id={$submission.user.id}">{$submission.user.firstname} {$submission.user.lastname}</a></span></td> *}
<td nowrap><span style="white-space:nowrap">{$submission.type}</span></td>
<td nowrap><span style="white-space:nowrap">{$submission.averagerating}</span></td>
</tr>
{foreachelse}
<tr><td colspan=100>No submissions.</td></tr>
{/foreach}

</table>

</div>
