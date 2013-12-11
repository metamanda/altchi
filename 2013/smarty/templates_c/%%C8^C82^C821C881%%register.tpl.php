<?php /* Smarty version 2.6.13, created on 2013-12-10 01:57:50
         compiled from register.tpl */ ?>

<?php $_from = $this->_tpl_vars['formerror']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['msg']):
?>

<span class="errormessage"><?php echo $this->_tpl_vars['msg']; ?>
</span><br>

<?php endforeach; endif; unset($_from); ?>

<div class="formtable" id="registerlist">
<div id="registerhead">
<span id="registerheadleft">&nbsp;&nbsp;Welcome to altchi!</span>
<span id="registerheadright">Please register&nbsp;&nbsp;</span>
</div>

<form method="post" action="login.php?action=register">
<ul><p></p>
<li id="firstli">
<label class="formtablelabel">Username</label>
<input type="text" name="user" value="<?php echo $this->_tpl_vars['form']['user']; ?>
">
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
<input type="text" name="first" value="<?php echo $this->_tpl_vars['form']['first']; ?>
">
</li>
<li>
<label class="formtablelabel" nowrap>Last name</label>
<input type="text" name="last" value="<?php echo $this->_tpl_vars['form']['last']; ?>
">
</li>
<li>
<label class="formtablelabel">Affiliation</label>
<input type="text" name="affiliation" value="<?php echo $this->_tpl_vars['form']['affiliation']; ?>
">
</li>
<li>
<label class="formtablelabel">Email address</label>
<input type="text" name="email" value="<?php echo $this->_tpl_vars['form']['email']; ?>
">
</li>
<br>
<li>
<input type="submit" value="OK">
</li>
</ul>
</form>

</div>