{* smarty *}

<h1>Mail everyone!</h1>

<div class="formtable">

<form method="post" action="index.php?action=mailall">
<table>

<tr>
<td class="formtablelabel">Subject</td>
<td><input type="text" name="subject" value="[alt.chi] " size="60"></td>
</tr>

<tr>
<td class="formtablelabel">Content</td>
<td><textarea name="content" rows="10" cols="100"></textarea></td>
</tr>

<tr>
<td/>
<td><input type="submit" value="Submit"></td>
</tr>

</table>
</form>

</div>
