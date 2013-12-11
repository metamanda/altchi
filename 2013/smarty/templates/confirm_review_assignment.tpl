{* smarty *}

<h2>Confirm sending email</h2>

<form method="POST" action="index.php?action=assign_review">

<div class="list">

<table>

<input type="hidden" name="submissionid" value="{$submissionid}">

{foreach from=$users item="user"}
<input type="hidden" name="user[]" value="{$user.id}">
<tr>
<td class="listcaption">Recipient</td>
<td>{$user.firstname} {$user.lastname} : {$user.email}</td>
</tr>
{/foreach}

<tr>
<td class="listcaption">Email</td>
<td>
<textarea name="email">{$email}</textarea>
</td>
</tr>
</table>

</div>

<input type="submit" name="confirm" value="confirm"><br/>
(just hit back button to go back)

</form>