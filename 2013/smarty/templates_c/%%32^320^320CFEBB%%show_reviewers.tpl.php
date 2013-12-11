<?php /* Smarty version 2.6.13, created on 2013-03-12 10:06:39
         compiled from show_reviewers.tpl */ ?>

<h1>All reviewers -- warning! includes duplicates</h1>

<table width=100%>
    <tr><th>first</th><th>last</th><th>affiliation</th><th>email</th></tr>
	<div class="list">
	<?php $_from = $this->_tpl_vars['posts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['post']):
?>
	  <tr>
		<td><?php echo $this->_tpl_vars['post']['user']['firstname']; ?>
</td>
		<td><?php echo $this->_tpl_vars['post']['user']['lastname']; ?>
</td>
		<td><?php echo $this->_tpl_vars['post']['user']['affiliation']; ?>
</td>
		<td><?php echo $this->_tpl_vars['post']['user']['email']; ?>
</td>
	  </tr>
	<?php endforeach; endif; unset($_from); ?>
	</div>
</table>