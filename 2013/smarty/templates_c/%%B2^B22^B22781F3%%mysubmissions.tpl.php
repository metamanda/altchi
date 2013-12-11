<?php /* Smarty version 2.6.13, created on 2007-10-23 19:51:29
         compiled from mysubmissions.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'mysubmissions.tpl', 17, false),)), $this); ?>
<h1>My Submissions</h1>

<div class="list">

<table width="100%">

<tr>
<th style="width: 100%;" nowrap>Title</th>
<th style="width: 1px;" nowrap>Type</th>
<th style="width: 1px;" nowrap>Rating</th>
</tr>

<?php $_from = $this->_tpl_vars['submissions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['submission']):
?>
<tr>
<td>
<a href="index.php?action=showsubmission&id=<?php echo $this->_tpl_vars['submission']['id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['submission']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 60, "...") : smarty_modifier_truncate($_tmp, 60, "...")); ?>
</a>
</td>
<td nowrap><span style="white-space:nowrap"><?php echo $this->_tpl_vars['submission']['type']; ?>
</span></td>
<td nowrap><span style="white-space:nowrap"><?php echo $this->_tpl_vars['submission']['averagerating']; ?>
</span></td>
</tr>
<?php endforeach; else: ?>
<tr><td colspan=100>No submissions.</td></tr>
<?php endif; unset($_from); ?>

</table>

</div>