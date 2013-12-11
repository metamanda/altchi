{* smarty *}

{if $submission}
<h1>Reviews for <a href="index.php?action=showsubmission&id={$submission.id}">"{$submission.title}"</a> by {$submission.user.firstname} {$submission.user.lastname}</h1>

<p>

<a href="index.php?action=makereview&id={$submission.id}">Make review</a><br>

<p>

{else}

<h1>My reviews</h1>

{/if}

{*

<div class="list">

<table width="100%">
<tr>
<th>Reviewer</th>
<th>Rating</th>
<th style="width:1px;">Submitted</th>
</tr>

{foreach from=$reviews item="review"}
<tr>
<td style="width:100%;"><a href="index.php?action=showreview&id={$review.id}">{$review.user.firstname} {$review.user.lastname}</a></td>
<td align="center" style="width:1px;">{$review.overallrating}</td>
<td align="right" style="width:1px;"><span style="white-space:nowrap;">{$review.submitted|date_format:"%Y-%m-%d %H:%M"}</span></td>
</tr>
{foreachelse}
<tr><td colspan="100">
No reviews yet.
</tr></td>
{/foreach}

</div>

*}

{include file="list_reviews.tpl"}
