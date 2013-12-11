{*
smarty
*}

<h1>{$showuser.firstname} {$showuser.lastname}</h1>

<div class="list">

<table>
<tr><th style="width:1px;">Username</th><td>{$showuser.user}</td></tr>
{if $admin}
 <tr><th style="width:1px;">Email</th><td>{$showuser.email}</td></tr>
{/if}
<tr><th style="width:1px;">Affiliation</th><td>{$showuser.affiliation}</td></tr>

</table>

<p>

<h3>Submissions</h3>
<table WIDTH=100%>
<tr>
<th>Title</th>
<th>Submission date</th>
</tr>
{foreach from=$submissions item="submission"}
<tr>
<td><a href="index.php?action=showsubmission&id={$submission.id}">{$submission.title|truncate:60}</a></td>
<td>{$submission.submitted}</td>
</tr>
{foreachelse}
<tr><td colspan="100">No submissions.</td></tr>
{/foreach}
</table>


<h3>Reviews</h3>
<table WIDTH=100%>

<tr>
<th>Submission title</th>
<th>Author</th>
<th>Rating</th>
<th>Review date</th>
</tr>
{foreach from=$reviews item="review"}
{*<tr> <pre> {$review|print_r} </pre> </tr>*}
<tr>
<td><a href="index.php?action=showsubmission&id={$review.submission.id}#post_header_{$review.id}">{$review.submission.title|truncate:60}</a></td>
<td>{$review.submission.user.lastname}</td>
<td>
{if $review.quality>0}
{$review.quality},{$review.appropriate},{$review.controversial}:<b>{$review.quality+$review.appropriate+$review.controversial}</b>
{/if}
</td>
<td nowrap><span style="white-space:nowrap">{$review.posted|truncate:10:""}</a></td>
</tr>
{foreachelse}
<tr><td colspan="100">No reviews.</td></tr>
{/foreach}
</table>

</div>
