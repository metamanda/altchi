<?php /* Smarty version 2.6.13, created on 2013-12-10 03:57:04
         compiled from submissions.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'string_format', 'submissions.tpl', 77, false),)), $this); ?>

<?php if ($this->_tpl_vars['dir'] == 1):  $this->assign('nextdir', 0);  else:  $this->assign('nextdir', 1);  endif; ?>

<h1>All papers</h1>

<p>
<span>
Sort by
submission date&nbsp;<a href="index.php?action=submissions&sortby=date&dir=1"><img src="gfx/uparrow.png" /></a><a href="index.php?action=submissions&sortby=date&dir=0"><img src="gfx/downarrow.png" /></a>,
number of reviews&nbsp;<a href="index.php?action=submissions&sortby=numreviews&dir=0"><img src="gfx/uparrow.png" /></a><a href="index.php?action=submissions&sortby=numreviews&dir=1"><img src="gfx/downarrow.png" /></a>,
author&nbsp;<a href="index.php?action=submissions&sortby=author&dir=1"><img src="gfx/uparrow.png" /></a><a href="index.php?action=submissions&sortby=author&dir=0"><img src="gfx/downarrow.png" /></a>,
rating&nbsp;<a href="index.php?action=submissions&sortby=rating&dir=1"><img src="gfx/uparrow.png" /></a><a href="index.php?action=submissions&sortby=rating&dir=0"><img src="gfx/downarrow.png" /></a>,
title&nbsp;<a href="index.php?action=submissions&sortby=title&dir=0"><img src="gfx/uparrow.png" /></a><a href="index.php?action=submissions&sortby=title&dir=1"><img src="gfx/downarrow.png" /></a>
</span>
</p>

<p>
<?php if ($this->_tpl_vars['showabstract']): ?>
<a href="index.php?action=submissions&sortby=<?php echo $this->_tpl_vars['sorting']; ?>
&dir=<?php echo $this->_tpl_vars['dir']; ?>
&hideabstract">Hide abstracts</a>
<?php else: ?>
<a href="index.php?action=submissions&sortby=<?php echo $this->_tpl_vars['sorting']; ?>
&dir=<?php echo $this->_tpl_vars['dir']; ?>
">Show abstracts</a>
<?php endif; ?>
<br>
<a href="index.php?action=submissions&sortby=<?php echo $this->_tpl_vars['sorting']; ?>
&dir=<?php echo $this->_tpl_vars['dir']; ?>
&simple">Simple view</a>
</p>



<table width="100%" style="border-style: 0px none;" class="fullentry">

<?php $_from = $this->_tpl_vars['submissions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['submission']):
?>
<tr><td>
<div class="list" style="margin-bottom: 1em;">
<table width=100%>
<tr>
<td class="listcaption">Title</td>
<td class="titlelist">
<a href="index.php?action=showsubmission&id=<?php echo $this->_tpl_vars['submission']['id']; ?>
"><?php echo $this->_tpl_vars['submission']['title']; ?>
</a>
</td>
</tr>

<tr>
<td class="listcaption">Author</td>
<td nowrap class="silentlink"><span style="white-space:nowrap"><a href="index.php?action=showuser&id=<?php echo $this->_tpl_vars['submission']['user']['id']; ?>
"><?php echo $this->_tpl_vars['submission']['user']['firstname']; ?>
 <?php echo $this->_tpl_vars['submission']['user']['lastname']; ?>
</a></span></td>
</tr>

<tr>
<td class="listcaption">Affiliation</td>
<td><?php echo $this->_tpl_vars['submission']['user']['affiliation']; ?>
</td>
</tr>

<tr>
<td class="listcaption" nowrap><span style="white-space:nowrap">Reviews</span></td>
<td><?php echo $this->_tpl_vars['submission']['numreviews']; ?>
</td>
</tr>

<tr>
<td class="listcaption" nowrap><span style="white-space:nowrap">Comments</span></td>
<td><?php echo $this->_tpl_vars['submission']['numcomments']; ?>
</td>
</tr>

<tr>
<td class="listcaption">Keywords</td>
<td><?php echo $this->_tpl_vars['submission']['keywords']; ?>
</td>
</tr>

<?php if ($this->_tpl_vars['submission']['avgqual'] > 0): ?> 
<tr>
<td class="listcaption">Average ratings</td>
<td nowrap><span style="white-space:nowrap">Quality: <?php echo ((is_array($_tmp=$this->_tpl_vars['submission']['avgqual'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.1f") : smarty_modifier_string_format($_tmp, "%.1f")); ?>
 Appropriateness: <?php echo ((is_array($_tmp=$this->_tpl_vars['submission']['avgappr'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.1f") : smarty_modifier_string_format($_tmp, "%.1f")); ?>
 Promote discussion: <?php echo ((is_array($_tmp=$this->_tpl_vars['submission']['avgdisc'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.1f") : smarty_modifier_string_format($_tmp, "%.1f")); ?>
</span></td>
</tr>
<?php endif; ?>


<?php if ($this->_tpl_vars['showabstract']): ?>
<tr>
<td class="listcaption">Abstract</td>
<td class="abstractlist"><?php echo $this->_tpl_vars['submission']['abstract']; ?>
</td>
<?php endif; ?>

</table>

</div>

</td></tr>

<?php endforeach; else: ?>

<tr><td>No submissions.</td></tr>

<?php endif; unset($_from); ?>

</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "screen_browser.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
