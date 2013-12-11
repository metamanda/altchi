{* smarty *}

<h1>Review for <a href="index.php?action=showsubmission&id={$review.submission.id}">{$review.submission.title}</a></h1>

{$review.stars}
{if $review.stars>0}
<img src="gfx/star.gif">
{else}
<img src="gfx/nostar.gif">
{/if}

{if $logged_in}
{if $review.userid!=$userid}
{if $isstared}
<a href="index.php?action=removestar&id={$review.id}">remove star</a>
{else}
<a href="index.php?action=assignstar&id={$review.id}">assign star for extra merit to this review</a>
{/if}
{/if}
{/if}

<div class="list">

<table>

<tr>
<td class="listcaption" nowrap>Reviewed by</td>
<td><a href="index.php?action=showuser&id={$review.user.id}">{$review.user.firstname} {$review.user.lastname}</a></td>
</tr>

<tr>
<td class="listcaption">Submitted</td>
<td>{$review.submitted|date_format:"%Y-%m-%d %H:%M"}</td>
</tr>

{if $review.edited}
<tr>
<td class="listcaption">Last edited</td>
<td>{$review.edited|date_format:"%Y-%m-%d %H:%M"}</td>
</tr>
{/if}

<tr>
<td class="listcaption">Expertise</td>
<td>
{if $review.expertise==1}
1 - No knowledge
{elseif $review.expertise==2}
2 - Passing Knowledge
{elseif $review.expertise==3}
3 - Knowledgeable
{elseif $review.expertise==4}
4 - Expert
{/if}
</td>

</tr>
<tr>
<td class="listcaption">Rating</td>
<td>
{if $review.overallrating==1}
1 - Definite reject
{elseif $review.overallrating==2}
2 - Probably reject
{elseif $review.overallrating==3}
3 - Borderline
{elseif $review.overallrating==4}
4 - Probably accept
{elseif $review.overallrating==5}
5 - Definite accept
{/if}
</td>
</tr>

{if $review.relationship}
<tr>
<td class="listcaption">Relationship</td>
<td>
{$review.relationship|escape|nl2br}
</td>
</tr>
{/if}

</table>

</div>

{if $editable}
<p>
<a href="index.php?action=deletereview&id={$review.id}">delete review</a><br/>
<a href="index.php?action=updatereview&id={$review.id}">edit review</a><br/>
{/if}

<p>

<h2>Summary</h2>
<div class="textbox">
{$review.summary|nl2br}
</div>

<p>
<h2>Review</h2>
<div class="textbox">
{$review.review|nl2br}
</div>

{if $reviews}
<h3>Other reviews</h3>

{include file="list_reviews.tpl"}
{/if}
