{* smarty *}

{foreach from=$formerror item="msg"}
<span class="errormessage">{$msg}</span><br>
{/foreach}

<h1>My profile</h1>

<div class="formtable">

<form method="post" action="index.php?action=myprofile">
<table>

<tr>
<td class="formtablelabel">Username</td>
<td>{$userprofile.user}</td>
</tr>

<tr>
<td class="formtablelabel">Email</td>
<td width="200"><input type="text" value="{$userprofile.email}" name="email" style="width:200;"></td>
</tr>

<tr>
<td class="formtablelabel">Password</td>
<td><input type="password" name="pass1" style="width:200;"></td>
</tr>

<tr>
<td class="formtablelabel" nowrap><span style="white-space:nowrap">Confirm password</span></td>
<td><input type="password" name="pass2" style="width:200;"></td>
</tr>

<tr>
<td class="formtablelabel">Affiliation</td>
<td><input type="text" name="affiliation" value="{$userprofile.affiliation}" style="width:200;"></td>
</tr>

<tr>
<td/>
<td>
<input type="submit" value="Save">
</td>
</tr>

</table>
</form>

</div>
