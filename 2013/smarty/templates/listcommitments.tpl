{* smarty *}

<h1>Commitments</h1>

<div class="list">

<table>
<tr>
<th><a href="index.php?action=listcommitments&sortby=user">User</a></th>
<th><a href="index.php?action=listcommitments&sortby=submission">Submission</a></th>
</tr>

{foreach from=$commitments item="commitment"}

<tr>
<td><a href="index.php?action=showuser&id={$commitment.user.userid}">{$commitment.user.firstname} {$commitment.user.lastname}</a></td>
<td><a href="index.php?action=showsubmission&id={$commitment.submission.id}">{$commitment.submission.title}</a></td>
</tr>

{foreachelse}

<tr>
<td colspan="100">
No commitments
</td>
</tr>

{/foreach}

</table>

</div>
