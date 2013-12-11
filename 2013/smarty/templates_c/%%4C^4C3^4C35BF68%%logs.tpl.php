<?php /* Smarty version 2.6.13, created on 2013-01-19 07:40:05
         compiled from logs.tpl */ ?>

<html>
<body>

<table>
<tr>
<th>time</th>
<th>user id</th>
<th>category</th>
<th>event</th>
<th>details</th>
</tr>
<?php $_from = $this->_tpl_vars['logs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['log']):
?>
<tr>
<td><?php echo $this->_tpl_vars['log']['time']; ?>
</td>
<td><?php echo $this->_tpl_vars['log']['userid']; ?>
</td>
<td><?php echo $this->_tpl_vars['log']['category']; ?>
</td>
<td><?php echo $this->_tpl_vars['log']['event']; ?>
</td>
<td><?php echo $this->_tpl_vars['log']['details']; ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>

</body>
</html>