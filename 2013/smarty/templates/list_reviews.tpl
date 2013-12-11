{* smarty *}

<div class="list">

<table width="100%">
<tr>
<th>Reviewer</th>
<th>Rating</th>
<th>Expertise</th>
<th>Submitted</th>
</tr>

{foreach from=$reviews item="review"}
<tr>
<td style="width:100%"><a href="index.php?action=showreview&id={$review.id}">{$review.user.firstname} {$review.user.lastname}</a></td>
<td align="center" style="width:1px;">{$review.overallrating}</td>
<td align="center" style="width:1px;">{$review.expertise}</td>
<td align="right" style="width:1px;" nowrap><span style="white-space:nowrap">{$review.submitted|date_format:"%Y-%m-%d %H:%M"}</span></td>
</tr>
{foreachelse}
<tr><td colspan="100">
No reviews yet.
</tr></td>
{/foreach}
</table>

</div>
