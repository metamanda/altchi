{* smarty *}

<div>

<p>
The following persons have been assigned to review this paper
<p>
{foreach from=$assigned_users item="user"}
{$user.firstname} {$user.lastname}<br/>
{/foreach}
</p>
</p>

<form name="form_assign_reviews" method="POST" action="index.php?action=assign_review">

<input type="hidden" name="submissionid" value="{$submission.id}">

<select name="user[]">
{*{foreach from=$users item="user"}
<option value="{$user.id}">{$user.firstname|escape} {$user.lastname|escape}
{/foreach}*}
<option value="-1">-- NONE --
{foreach from=$ar_submissions item="submission"}
<option value="{$submission.user.id}">{$submission.user.firstname|escape} {$submission.user.lastname|escape} - {$submission.title|escape}
{/foreach}
</select>
<br/>
<select name="user[]">
<option value="-1">-- NONE --
{foreach from=$ar_submissions item="submission"}
<option value="{$submission.user.id}">{$submission.user.firstname|escape} {$submission.user.lastname|escape} - {$submission.title|escape}
{/foreach}
</select>
<br/>
<select name="user[]">
<option value="-1">-- NONE --
{foreach from=$ar_submissions item="submission"}
<option value="{$submission.user.id}">{$submission.user.firstname|escape} {$submission.user.lastname|escape} - {$submission.title|escape}
{/foreach}
</select>
<br/>

<textarea name="email">{$email}</textarea>
<br/>

<input type="submit" value="Send">

</form>

</div>
