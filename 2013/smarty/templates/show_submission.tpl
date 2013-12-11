{* smarty *}

<h1>
<span name="edits" id="title">{$submission.title}</span>
</h1>
{*if $editable*}
{if $userid == $submission.user.id}
<!--a href="index.php?action=updatesubmission&id={$submission.id}">edit</a>
<br-->
<a href="index.php?action=deletesubmission&id={$submission.id}" onclick="return confirm('Are you sure you want to delete this submission?')">delete submission</a><br>
<p>
{ elseif $userid.status == 1}
<a href="index.php?action=updatesubmission&id={$submission.id}">edit</a>
<br>
<a href="index.php?action=deletesubmission&id={$submission.id}" onclick="return confirm('Are you sure you want to delete this submission?')">delete submission</a><br>
<p>
{/if}
{*/if*}

{counter name="reviewcounter" start=0 print=false assign="reviewcount"}

<div class="list">

<table>

<tr>
<td class="listcaption" nowrap>Submitted by</td>
<td><a href="index.php?action=showuser&id={$submission.user.id}">{$submission.user.firstname} {$submission.user.lastname}</a></td>
</tr>
<tr>
<td class="listcaption" nowrap>Affiliation</td>
<td>{$submission.user.affiliation}</td>
</tr>
{if $submission.additionalauthors}
<tr>
<td class="listcaption" nowrap><span style="white-space:nowrap">All authors</span></td>
<td>{$submission.additionalauthors}</td>
</tr>
{/if}

<tr>
<td class="listcaption">Keywords</td>
<td>
{$submission.keywords|escape}
</td>
</tr>

<tr>
<td class="listcaption">Paper link</td>
<td>
{if $submission.link}
<a href="{$submission.link}">Go to (external link)</a><br>
{else}
<a href="{$submission.url}">Download</a><br>
{/if}
</td>
</tr>

<tr>
<td class="listcaption">Submitted</td>
<td>{$submission.submitted|date_format:"%Y-%m-%d %H:%M"}</td>
</tr>

{if $submission.edited}
<tr>
<td class="listcaption" nowrap>Last edited</td>
<td>{$submission.edited|date_format:"%Y-%m-%d %H:%M"}</td>
</tr>
{/if}

{if $submission.extras}
{foreach from=$submission.extras item="field"}
<tr>
<td class="listcaption" nowrap><span style="white-space:nowrap">{$field.name|escape}</span></td>
<td>{$field.content|escape}</td>
</tr>
{/foreach}
{/if}

<tr>
<td class="listcaption">Submission history</td>
<td>{$submission.history|nl2br}</td>
</tr>

<tr>
<td class="listcaption">Abstract</td>
<td>{$submission.abstract|nl2br}</td>
</tr>

{if $submission.videolink}
<tr>
<td class="listcaption">Video link</td>
<td><a href="{$submission.videolink}">See Video (external link)</a></td>
</tr>
{/if}

{if $submission.comments}
<tr>
<td class="listcaption">Author Comments</td>
<td>{$submission.comments}</td>
</tr>
{/if}

</table>
</div>
<br/><br/>

<script src="forum.js"></script>

{* <h1>Thread <a href="forum.php?action=showcategory&id={$category.id}">{$category.name}</a> &gt; *}
<div class="forumnav">

{* <a href="forum.php">Forum</a> &gt; <a href="forum.php?action=showcategory&id={$category.id}">{$category.name}</a> &gt; *}


{if $thread.link}<a href="{$thread.link}">{/if}{$thread.subject}{if $thread.link}</a>{/if}</div>


<div class="forumposts">
<table width="100%">

{foreach from=$posts item="post"}

<tr class="postheader">
 <td>

 <table width=100%>
   <tr>   
    <td id="post_header_{$post.id}" align="left">
     {if $post.user.firstname != "" || $post.user.lastname != ""}
     <a href="index.php?action=showuser&id={$post.user.id}">{$post.user.firstname} {$post.user.lastname}</a>, {$post.user.affiliation|truncate:40}<br> wrote on {$post.date|date_format:"%Y-%m-%d %H:%M"}<br>
     {else}
     [user deleted]<br />wrote on {$post.date|date_format:"%Y-%m-%d %H:%M"}<br>
     {/if}
     {if $post.edited}
     - edited {$post.edited|date_format:"%Y-%m-%d %H:%M"}
     {/if}
    </td>
    <td style="text-align: right;">
     <a href="javascript:quote('{$post.id}');">quote</a>
     {*if $userid==$post.userid or $admin}
     <a href="index.php?action=editpost&id={$post.id}&index={$index}"><span title="edit">edit</span></a>
     {/if*}
     {if $admin or $userid==$post.userid}
     {*<a href="index.php?action=deletepost&id={$post.id}&index={$index}"><span title="delete post">x </span></a>&nbsp;*}
     <a href="javascript:deletePost('{$post.id}','{$index}');"><span title="delete post">x </span></a>&nbsp;
     {/if}
    </td>
   </tr>  
 

   {if $post.quality != 0}

    {if $post.isCurrentReview == 'true'}
		<tbody class="currentreview">
		{counter name="reviewcounter" print=false}
    {else}
		<tbody class="oldreview">
    {/if} 

   <tr>
   	<td>Quality: {$post.quality}</td>
   	<td>{$post.qualitytext|truncate:50}</td>
   </tr>
   <tr>
      	<td>Appropriate: {$post.appropriate}</td>
      	<td>{$post.appropriatetext|truncate:50}</td>
   </tr>
   <tr>
      	<td>Discussion potential: {$post.controversial}</td>
      	<td>{$post.controversialtext|truncate:50}</td>
   </tr>
   </tbody>
   {/if}
   
 
  </table>
 </td>
