{* SMARTY *}

{foreach from=$formerror item="msg"}

<span class="errormessage">{$msg}</span><br>

{/foreach}

<div class="formtable" id="registerlist">
<div id="registerhead">
<span id="registerheadleft">&nbsp;&nbsp;Welcome to altchi!</span>
<span id="registerheadright">Please register&nbsp;&nbsp;</span>
</div>

<form method="post" action="login.php?action=register">
<ul><p></p>
<li id="firstli">
<label class="formtablelabel">Username</label>
<input type="text" name="user" value="{$form.user}">
</li>
<li id="password">
<label class="formtablelabel">Password</label>
<input type="password" name="pass1">
</li>
<li>
<label class="formtablelabel">...again</label>
<input type="password" name="pass2">
</li>
<li>
<label class="formtablelabel" nowrap>First name</label>
<input type="text" name="first" value="{$form.first}">
</li>
<li>
<label class="formtablelabel" nowrap>Last name</label>
<input type="text" name="last" value="{$form.last}">
</li>
<li>
<label class="formtablelabel">Affiliation</label>
<input type="text" name="affiliation" value="{$form.affiliation}">
</li>
<li>
<label class="formtablelabel">Email address</label>
<input type="text" name="email" value="{$form.email}">
</li>
<br>
<li>
<input type="submit" value="OK">
</li>
</ul>
</form>

</div>
