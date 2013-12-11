{* smarty *}

<script src="submission.js"></script>

{foreach from=$formerror item="msg"}
<span class="errormessage">{$msg}</span><br>
{/foreach}

{if not $success}

<h1>Submit a contribution</h1>

<div class="formtable">
<form method="post" action="submission.php?action=review" enctype="multipart/form-data">

<h3>Please note</h3>

<p>
For every submission, the authors agree to provide a minimum of three reviews of other submissions between June 17 and August 1, 2006.
</p>
<p>
The reviews can be written be the main author, one of the co-authors, or other people selected by the authors; however, the main submitter is personally responsible for ensuring the quality and quantity of the reviews.
</p>
<p>
Providing more than three reviews is of course more than welcome!
</p>
<p>
<input type="checkbox" name="agreement"> I agree to provide at least three reviews
</p>

<table id="submission_formtable">

<tr>
<td class="formtablelabel" nowrap>Title</td>
<td><input type="text" name="title" value="{$form.title}"></td>
</tr>

<tr>
<td class="formtablelabel" nowrap><span style="white-space:nowrap">Additional authors</span></td>
<td><input type="text" name="authors" value="{$form.authors}"></td>
</tr>

<tr>
<td class="formtablelabel">Type</td>
<td><input type="text" name="type" value="{$form.type}"></td>
</tr>

<tr>
<td class="formtablelabel">Keywords</td>
<td><input type="text" name="keywords" value="{$form.keywords}"></td>
</tr>

<tr>
<td class="formtablelabel">Submission history</td>
<td>
<textarea name="history" style="height: 4em;">{$form.history}</textarea><br>
Please note here if all or parts of this submission has been previously presented, or if it is currently under review at CHI or any other conference or journal 
</td>
</tr>

<tr>
<td class="formtablelabel">Abstract</td>
<td>
<textarea name="abstract">{$form.abstract}</textarea><br>
</td>
</tr>

<tr>
<input type="hidden" name="MAX_FILE_SIZE" value="8000000">
<td class="formtablelabel">Upload file</td>
<td>
  <input type="file" name="userfile"><br>
  If greater than 8mb, upload elsewhere and specify link instead.
</td>
</tr>

<tr>
<td class="formtablelabel">Link</td>
<td><input type="text" name="link" value="{$form.link}"></td>
</tr>

<tr>
<td class="formtablelabel">Link to Video (optional)</td>
<td><input type="text" name="videolink" value="{$form.videolink}" /></td>
</tr>
            
<tr>
<td class="formtablelabel">Comments (optional)</td>
<td><textarea id="input_comments" name="comments">{$form.comments}</textarea></td>
</tr>

<tr>
<td align="right"><input type="button" value="Add field" onClick="addField();"></td>
<td/>
</tr>

{if $admin}
<tr>
<td>ADMIN SAYS: hidden</td>
<td><input type="checkbox" name="hidden"></td>
</tr>
{/if}

<tr>
<td></td>
<td><input type="submit" value="Submit"></td>
</tr>



{if $form.extras_name}
{section name=extras loop=$form.extras_name}
<tr>
<td class="formtablelabel"><input type="text" name="extras_name[]" value="{$form.extras_name[extras]}"></td>
<td><input type="text" name="extras_content[]" value="{$form.extras_content[extras]}"></td>
</tr>
{/section}
{/if}

</table>

</form>

</div>

{else}

Submission successful!<br>

{/if}
