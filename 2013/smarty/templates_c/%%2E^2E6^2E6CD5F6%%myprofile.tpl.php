<?php /* Smarty version 2.6.13, created on 2013-12-03 11:03:36
         compiled from myprofile.tpl */ ?>

<?php $_from = $this->_tpl_vars['formerror']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['msg']):
?>
<span class="errormessage"><?php echo $this->_tpl_vars['msg']; ?>
</span><br>
<?php endforeach; endif; unset($_from); ?>

<h1>My profile</h1>

<div class="formtable">

<form method="post" action="index.php?action=myprofile">
<table>

<tr>
<td class="formtablelabel">Username</td>
<td><?php echo $this->_tpl_vars['userprofile']['user']; ?>
</td>
</tr>

<tr>
<td class="formtablelabel">Email</td>
<td width="200"><input type="text" value="<?php echo $this->_tpl_vars['userprofile']['email']; ?>
" name="email" style="width:200;"></td>
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
<td><input type="text" name="affiliation" value="<?php echo $this->_tpl_vars['userprofile']['affiliation']; ?>
" style="width:200;"></td>
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