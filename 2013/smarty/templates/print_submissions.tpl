{* smarty *}

<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css" />
<title>alt.chi forum</title>
</head>
<body>

{if $dir==1}
{assign var="nextdir" value=0}
{else}
{assign var="nextdir" value=1}
{/if}

<h1>Submissions</h1>

<p>
<span>
Sort by
<a href="index.php?action=printsubmissions&simple&sortby=date&dir={$nextdir}">submission date</a>,
<a href="index.php?action=printsubmissions&simple&sortby=author&dir={$nextdir}">author</a>,
<a href="index.php?action=printsubmissions&simple&sortby=rating&dir={$nextdir}">rating</a>,
<a href="index.php?action=printsubmissions&simple&sortby=numreviews&dir={$nextdir}">number of reviews</a>,
<a href="index.php?action=printsubmissions&simple&sortby=title&dir={$nextdir}">title</a>
</span>
</p>


{* include file="screen_browser.tpl" *}

<div style="text-align:left;">

{foreach from=$submissions item="submission"}
Title:
<a href="index.php?action=showsubmission&id={$submission.id}">{$submission.title}</a>
<br/>
Author:
<a href="index.php?action=showuser&id={$submission.user.id}">{$submission.user.firstname} {$submission.user.lastname}</a></span>
{* no affiliation <td>{$submission.user.affiliation}</td> *}
<br/>
Type:
{$submission.type}
<br/>
Rating:
{$submission.averagerating|string_format:"%.2f"}
<br/>
Number of reviews:
{$submission.numreviews}
<br/>
{* no keywords
<tr>
<td colspan="100" align="center">
Keywords: <b>{$submission.keywords}</b>
</td>
</tr>
*}

<div class="textbox">{$submission.abstract|nl2br}</div>

<br/>

{foreachelse}
<tr><td colspan=100>No submissions.</td></tr>
{/foreach}

</div>

</body>
</html>