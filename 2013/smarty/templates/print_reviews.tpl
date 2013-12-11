{* smarty *}

<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css" />
<title>alt.chi forum</title>
</head>
<body>

<div style="text-align:left;">

{foreach from=$reviews item="review"}

Submission:
{$review.submission.user.firstname} {$review.submission.user.lastname} : {$review.submission.title}
<br/>
Reviewer: <a href="index.php?action=showuser&id={$review.user.id}">{$review.user.firstname} {$review.user.lastname}</a></td>
<br/>
Expertise:
{if $review.expertise==1}
1 - No knowledge
{elseif $review.expertise==2}
2 - Passing Knowledge
{elseif $review.expertise==3}
3 - Knowledgeable
{elseif $review.expertise==4}
4 - Expert
{/if}
<br/>
Rating:
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
<br/>
{if $review.relationship}
Relationship:
{$review.relationship|escape|nl2br}
<br/>
{/if}
<br/>
Summary:<br/>
<div class="textbox">
{$review.summary|nl2br}
</div>
<br/>
Review:<br/>
<div class="textbox">
{$review.review|nl2br}
</div>

<br/>

{/foreach}

</div>

{*
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
*}

{*
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
*}


</body>
</html>