<?php /* Smarty version 2.6.13, created on 2007-11-12 20:47:43
         compiled from list_reviews.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'list_reviews.tpl', 18, false),)), $this); ?>

<div class="list">

<table width="100%">
<tr>
<th>Reviewer</th>
<th>Rating</th>
<th>Expertise</th>
<th>Submitted</th>
</tr>

<?php $_from = $this->_tpl_vars['reviews']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['review']):
?>
<tr>
<td style="width:100%"><a href="index.php?action=showreview&id=<?php echo $this->_tpl_vars['review']['id']; ?>
"><?php echo $this->_tpl_vars['review']['user']['firstname']; ?>
 <?php echo $this->_tpl_vars['review']['user']['lastname']; ?>
</a></td>
<td align="center" style="width:1px;"><?php echo $this->_tpl_vars['review']['overallrating']; ?>
</td>
<td align="center" style="width:1px;"><?php echo $this->_tpl_vars['review']['expertise']; ?>
</td>
<td align="right" style="width:1px;" nowrap><span style="white-space:nowrap"><?php echo ((is_array($_tmp=$this->_tpl_vars['review']['submitted'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M")); ?>
</span></td>
</tr>
<?php endforeach; else: ?>
<tr><td colspan="100">
No reviews yet.
</tr></td>
<?php endif; unset($_from); ?>
</table>

</div>