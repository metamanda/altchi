{* smarty *}

{if $dir==1}
{assign var="nextdir" value=0}
{else}
{assign var="nextdir" value=1}
{/if}

<h1>All papers - Summary</h1>

<p>
<span>
Sort by
submission date&nbsp;<a href="index.php?action=submissions&sortby=date&dir=1&simple"><img src="gfx/uparrow.png" /></a><a href="index.php?action=submissions&sortby=date&dir=0&simple"><img src="gfx/downarrow.png" /></a>,
number of reviews&nbsp;<a href="index.php?action=submissions&sortby=numreviews&dir=0&simple"><img src="gfx/uparrow.png" /></a><a href="index.php?action=submissions&sortby=numreviews&dir=1&simple"><img src="gfx/downarrow.png" /></a>,
author&nbsp;<a href="index.php?action=submissions&sortby=author&dir=1&simple"><img src="gfx/uparrow.png" /></a><a href="index.php?action=submissions&sortby=author&dir=0&simple"><img src="gfx/downarrow.png" /></a>,
title&nbsp;<a href="index.php?action=submissions&sortby=title&dir=0&simple"><img src="gfx/uparrow.png" /></a><a href="index.php?action=submissions&sortby=title&dir=1&simple"><img src="gfx/downarrow.png" /></a>
</span>
</p>

<p>

<br>
<a href="index.php?action=submissions&sortby{$sorting}&dir={$dir}">Extended view</a>
</p>

{* include file="screen_browser.tpl" *}

<div class="list">

<br>

<table width="90%">
{*
<tr>
<th style="width: 100%; background-color:#eeeeee;"><a class="menuoption" href="index.php?action=submissions&simple&sortby=title&dir={$nextdir}">Title</a></th>
</tr>
<tr>
<th width="220px">
<th style="width: 1px;" nowrap><a class="menuoption" href="index.php?action=submissions&simple&sortby=author&dir={$nextdir}">Main Author</a></th>
<th style="width: 1px;" nowrap><a class="menuoption" href="index.php?action=submissions&simple&sortby=numreviews&dir={$nextdir}">Reviews</a></th>
<th style="width: 1px;" nowrap><a class="menuoption" href="index.php?action=submissions&simple&sortby=numcomments&dir={$nextdir}">Comments</a></th>
<th style="width: 1px;" nowrap><a class="menuoption">Activity</a></th>
</tr>
*}

{foreach from=$submissions item="submission"}
<tr>

<td colspan=5>
<b><a href="index.php?action=showsubmission&id={$submission.id}">{*$submission.title|truncate:33*}{$submission.title}</a></b>
</td>
</tr>
<tr>
<td nowrap class="silentlink"><span style="white-space:nowrap">First Author: <a href="index.php?action=showuser&id={$submission.user.id}">{$submission.user.firstname} {$submission.user.lastname}</a></span></td>
{* no affiliation <td>{$submission.user.affiliation}</td> *}

<td>Reviews: {$submission.numreviews}</td>
<td>Comments: {$submission.numcomments}</td>
<td nowrap>Activity: 
	{if $submission.latestdate == 0}
		today	
	{elseif $submission.latestdate == 1}
		yesterday
	{else} 
		{$submission.latestdate} days ago	
	{/if}	
</td>
<tr height="10"><td>&nbsp;</td></tr>
</tr>
{* no keywords
<tr>
<td colspan="100" align="center">
Keywords: <b>{$submission.keywords}</b>
</td>
</tr>
*}

{if $showabstract}
<tr>
<td colspan="100" style="white-space:normal;padding: 1em 1em 1em 1em; font-family: sans-serif; font-size: 9pt;">
{$submission.abstract}
</td>
</tr>
{/if}

{foreachelse}
<tr><td colspan=100>No submissions.</td></tr>
{/foreach}

</table>
<br>

{include file="screen_browser.tpl"}

</div>
