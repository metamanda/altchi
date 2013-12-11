<?php /* Smarty version 2.6.13, created on 2013-12-10 03:28:58
         compiled from show_user.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'show_user.tpl', 28, false),)), $this); ?>

<h1><?php echo $this->_tpl_vars['showuser']['firstname']; ?>
 <?php echo $this->_tpl_vars['showuser']['lastname']; ?>
</h1>

<div class="list">

<table>
<tr><th style="width:1px;">Username</th><td><?php echo $this->_tpl_vars['showuser']['user']; ?>
</td></tr>
<?php if ($this->_tpl_vars['admin']): ?>
 <tr><th style="width:1px;">Email</th><td><?php echo $this->_tpl_vars['showuser']['email']; ?>
</td></tr>
<?php endif; ?>
<tr><th style="width:1px;">Affiliation</th><td><?php echo $this->_tpl_vars['showuser']['affiliation']; ?>
</td></tr>

</table>

<p>

<h3>Submissions</h3>
<table WIDTH=100%>
<tr>
<th>Title</th>
<th>Submission date</th>
</tr>
<?php $_from = $this->_tpl_vars['submissions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['submission']):
?>
<tr>
<td><a href="index.php?action=showsubmission&id=<?php echo $this->_tpl_vars['submission']['id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['submission']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 60) : smarty_modifier_truncate($_tmp, 60)); ?>
</a></td>
<td><?php echo $this->_tpl_vars['submission']['submitted']; ?>
</td>
</tr>
<?php endforeach; else: ?>
<tr><td colspan="100">No submissions.</td></tr>
<?php endif; unset($_from); ?>
</table>


<h3>Reviews</h3>
<table WIDTH=100%>

<tr>
<th>Submission title</th>
<th>Author</th>
<th>Rating</th>
<th>Review date</th>
</tr>
<?php $_from = $this->_tpl_vars['reviews']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['review']):
?>
<tr>
<td><a href="index.php?action=showsubmission&id=<?php echo $this->_tpl_vars['review']['submission']['id']; ?>
#post_header_<?php echo $this->_tpl_vars['review']['id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['review']['submission']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 60) : smarty_modifier_truncate($_tmp, 60)); ?>
</a></td>
<td><?php echo $this->_tpl_vars['review']['submission']['user']['lastname']; ?>
</td>
<td>
<?php if ($this->_tpl_vars['review']['quality'] > 0):  echo $this->_tpl_vars['review']['quality']; ?>
,<?php echo $this->_tpl_vars['review']['appropriate']; ?>
,<?php echo $this->_tpl_vars['review']['controversial']; ?>
:<b><?php echo $this->_tpl_vars['review']['quality']+$this->_tpl_vars['review']['appropriate']+$this->_tpl_vars['review']['controversial']; ?>
</b>
<?php endif; ?>
</td>
<td nowrap><span style="white-space:nowrap"><?php echo ((is_array($_tmp=$this->_tpl_vars['review']['posted'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 10, "") : smarty_modifier_truncate($_tmp, 10, "")); ?>
</a></td>
</tr>
<?php endforeach; else: ?>
<tr><td colspan="100">No reviews.</td></tr>
<?php endif; unset($_from); ?>
</table>

</div>