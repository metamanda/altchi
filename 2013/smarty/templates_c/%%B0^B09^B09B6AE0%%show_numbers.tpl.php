<?php /* Smarty version 2.6.13, created on 2013-01-10 06:48:47
         compiled from show_numbers.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'counter', 'show_numbers.tpl', 54, false),array('modifier', 'truncate', 'show_numbers.tpl', 54, false),array('modifier', 'string_format', 'show_numbers.tpl', 70, false),)), $this); ?>

<?php if ($this->_tpl_vars['dir'] == 1):  $this->assign('nextdir', 0);  else:  $this->assign('nextdir', 1);  endif;  $this->assign('reviewcount', 0);  $this->assign('commentcount', 0);  $this->assign('papercount', 0);  $this->assign('avgavgqual', 0);  $this->assign('avgavgdisc', 0);  $this->assign('avgavgappr', 0);  $this->assign('avgavgtotal', 0); ?>

<h1>Show Numbers</h1>

<p>
<span>
Sort by
<a href="index.php?action=shownumbers&sortby=date&dir=<?php echo $this->_tpl_vars['nextdir']; ?>
">submission date</a>,
<a href="index.php?action=shownumbers&sortby=author&dir=<?php echo $this->_tpl_vars['nextdir']; ?>
">author</a>,
<a href="index.php?action=shownumbers&sortby=numreviews&dir=<?php echo $this->_tpl_vars['nextdir']; ?>
">number of reviews</a>,
<a href="index.php?action=shownumbers&sortby=title&dir=<?php echo $this->_tpl_vars['nextdir']; ?>
">title</a>,
<a href="index.php?action=shownumbers&sortby=total&dir=<?php echo $this->_tpl_vars['nextdir']; ?>
">average total score</a>
</span>
</p>

<div class="list">

<br>

<table width="90%">

<tr>
<th style="width: 10em;"><a class="menuoption" href="index.php?action=shownumbers&sortby=title&dir=<?php echo $this->_tpl_vars['nextdir']; ?>
">Title</a></th>
<th style="width: 1px;" nowrap><a class="menuoption" href="index.php?action=shownumbers&sortby=author&dir=<?php echo $this->_tpl_vars['nextdir']; ?>
">Author</a></th>
<th style="width: 1px;" nowrap><a class="menuoption" href="index.php?action=shownumbers&sortby=numreviews&dir=<?php echo $this->_tpl_vars['nextdir']; ?>
">Revs</a></th>
<th style="width: 1px;" nowrap><a class="menuoption" href="index.php?action=shownumbers&sortby=numcomments&dir=<?php echo $this->_tpl_vars['nextdir']; ?>
">Coms</a></th>
<th style="width: 1px;" nowrap><a class="menuoption" href="index.php?action=shownumbers&sortby=quality&dir=<?php echo $this->_tpl_vars['nextdir']; ?>
">Qual</a></th>
<th style="width: 1px;" nowrap><a class="menuoption" href="index.php?action=shownumbers&sortby=appropriate&dir=<?php echo $this->_tpl_vars['nextdir']; ?>
">Appr</a></th>
<th style="width: 1px;" nowrap><a class="menuoption" href="index.php?action=shownumbers&sortby=discussion&dir=<?php echo $this->_tpl_vars['nextdir']; ?>
">Disc</a></th>
<th style="width: 1px;" nowrap><a class="menuoption" href="index.php?action=shownumbers&sortby=total&dir=<?php echo $this->_tpl_vars['nextdir']; ?>
">Total</a></th>
</tr>

<?php $_from = $this->_tpl_vars['submissions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['submission']):
?>
<tr>

<td style="width: 200px;" nowrap>
<?php if ($this->_tpl_vars['submission']['accepted'] == 1): ?>
<b>
<?php endif; ?>

<?php echo smarty_function_counter(array('name' => 'ordinal'), $this);?>
. <a href="index.php?action=showsubmission&id=<?php echo $this->_tpl_vars['submission']['id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['submission']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 42) : smarty_modifier_truncate($_tmp, 42)); ?>
</a>
<?php if ($this->_tpl_vars['submission']['accepted'] == 1): ?>
</b>
<?php endif; ?>

</td>
<td nowrap class="silentlink"><span style="white-space:nowrap"><a href="index.php?action=showuser&id=<?php echo $this->_tpl_vars['submission']['user']['id']; ?>
"><?php echo $this->_tpl_vars['submission']['user']['lastname']; ?>
</a></span></td>

<?php $this->assign('reviewcount', $this->_tpl_vars['reviewcount']+$this->_tpl_vars['submission']['numreviews']);  $this->assign('commentcount', $this->_tpl_vars['commentcount']+$this->_tpl_vars['submission']['numcomments']);  $this->assign('papercount', $this->_tpl_vars['papercount']+1); ?>

<td><?php echo $this->_tpl_vars['submission']['numreviews']; ?>
</td>
<td><?php echo $this->_tpl_vars['submission']['numcomments']; ?>
</td>

<td><?php echo ((is_array($_tmp=$this->_tpl_vars['submission']['avgqual'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.1f") : smarty_modifier_string_format($_tmp, "%.1f")); ?>
</td>
<td><?php echo ((is_array($_tmp=$this->_tpl_vars['submission']['avgappr'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.1f") : smarty_modifier_string_format($_tmp, "%.1f")); ?>
</td>
<td><?php echo ((is_array($_tmp=$this->_tpl_vars['submission']['avgdisc'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.1f") : smarty_modifier_string_format($_tmp, "%.1f")); ?>
</td>
<td><b><?php echo ((is_array($_tmp=$this->_tpl_vars['submission']['avgtotal'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.0f") : smarty_modifier_string_format($_tmp, "%.0f")); ?>
</b></td>

<?php $this->assign('avgavgqual', $this->_tpl_vars['avgavgqual']+$this->_tpl_vars['submission']['avgqual']);  $this->assign('avgavgdisc', $this->_tpl_vars['avgavgdisc']+$this->_tpl_vars['submission']['avgdisc']);  $this->assign('avgavgappr', $this->_tpl_vars['avgavgappr']+$this->_tpl_vars['submission']['avgappr']);  $this->assign('avgavgtotal', $this->_tpl_vars['avgavgtotal']+$this->_tpl_vars['submission']['avgtotal']); ?>


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
<b>Total Reviews: <?php echo $this->_tpl_vars['reviewcount']; ?>
</b><br>
<b>Total Comments: <?php echo $this->_tpl_vars['commentcount']; ?>
</b><br>
<b>Total Papers: <?php echo $this->_tpl_vars['papercount']; ?>
</b><br>
<b>Average # Reviews: <?php echo ((is_array($_tmp=$this->_tpl_vars['reviewcount']/$this->_tpl_vars['papercount'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.1f") : smarty_modifier_string_format($_tmp, "%.1f")); ?>
</b><br>
<b>Average # Comments: <?php echo ((is_array($_tmp=$this->_tpl_vars['commentcount']/$this->_tpl_vars['papercount'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.1f") : smarty_modifier_string_format($_tmp, "%.1f")); ?>
</b><br>

<br>Average paper quality: <?php echo ((is_array($_tmp=$this->_tpl_vars['avgavgqual']/$this->_tpl_vars['papercount'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.1f") : smarty_modifier_string_format($_tmp, "%.1f")); ?>

<br>Average paper 'likelyhood to promote discussion': <?php echo ((is_array($_tmp=$this->_tpl_vars['avgavgdisc']/$this->_tpl_vars['papercount'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.1f") : smarty_modifier_string_format($_tmp, "%.1f")); ?>

<br>Average paper 'appropriateness for alt.chi': <?php echo ((is_array($_tmp=$this->_tpl_vars['avgavgappr']/$this->_tpl_vars['papercount'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.1f") : smarty_modifier_string_format($_tmp, "%.1f")); ?>

<br>Average total score: <?php echo ((is_array($_tmp=$this->_tpl_vars['avgavgtotal']/$this->_tpl_vars['papercount'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.1f") : smarty_modifier_string_format($_tmp, "%.1f")); ?>

<br><i>Above are all averages-of-averages</i>


</div>