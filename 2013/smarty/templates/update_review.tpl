{* smarty *}

<h1>Update review for <a href="index.php?action=showsubmission&id={$review.submission.id}">{$review.submission.title}</a></h1>

<div class="formtable">

<form method="post" action="index.php?action=updatereview&id={$review.id}">

<table>
<tr>
<td class="listcaption">Expertise</td>

<td>
<select name="expertise">
<option value="1" {if $review.expertise==1}selected{/if}>1 - No knowledge
<option value="2" {if $review.expertise==2}selected{/if}>2 - Passing knowledge
<option value="3" {if $review.expertise==3}selected{/if}>3 - Knowledgeable
<option value="4" {if $review.expertise==4}selected{/if}>4 - Expert
</select>
</td>

</tr>

<tr>
<td class="listcaption">Rating</td>
<td>
<select name="rating">
<option value="1" {if $review.overallrating==1}selected{/if}>1 - Definite reject
<option value="2" {if $review.overallrating==2}selected{/if}>2 - Probably reject
<option value="3" {if $review.overallrating==3}selected{/if}>3 - Borderline
<option value="4" {if $review.overallrating==4}selected{/if}>4 - Probably accept
<option value="5" {if $review.overallrating==5}selected{/if}>5 - Definite accept
</select>
</td>
</tr>

<tr>
<td class="listcaption">Relationship</td>
<td>
{*<input type="text" value="{$review.relationship}" name="relationship" style="width:100%">*}
<textarea name="relationship" style="height: 3em;">{$review.relationship}</textarea>
</td>
</tr>

<tr>
<td class="listcaption">Summary</td>
<td>
<textarea name="summary" style="height: 6em;">{$review.summary}</textarea>
</td>
</tr>

<tr>
<td class="listcaption">Review</td>
<td>
<textarea name="review" style="height: 20em;">{$review.review}</textarea>
</td>
</tr>

<tr>
<td/>
<td><input type="submit" value="Save"></td>
</tr>

</table>

</form>

</div>
