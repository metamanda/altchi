<?php /* Smarty version 2.6.13, created on 2013-12-10 02:38:21
         compiled from submissions_simple.tpl */ ?>

<?php if ($this->_tpl_vars['dir'] == 1):  $this->assign('nextdir', 0);  else:  $this->assign('nextdir', 1);  endif; ?>

<h1>All papers - Summary</h1>

<p>
<span>
Sort by
submission date&nbsp;<a href="index.php?action=submissions&sortby=date&dir=1&simple"><img src="gfx/uparrow.png" /></a><a href="index.php?action=submissions&sortby=date&dir=0&simple"><img src="gfx/downarrow.png" /></a>,
number of reviews&nbsp;<a href="index.php?action=submissions&sortby=numreviews&dir=0&simple"><img src="gfx/uparrow.png" /></a><a href="index.php?action=submissions&sortby=numreviews&dir=1&simple"><img src="gfx/downarrow.png" /></a>,
author&nbsp;<a href="index.php?action=submissions&sortby=author&dir=1&simple"><img src="gfx/uparrow.png" /></a><a href="index.php?action=submissions&sortby=author&dir=0&simple"><img src="gfx/downarrow.png" /></a>,
title&nbsp;<a href="index.php?action=submissions&sortby=title&dir=0&simple"><img src="gfx/uparrow.png" /></a><a href="index.php?action=submissions&sortby=title&dir=1&simple"><img src="gfx/downarrow.png" /></a>
</span>
</p>

<p>

<br>
<a href="index.php?action=submissions&sortby<?php echo $this->_tpl_vars['sorting']; ?>
&dir=<?php echo $this->_tpl_vars['dir']; ?>
">Extended view</a>
</p>


<div class="list">

<br>

<table width="90%">

<?php $_from = $this->_tpl_vars['submissions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['submission']):
?>
<tr>

<td colspan=5>
<b><a href="index.php?action=showsubmission&id=<?php echo $this->_tpl_vars['submission']['id']; ?>
"><?php echo $this->_tpl_vars['submission']['title']; ?>
</a></b>
</td>
</tr>
<tr>
<td nowrap class="silentlink"><span style="white-space:nowrap">First Author: <a href="index.php?action=showuser&id=<?php echo $this->_tpl_vars['submission']['user']['id']; ?>
"><?php echo $this->_tpl_vars['submission']['user']['firstname']; ?>
 <?php echo $this->_tpl_vars['submission']['user']['lastname']; ?>
</a></span></td>

<td>Reviews: <?php echo $this->_tpl_vars['submission']['numreviews']; ?>
</td>
<td>Comments: <?php echo $this->_tpl_vars['submission']['numcomments']; ?>
</td>
<td nowrap>Activity: 
	<?php if ($this->_tpl_vars['submission']['latestdate'] == 0): ?>
		today	
	<?php elseif ($this->_tpl_vars['submission']['latestdate'] == 1): ?>
		yesterday
	<?php else: ?> 
		<?php echo $this->_tpl_vars['submission']['latestdate']; ?>
 days ago	
	<?php endif; ?>	
</td>
<tr height="10"><td>&nbsp;</td></tr>
</tr>

<?php if ($this->_tpl_vars['showabstract']): ?>
<tr>
<td colspan="100" style="white-space:normal;padding: 1em 1em 1em 1em; font-family: sans-serif; font-size: 9pt;">
<?php echo $this->_tpl_vars['submission']['abstract']; ?>

</td>
</tr>
<?php endif; ?>

<?php endforeach; else: ?>
<tr><td colspan=100>No submissions.</td></tr>
<?php endif; unset($_from); ?>

</table>
<br>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "screen_browser.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</div>