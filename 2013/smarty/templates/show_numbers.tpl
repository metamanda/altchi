{* smarty *}

{if $dir==1}
{assign var="nextdir" value=0}
{else}
{assign var="nextdir" value=1}
{/if}
{assign var="reviewcount" value=0}
{assign var="commentcount" value=0}
{assign var="papercount" value=0}
{assign var="avgavgqual" value=0}
{assign var="avgavgdisc" value=0}
{assign var="avgavgappr" value=0}
{assign var="avgavgtotal" value=0}

<h1>Show Numbers</h1>

<p>
<span>
Sort by
<a href="index.php?action=shownumbers&sortby=date&dir={$nextdir}">submission date</a>,
<a href="index.php?action=shownumbers&sortby=author&dir={$nextdir}">author</a>,
<a href="index.php?action=shownumbers&sortby=numreviews&dir={$nextdir}">number of reviews</a>,
<a href="index.php?action=shownumbers&sortby=title&dir={$nextdir}">title</a>,
<a href="index.php?action=shownumbers&sortby=total&dir={$nextdir}">average total score</a>
</span>
</p>

<div class="list">

<br>

<table width="90%">

<tr>
<th style="width: 10em;"><a class="menuoption" href="index.php?action=shownumbers&sortby=title&dir={$nextdir}">Title</a></th>
<th style="width: 1px;" nowrap><a class="menuoption" href="index.php?action=shownumbers&sortby=author&dir={$nextdir}">Author</a></th>
<th style="width: 1px;" nowrap><a class="menuoption" href="index.php?action=shownumbers&sortby=numreviews&dir={$nextdir}">Revs</a></th>
<th style="width: 1px;" nowrap><a class="menuoption" href="index.php?action=shownumbers&sortby=numcomments&dir={$nextdir}">Coms</a></th>
<th style="width: 1px;" nowrap><a class="menuoption" href="index.php?action=shownumbers&sortby=quality&dir={$nextdir}">Qual</a></th>
<th style="width: 1px;" nowrap><a class="menuoption" href="index.php?action=shownumbers&sortby=appropriate&dir={$nextdir}">Appr</a></th>
<th style="width: 1px;" nowrap><a class="menuoption" href="index.php?action=shownumbers&sortby=discussion&dir={$nextdir}">Disc</a></th>
<th style="width: 1px;" nowrap><a class="menuoption" href="index.php?action=shownumbers&sortby=total&dir={$nextdir}">Total</a></th>
</tr>

{foreach from=$submissions item="submission"}
<tr>

<td style="width: 200px;" nowrap>
{if $submission.accepted == 1}
<b>
{/if}

{counter name="ordinal"}. <a href="index.php?action=showsubmission&id={$submission.id}">{$submission.title|truncate:42}</a>
{if $submission.accepted == 1}
</b>
{/if}

</td>
<td nowrap class="silentlink"><span style="white-space:nowrap"><a href="index.php?action=showuser&id={$submission.user.id}">{$submission.user.lastname}</a></span></td>
{* no affiliation <td>{$submission.user.affiliation}</td> *}

{assign var=reviewcount value=$reviewcount+$submission.numreviews}
{assign var=commentcount value=$commentcount+$submission.numcomments}
{assign var=papercount value=$papercount+1}

<td>{$submission.numreviews}</td>
<td>{$submission.numcomments}</td>

<td>{$submission.avgqual|string_format:"%.1f"}</td>
<td>{$submission.avgappr|string_format:"%.1f"}</td>
<td>{$submission.avgdisc|string_format:"%.1f"}</td>
<td><b>{$submission.avgtotal|string_format:"%.0f"}</b></td>

{assign var=avgavgqual value=$avgavgqual+$submission.avgqual}
{assign var=avgavgdisc value=$avgavgdisc+$submission.avgdisc}
{assign var=avgavgappr value=$avgavgappr+$submission.avgappr}
{assign var=avgavgtotal value=$avgavgtotal+$submission.avgtotal}


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
<b>Total Reviews: {$reviewcount}</b><br>
<b>Total Comments: {$commentcount}</b><br>
<b>Total Papers: {$papercount}</b><br>
<b>Average # Reviews: {$reviewcount/$papercount|string_format:"%.1f"}</b><br>
<b>Average # Comments: {$commentcount/$papercount|string_format:"%.1f"}</b><br>

<br>Average paper quality: {$avgavgqual/$papercount|string_format:"%.1f"}
<br>Average paper 'likelyhood to promote discussion': {$avgavgdisc/$papercount|string_format:"%.1f"}
<br>Average paper 'appropriateness for alt.chi': {$avgavgappr/$papercount|string_format:"%.1f"}
<br>Average total score: {$avgavgtotal/$papercount|string_format:"%.1f"}
<br><i>Above are all averages-of-averages</i>

{* include file="screen_browser.tpl" *}

</div>
