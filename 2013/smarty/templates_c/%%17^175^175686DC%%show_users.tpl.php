<?php /* Smarty version 2.6.13, created on 2013-12-03 11:02:32
         compiled from show_users.tpl */ ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "screen_browser.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="list">

<table>
<tr>
<th>User name</th>
<th>Real name</th>
<?php if ($this->_tpl_vars['admin']): ?>
<th>Controls</th>
<?php endif; ?>
</tr>

<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
<tr>
<td><a href="index.php?action=showuser&id=<?php echo $this->_tpl_vars['user']['id']; ?>
"><?php echo $this->_tpl_vars['user']['user']; ?>
</a></td>
<td nowrap><?php echo $this->_tpl_vars['user']['firstname']; ?>
 <?php echo $this->_tpl_vars['user']['lastname']; ?>
</td>
<?php if ($this->_tpl_vars['admin']): ?>
<td align="right">
<?php if ($this->_tpl_vars['user']['status'] != 'admin'): ?>
<span title="make admin"><a href="index.php?action=makeadmin&id=<?php echo $this->_tpl_vars['user']['id']; ?>
&index=<?php echo $this->_tpl_vars['index']; ?>
">a</a></span>
<?php endif; ?>
<span title="delete user"><a href="index.php?action=deleteuser&id=<?php echo $this->_tpl_vars['user']['id']; ?>
&index=<?php echo $this->_tpl_vars['index']; ?>
">x</a></span>
</td>
<?php endif; ?>
</tr>
<?php endforeach; else: ?>
<tr><td>No users.</td></tr>
<?php endif; unset($_from); ?>

</table>

</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "screen_browser.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>