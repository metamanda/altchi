<?php /* Smarty version 2.6.13, created on 2007-10-23 19:55:41
         compiled from myreviews.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'myreviews.tpl', 20, false),)), $this); ?>

<h1>My reviews</h1>

<div class="list">

<table width="100%">
<tr>
<th style="width:100%" nowrap><span style="white-space:nowrap;">Submission title</span></th>
<th style="width:1px;" nowrap><span style="white-space:nowrap">My Rating</span></th>
<th style="width:1px;" nowrap><span style="white-space:nowrap">Average Rating</span></th>
<th style="width:1px;">Submitted</th>
</tr>

<?php $_from = $this->_tpl_vars['reviews']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['review']):
?>
<tr>
<td><a href="index.php?action=showreview&id=<?php echo $this->_tpl_vars['review']['id']; ?>
"><?php echo $this->_tpl_vars['review']['submission']['title']; ?>
</a></td>
<td align="center"><?php echo $this->_tpl_vars['review']['overallrating']; ?>
</td>
<td align="center"><?php echo $this->_tpl_vars['review']['submission']['averagerating']; ?>
</td>
<td align="right" style="width:1px" nowrap><span style="white-space:nowrap;"><?php echo ((is_array($_tmp=$this->_tpl_vars['review']['submitted'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M")); ?>
</span></td>
</tr>
<?php endforeach; else: ?>
<tr><td colspan="100">
No reviews yet.
</tr></td>
<?php endif; unset($_from); ?>

</div>