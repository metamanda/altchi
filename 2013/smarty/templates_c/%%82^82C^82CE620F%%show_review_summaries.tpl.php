<?php /* Smarty version 2.6.13, created on 2013-03-12 10:05:22
         compiled from show_review_summaries.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'counter', 'show_review_summaries.tpl', 38, false),array('modifier', 'string_format', 'show_review_summaries.tpl', 52, false),array('modifier', 'truncate', 'show_review_summaries.tpl', 71, false),)), $this); ?>

<?php if ($this->_tpl_vars['dir'] == 1):  $this->assign('nextdir', 0);  else:  $this->assign('nextdir', 1);  endif;  $this->assign('reviewcount', 0);  $this->assign('commentcount', 0);  $this->assign('papercount', 0);  $this->assign('avgavgqual', 0);  $this->assign('avgavgdisc', 0);  $this->assign('avgavgappr', 0);  $this->assign('avgavgtotal', 0); ?>

<h1>Review Summary Page</h1>

<i>Sorted by sum of average review scores</i>

<div class="list">
<table width="90%">

<?php $_from = $this->_tpl_vars['submissions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['submission']):
?>
<tr>
<td style="width=100%" nowrap><br><br>
<?php echo smarty_function_counter(array('name' => 'ordinal'), $this);?>
. <b><a href="index.php?action=showsubmission&id=<?php echo $this->_tpl_vars['submission']['id']; ?>
"><?php echo $this->_tpl_vars['submission']['title']; ?>
</a></b>
</td>
</tr>

<tr>
<td nowrap class="silentlink"><span style="white-space:nowrap"><a href="index.php?action=showuser&id=<?php echo $this->_tpl_vars['submission']['user']['id']; ?>
"><?php echo $this->_tpl_vars['submission']['user']['lastname']; ?>
</a></span></td>

<?php $this->assign('reviewcount', $this->_tpl_vars['reviewcount']+$this->_tpl_vars['submission']['numreviews']);  $this->assign('commentcount', $this->_tpl_vars['commentcount']+$this->_tpl_vars['submission']['numcomments']);  $this->assign('papercount', $this->_tpl_vars['papercount']+1); ?>

<td>R:<?php echo $this->_tpl_vars['submission']['numreviews']; ?>
</td>
<td>C:<?php echo $this->_tpl_vars['submission']['numcomments']; ?>
</td>

<td><?php echo ((is_array($_tmp=$this->_tpl_vars['submission']['avgqual'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.1f") : smarty_modifier_string_format($_tmp, "%.1f")); ?>
,</td>
<td><?php echo ((is_array($_tmp=$this->_tpl_vars['submission']['avgappr'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.1f") : smarty_modifier_string_format($_tmp, "%.1f")); ?>
,</td>
<td><?php echo ((is_array($_tmp=$this->_tpl_vars['submission']['avgdisc'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.1f") : smarty_modifier_string_format($_tmp, "%.1f")); ?>
,</td>
<td><b><?php echo ((is_array($_tmp=$this->_tpl_vars['submission']['avgtotal'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.0f") : smarty_modifier_string_format($_tmp, "%.0f")); ?>
</b></td>
</tr>

<?php $this->assign('avgavgqual', $this->_tpl_vars['avgavgqual']+$this->_tpl_vars['submission']['avgqual']);  $this->assign('avgavgdisc', $this->_tpl_vars['avgavgdisc']+$this->_tpl_vars['submission']['avgdisc']);  $this->assign('avgavgappr', $this->_tpl_vars['avgavgappr']+$this->_tpl_vars['submission']['avgappr']);  $this->assign('avgavgtotal', $this->_tpl_vars['avgavgtotal']+$this->_tpl_vars['submission']['avgtotal']); ?>
</table>
<table width=100%>
<?php $_from = $this->_tpl_vars['posts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['post']):
?>
  <?php if (( ( $this->_tpl_vars['submission']['id'] == $this->_tpl_vars['post']['submissionid'] ) && ( $this->_tpl_vars['post']['quality'] > 0 ) && ( $this->_tpl_vars['post']['isCurrentReview'] == 'true' ) )): ?> 
  <tr class="postheader">
  <td>
  <a href="index.php?action=showuser&id=<?php echo $this->_tpl_vars['post']['user']['id']; ?>
"><?php echo $this->_tpl_vars['post']['user']['firstname']; ?>
 <?php echo $this->_tpl_vars['post']['user']['lastname']; ?>
</a>, <?php echo $this->_tpl_vars['post']['user']['affiliation']; ?>

   <tr>
   	<td>Quality: <?php echo $this->_tpl_vars['post']['quality']; ?>
</td>
   	<td nowrap><?php echo ((is_array($_tmp=$this->_tpl_vars['post']['qualitytext'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 50) : smarty_modifier_truncate($_tmp, 50)); ?>
</td>
   </tr>
   <tr>
      	<td>Appropriate: <?php echo $this->_tpl_vars['post']['appropriate']; ?>
</td>
      	<td nowrap><?php echo ((is_array($_tmp=$this->_tpl_vars['post']['appropriatetext'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 50) : smarty_modifier_truncate($_tmp, 50)); ?>
</td>
   </tr>
   <tr>
      	<td>Discussion potential: <?php echo $this->_tpl_vars['post']['controversial']; ?>
</td>
      	<td  nowrap><?php echo ((is_array($_tmp=$this->_tpl_vars['post']['controversialtext'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 50) : smarty_modifier_truncate($_tmp, 50)); ?>
</td>
   </tr>
   </tr>
   </td>
   <?php endif;  endforeach; endif; unset($_from); ?>
</table>
<?php endforeach; endif; unset($_from); ?>
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