<?php /* Smarty version 2.6.13, created on 2013-02-12 12:15:22
         compiled from print_submissions.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'string_format', 'print_submissions.tpl', 46, false),array('modifier', 'nl2br', 'print_submissions.tpl', 59, false),)), $this); ?>

<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css" />
<title>alt.chi forum</title>
</head>
<body>

<?php if ($this->_tpl_vars['dir'] == 1):  $this->assign('nextdir', 0);  else:  $this->assign('nextdir', 1);  endif; ?>

<h1>Submissions</h1>

<p>
<span>
Sort by
<a href="index.php?action=printsubmissions&simple&sortby=date&dir=<?php echo $this->_tpl_vars['nextdir']; ?>
">submission date</a>,
<a href="index.php?action=printsubmissions&simple&sortby=author&dir=<?php echo $this->_tpl_vars['nextdir']; ?>
">author</a>,
<a href="index.php?action=printsubmissions&simple&sortby=rating&dir=<?php echo $this->_tpl_vars['nextdir']; ?>
">rating</a>,
<a href="index.php?action=printsubmissions&simple&sortby=numreviews&dir=<?php echo $this->_tpl_vars['nextdir']; ?>
">number of reviews</a>,
<a href="index.php?action=printsubmissions&simple&sortby=title&dir=<?php echo $this->_tpl_vars['nextdir']; ?>
">title</a>
</span>
</p>



<div style="text-align:left;">

<?php $_from = $this->_tpl_vars['submissions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['submission']):
?>
Title:
<a href="index.php?action=showsubmission&id=<?php echo $this->_tpl_vars['submission']['id']; ?>
"><?php echo $this->_tpl_vars['submission']['title']; ?>
</a>
<br/>
Author:
<a href="index.php?action=showuser&id=<?php echo $this->_tpl_vars['submission']['user']['id']; ?>
"><?php echo $this->_tpl_vars['submission']['user']['firstname']; ?>
 <?php echo $this->_tpl_vars['submission']['user']['lastname']; ?>
</a></span>
<br/>
Type:
<?php echo $this->_tpl_vars['submission']['type']; ?>

<br/>
Rating:
<?php echo ((is_array($_tmp=$this->_tpl_vars['submission']['averagerating'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>

<br/>
Number of reviews:
<?php echo $this->_tpl_vars['submission']['numreviews']; ?>

<br/>

<div class="textbox"><?php echo ((is_array($_tmp=$this->_tpl_vars['submission']['abstract'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</div>

<br/>

<?php endforeach; else: ?>
<tr><td colspan=100>No submissions.</td></tr>
<?php endif; unset($_from); ?>

</div>

</body>
</html>