{* smarty *}

{if $dir==1}
{assign var="nextdir" value=0}
{else}
{assign var="nextdir" value=1}
{/if}

<h1>All papers</h1>

<p>
<span>
Sort by
submission date&nbsp;<a href="index.php?action=submissions&sortby=date&dir=1"><img src="gfx/uparrow.png" /></a><a href="index.php?action=submissions&sortby=date&dir=0"><img src="gfx/downarrow.png" /></a>,
number of reviews&nbsp;<a href="index.php?action=submissions&sortby=numreviews&dir=0"><img src="gfx/uparrow.png" /></a><a href="index.php?action=submissions&sortby=numreviews&dir=1"><img src="gfx/downarrow.png" /></a>,
author&nbsp;<a href="index.php?action=submissions&sortby=author&dir=1"><img src="gfx/uparrow.png" /></a><a href="index.php?action=submissions&sortby=author&dir=0"><img src="gfx/downarrow.png" /></a>,
rating&nbsp;<a href="index.php?action=submissions&sortby=rating&dir=1"><img src="gfx/uparrow.png" /></a><a href="index.php?action=submissions&sortby=rating&dir=0"><img src="gfx/downarrow.png" /></a>,
title&nbsp;<a href="index.php?action=submissions&sortby=title&dir=0"><img src="gfx/uparrow.png" /></a><a href="index.php?action=submissions&sortby=title&dir=1"><img src="gfx/downarrow.png" /></a>
</span>
</p>

<p>
{if $showabstract}
<a href="index.php?action=submissions&sortby={$sorting}&dir={$dir}&hideabstract">Hide abstracts</a>
{else}
<a href="index.php?action=submissions&sortby={$sorting}&dir={$dir}">Show abstracts</a>
{/if}
<br>
<a href="index.php?action=submissions&sortby={$sorting}&dir={$dir}&simple">Simple view</a>
</p>

{* include file="screen_browser.tpl" *}

{* <div class="list"> *}

<table width="100%" style="border-style: 0px none;" class="fullentry">

{foreach from=$submissions item="submission"}
<tr><td>
<div class="list" style="margin-bottom: 1em;">
<table width=100%>
<tr>
<td class="listcaption">Title</td>
<td class="titlelist">
<a href="index.php?action=showsubmission&id={$submission.id}">{$submission.title}</a>
</td>
</tr>

<tr>
<td class="listcaption">Author</td>
<td nowrap class="silentlink"><span style="white-space:nowrap"><a href="index.php?action=showuser&id={$submission.user.id}">{$submission.user.firstname} {$submission.user.lastname}</a></span></td>
</tr>

<tr>
<td class="listcaption">Affiliation</td>
<td>{$submission.user.affiliation}</td>
</tr>

<tr>
<td class="listcaption" nowrap><span style="white-space:nowrap">Reviews</span></td>
<td>{$submission.numreviews}</td>
</tr>

<tr>
<td class="listcaption" nowrap><span style="white-space:nowrap">Comments</span></td>
<td>{$submission.numcomments}</td>
</tr>

<tr>
<td class="listcaption">Keywords</td>
<td>{$submission.keywords}</td>
</tr>

{if $submission.avgqual>0} 
<tr>
<td class="listcaption">Average ratings</td>
<td nowrap><span style="white-space:nowrap">Quality: {$submission.avgqual|string_format:"%.1f"} Appropriateness: {$submission.avgappr|string_format:"%.1f"} Promote discussion: {$submission.avgdisc|string_format:"%.1f"}</span></td>
</tr>
{/if}


{if $showabstract}
<tr>
<td class="listcaption">Abstract</td>
<td class="abstractlist">{$submission.abstract}</td>
{/if}

</table>

</div>

</td></tr>

{foreachelse}

<tr><td>No submissions.</td></tr>

{/foreach}

</table>

{include file="screen_browser.tpl"}

{* </div> *}
