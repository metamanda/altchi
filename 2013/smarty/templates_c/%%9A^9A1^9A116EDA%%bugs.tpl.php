<?php /* Smarty version 2.6.13, created on 2012-12-16 12:08:11
         compiled from bugs.tpl */ ?>

<html>
<body>

<table>
<tr>
<th>bug id</th>
<th>user id</th>
<th>status</th>
<th>bug description</th>
</tr>
<?php $_from = $this->_tpl_vars['bugs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['bug']):
?>
<tr>
<td><?php echo $this->_tpl_vars['bug']['id']; ?>
</td>
<td><?php echo $this->_tpl_vars['bug']['userid']; ?>
</td>
<td><?php echo $this->_tpl_vars['bug']['status']; ?>
</td>
<td><?php echo $this->_tpl_vars['bug']['text']; ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>

</body>
</html>