</tr>

<tr class="postbody">
 <td id="post_{$post.id}" colspan="100">
  {$post.review}
 </td>
</tr>

 <tr id="spacer">
 <td><br></td>
 </tr>

{foreachelse}

<tr><td colspan="100">
No posts.
</tr></td>

{/foreach}

</table>
</div>


{include file="screen_browser.tpl"}

{if $logged_in}
{if not $thread.locked}
<p>

<form method="post" action="index.php?action=showsubmission&id={$submission.id}">

Use this form to enter a comment, or a review by clicking the checkbox. <br/><br/>
A review includes ratings for quality, appropriateness and likelyhood to promote discussion.<br/><br/>
You can comment as many times as you like on any paper you want.<br/><br/>
Of course, you can't review your own paper, but you can comment on it.<br />
<br>
<p>

{*
This is where you can turn the review on and off when the reviewing period starts/ends
*}

{* 
{if $reviewcount<6}
*}


{*
<label for="yesisreview">This is my review</label>
{if $userid == $submission.user.id}
<input type="radio" name="isreview" value="yes" id="yesisreview" onclick="toggleVisibility(this,document.getElementById('isreviewtrue'));" disabled/>
{else}
<input type="radio" name="isreview" value="yes" id="yesisreview" onclick="toggleVisibility(this,document.getElementById('isreviewtrue'));" />
{/if}
*}


{*
{else}
<i>Only six reviews allowed per submission</i><br>
<label for="yesisreview" disabled style="color: grey">This is my review</label>
<input type="radio" name="isreview" value="yes" id="yesisreview" disabled />
{/if}
*}

<i>The review period for alt.chi is over.  You may still comment on submissions and discussion.</i><br>


{*<i>The review period for alt.chi has not yet started. You will be free to review and comment starting on January 14.</i> *}


<label for="yesisreview" disabled style="color: grey">This is my review</label>

{if $userid.status == 1}
<input type="radio" name="isreview" value="yes" id="yesisreview" onclick="toggleVisibility(this,document.getElementById('isreviewtrue'));" disabled/>
{else}
<input type="radio" name="isreview" value="yes" id="yesisreview" disabled />
{/if}
<label for="noisreview">This is a comment</label>
<input type="radio" name="isreview" value="no" checked="checked" id="noisreview" onclick="toggleVisibility(this,document.getElementById('isreviewtrue'));" />


</p>

<textarea id="input_post" name="post"></textarea><br>
<fieldset id="isreviewtrue" class="reviewonly" >
	<legend>Review scores</legend>
<p><em>You are allowed only one review per paper.  This will overwrite any previous review scores you have made for this paper; you may comment as much as you like.  You may comment on your own papers but may not review them.</em></p>
	<p>
	<label class="reviewonly"  for="quality">Quality</label>
	<select class="reviewonly" class="reviewonly" name="quality" id="quality" disabled />
		<option value="7">7 - excellent</option>
		<option value="6">6</option>
		<option value="5">5</option>
		<option value="4">4</option>
		<option value="3">3</option>
		<option value="2">2</option>
		<option value="1">1 - very poor</option>
	</select>
    <br/>
	<label class="reviewonly"  for="qualitytext">Why?</label>
	<input  class="reviewonly"  type="text" size=40 maxlength=40 name="qualitytext" id="qualitytext" value="" disabled />
	</p>

	<p>
	<label class="reviewonly"  for="appropriate">Appropriate for alt.chi</label>
	<select  class="reviewonly"  name="appropriate"  id="appropriate" disabled>
		<option value="7">7 - very appropriate</option>
		<option value="6">6</option>
		<option value="5">5</option>
		<option value="4">4</option>
		<option value="3">3</option>
		<option value="2">2</option>
		<option value="1">1 - inappropriate</option>
	</select>
    <br/>
	<label for="appropriatetext">Why?</label>
	<input  class="reviewonly" type="text" size=40 maxlength=40 name="appropriatetext" id="appropriatetext" value="" disabled/>
	</p>

	<p>
	<label for="controversial">Discussion</label>
	<select  class="reviewonly"  name="controversial"  id="controversial" disabled>
		<option value="7">7 - Will encourage</option>
		<option value="6">6</option>
		<option value="5">5</option>
		<option value="4">4</option>
		<option value="3">3</option>
		<option value="2">2</option>
		<option value="1">1 - Unlikely to encourage</option>
	</select>
    <br/>
	<label for="controversialtext">Why?</label>
	<input class="reviewonly"  type="text" size=40 maxlength=40 name="controversialtext" id="controversialtext" value="" disabled/>
	</p>

</fieldset>

<input type="submit" value="Submit">

{literal}
<script>
<!--//
	
function toggleVisibility(radiobutton,disablethis) {
	if(radiobutton.value == "no"){
		document.getElementById("appropriate").disabled = true;
		document.getElementById("controversial").disabled = true;
		document.getElementById("quality").disabled = true;
		document.getElementById("appropriatetext").disabled = true;
		document.getElementById("controversialtext").disabled = true;
		document.getElementById("qualitytext").disabled = true;
	}else {
		document.getElementById("appropriate").disabled = false;
		document.getElementById("controversial").disabled = false;
		document.getElementById("quality").disabled = false;
		document.getElementById("appropriatetext").disabled = false;
		document.getElementById("controversialtext").disabled = false;
		document.getElementById("qualitytext").disabled = false;
	}
	return true;
}

//-->
</script>
{/literal}


</form>
</div>
</p>
{/if}
{/if}
