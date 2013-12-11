{* smarty *}

<script src="submission.js"></script>

<h1>Editing submission</h1>

<div class="formtable">

<form method="POST" action="index.php?action=updatesubmission&id={$submission.id}">
<table id="submission_formtable">

<tr>
<td class="formtablelabel">Title</td>
<td><input type="text" name="title" value="{$submission.title}"></td>
</tr>

<tr>
<td class="formtablelabel" nowrap><span style="white-space:nowrap;">Additional authors</span></td>
<td><input type="text" name="authors" value="{$submission.additionalauthors}"></td>
</tr>

<tr>
<td class="formtablelabel">Keywords</td>
<td><input type="text" name="keywords" value="{$submission.keywords}"></td>
</tr>

{if $submission.link}
<tr>
<td class="formtablelabel">Link</td>
<td><input type="text" name="link" value="{$submission.link}"></td>
</tr>
{/if}

{if $submission.extras}
{foreach from=$submission.extras item="extra"}
<tr>
<td class="formtablelabel"><input type="text" name="extras_name[]" value="{$extra.name}"></td>
<td><input type="text" name="extras_content[]" value="{$extra.content}"></td>
</tr>
{/foreach}
{*
{section name=extras loop=$submission.extras}
<tr>
<td class="formtablelabel"><input type="text" name="extras_name[]" value="{$submission.extras[extras].name}"></td>
<td><input type="text" name="extras_content[]" value="{$submission.extras[extras].content}"></td>
</tr>
{/section}
*}

{/if}

<tr>
<td class="formtablelabel">Submission history</td>
<td>
<textarea name="history">{$submission.history|escape|nl2br}</textarea>
</td>
</tr>

<tr>
<td class="formtablelabel">Abstract</td>
<td>
<textarea name="abstract">{$submission.abstract}</textarea>
</td>
</tr>

<tr>
<input type="hidden" name="videolink" value="{$submission.videolink}">
<td class="formtablelabel">Link to Video</td>
<td><input type="text" name="videolink" value="{$submission.videolink}" /></td>
</td>
</tr>

<tr>
<input type="hidden" name="comments" value="{$submission.comments}" />
<td class="formtablelabel">Author Comments:</td>
<td>
<textarea id="input_comments" name="comments">{$submission.comments}</textarea><br />
</td>
</tr>

<!--tr>
<td></td>
<td><input type="button" value="Add field" onclick="javascript:addField()"></td>
</tr-->

<tr>
<td></td>
<td><input type="submit" value="Save"></td>
</tr>

{if $submission.message}
<tr>
<td></td>
<td>{$submission.message}
</td>
</tr>
{/if}

</table>
</form>

</div>
