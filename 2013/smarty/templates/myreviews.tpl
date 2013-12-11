{* smarty *}

<h1>My reviews</h1>

<div class="list">

<table width="100%">
<tr>
<th style="width:100%" nowrap><span style="white-space:nowrap;">Submission title</span></th>
<th style="width:1px;" nowrap><span style="white-space:nowrap">My Rating</span></th>
<th style="width:1px;" nowrap><span style="white-space:nowrap">Average Rating</span></th>
<th style="width:1px;">Submitted</th>
</tr>

{foreach from=$reviews item="review"}
<tr>
<td><a href="index.php?action=showreview&id={$review.id}">{$review.submission.title}</a></td>
<td align="center">{$review.overallrating}</td>
<td align="center">{$review.submission.averagerating}</td>
<td align="right" style="width:1px" nowrap><span style="white-space:nowrap;">{$review.submitted|date_format:"%Y-%m-%d %H:%M"}</span></td>
</tr>
{foreachelse}
<tr><td colspan="100">
No reviews yet.
</tr></td>
{/foreach}

</div>
