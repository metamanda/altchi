{* smarty *}

<h1>Confirm submission</h1>

<div class="formtable">

<form method="post" action="submission.php?action=confirm" enctype="multipart/form-data">

<input type="hidden" name="agreement" value="true">

<table>

<tr>
<input type="hidden" name="title" value="{$form.title}"><br>
<td class="formtablelabel">Title</td>
<td>
{$form.title}
</td>
</tr>

{if $form.authors}
<tr>
<input type="hidden" name="authors" value="{$form.authors}">
<td class="formtablelabel" nowrap><span style="white-space: nowrap">Authors</span></td>
<td>
{$form.authors}
</td>
</tr>
{/if}

<tr>
<input type="hidden" name="keywords" value="{$form.keywords}">
<td class="formtablelabel">Keywords</td>
<td>
{$form.keywords}
</td>
</tr>

<tr>
<td class="formtablelabel">Submission History</td>
<td>
<textarea id="input_history" name="history" READONLY>{$form.history}</textarea><br>
</td>
</tr>

<tr>
<td class="formtablelabel">Abstract:</td>
<td>
<textarea id="input_abstract" name="abstract" READONLY>{$form.abstract}</textarea><br>
</td>
</tr>

<tr>
{if $form.link}
<input type="hidden" name="link" value="{$form.link}">
<td class="formtablelabel">Link</td>
<td>
{$form.link}
</td>
{else}
<input type="hidden" name="filename" value="{$filename}">
<td class="formtablelabel">Uploaded file</td>
<td>
{$filename}
</td>
{/if}
</tr>

{if $form.videolink}
<tr>
<input type="hidden" name="videolink" value="{$form.videolink}">
<td class="formtablelabel">Link to Video</td>
<td>
{$form.videolink}
</td>
</tr>
{/if}

{if $form.comments}
<tr>
<input type="hidden" name="comments" value="{$form.comments}" />
<td class="formtablelabel">Author Comments:</td>
<td>
<textarea id="input_comments" name="comments" READONLY>{$form.comments}</textarea>
</td>
</tr>
{/if}

{if $form.extras_name}
{section name=extras loop=$form.extras_name}
<tr>
<input type="hidden" name="extras_name[]" value="{$form.extras_name[extras]}">
<td class="formtablelabel">{$form.extras_name[extras]}</td>
<input type="hidden" name="extras_content[]" value="{$form.extras_content[extras]}">
<td>{$form.extras_content[extras]}</td>
</tr>
{/section}
{/if}

{if $admin}
<tr>
<td class="formtablelabel">ADMIN hidden</td>
<td>
<input type="checkbox" name="hidden"{if $form.hidden} CHECKED{/if}>
</td>
</tr>
{/if}

<tr>
<td/>
<td>
<input type="submit" name="button" value="Confirm">
<input type="submit" name="button" value="Back">
</td>
</tr>

</table>

</form>
</div>
