{* smarty *}

{foreach from=$formerror item="msg"}
<span class="errormessage">{$msg}</span><br>
{/foreach}

<h1>Review for {$submission.title}</h1>

<div class="formtable">

<form method="post" action="index.php?action=makereview&id={$submission.id}">

<table>

<tr>
<td class="formtablelabel">Expertise</td>
<td>
<select name="expertise">
<option value="1">1 - No knowledge
<option value="2">2 - Passing knowledge
<option value="3" selected>3 - Knowledgeable
<option value="4">4 - Expert
</select>
</td>
</tr>

<tr>
<td class="formtablelabel">Rating</td>
<td>
<select name="rating">
<option value="1">1 - Definite reject
<option value="2">2 - Probably reject
<option value="3" selected>3 - Borderline
<option value="4">4 - Probably accept
<option value="5">5 - Definite accept
</select>
</td>
</tr>

<tr>
<td class="formtablelabel">Relationship</td>
<td>
{* <input type="text" value="{$form.relationship}" name="relationship" style="width:100%"> *}
<textarea name="relationship" style="height: 3em">{$form.relationship}</textarea>
<br>
Please state your connection to the authors of this submissions - for instance if you have worked directly with any of them, if you have a shared affiliation, etc. (If you have no connection, it is important to mention this too) 
</td>
</tr>

</table>

<h3>Summary / Contribution</h3>
<p>
Briefly summarize the submission and what you see as its main contribution(s) to the field of human-computer interaction. 
</p>
<textarea name="summary" style="height: 6em;">{$form.summary}</textarea><br>

<h3>Review</h3>
<p>
Write your review of the submission here.
</p>

<p>
Be sure to carefully discuss the merits of the work. Do not just say "this is great work" or "this work is not ready," rather explain and justify your rating.
</p>

<p>
Please provide constructive feedback that analyzes both positive and negative apects of the research itself as well as its presentation. This will help the authors to revise and improve the work.
</p>

<textarea name="review" style="height: 20em;">{$form.review}</textarea><br>

<input type="submit" value="Submit"><br>

</form>
