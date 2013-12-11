<?php /* Smarty version 2.6.13, created on 2007-10-23 22:42:45
         compiled from forum_threads.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'forum_threads.tpl', 40, false),)), $this); ?>

<?php $_from = $this->_tpl_vars['error']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['msg']):
?>
<span class="errormessage"><?php echo $this->_tpl_vars['msg']; ?>
</span><br>
<?php endforeach; endif; unset($_from); ?>

<div class="forumnav"><a href="forum.php">Forum</a> &gt; <?php echo $this->_tpl_vars['category']['name']; ?>
</div>
<p>
<?php echo $this->_tpl_vars['category']['description']; ?>

</p>

<?php if ($this->_tpl_vars['logged_in']):  if (! $this->_tpl_vars['category']['locked']): ?>
<p>
<form method="post" action="forum.php?action=showcategory&id=<?php echo $this->_tpl_vars['category']['id']; ?>
">
New thread <input type="text" name="subject"> <input type="submit" value="Ok"><br>
</form>
</p>
<?php endif;  endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "screen_browser.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="list">

<table id="forumthreads" class="forum">
<tr>
<th style="width: 100%;">Subject</th>
<th style="width: 1px;">Started</th>
<th style="width: 1px;" nowrap><span style="white-space:nowrap;">Last Post</span></th>
<th style="width: 1px;" nowrap><span style="white-space:nowrap;">New posts</span></th>
<?php if ($this->_tpl_vars['admin']): ?>
<th style="width: 1px;">Controls</th>
<?php endif; ?>
</tr>
<?php $_from = $this->_tpl_vars['threads']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['thread']):
?>
<tr>
<td style="width: *;"><a href="forum.php?action=showthread&id=<?php echo $this->_tpl_vars['thread']['id']; ?>
"><?php echo $this->_tpl_vars['thread']['subject']; ?>
</a></td>
<td style="width: 1px;" nowrap><span style="white-space:nowrap"><?php echo ((is_array($_tmp=$this->_tpl_vars['thread']['started'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
</span></td>
<td style="width: 1px;" nowrap><span style="white-space:nowrap"><?php echo ((is_array($_tmp=$this->_tpl_vars['thread']['last_posted'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M")); ?>
</span></td>
<td style="width: 1px; text-align: center;"><?php echo $this->_tpl_vars['thread']['newposts']; ?>
</td>

<?php if ($this->_tpl_vars['admin']): ?>
<td align="right" style="width: 1px;"><a href="forum.php?action=deletethread&id=<?php echo $this->_tpl_vars['thread']['id']; ?>
&index=$index">delete</a></td>
<?php endif; ?>

</tr>

<?php endforeach; else: ?>

<tr><td colspan="100">
No threads.
</td></tr>

<?php endif; unset($_from); ?>

</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "screen_browser.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</div>