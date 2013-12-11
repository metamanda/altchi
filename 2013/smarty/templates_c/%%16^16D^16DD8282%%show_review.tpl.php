<?php /* Smarty version 2.6.13, created on 2007-10-23 21:46:37
         compiled from show_review.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'show_review.tpl', 33, false),array('modifier', 'escape', 'show_review.tpl', 79, false),array('modifier', 'nl2br', 'show_review.tpl', 79, false),)), $this); ?>

<h1>Review for <a href="index.php?action=showsubmission&id=<?php echo $this->_tpl_vars['review']['submission']['id']; ?>
"><?php echo $this->_tpl_vars['review']['submission']['title']; ?>
</a></h1>

<?php echo $this->_tpl_vars['review']['stars']; ?>

<?php if ($this->_tpl_vars['review']['stars'] > 0): ?>
<img src="gfx/star.gif">
<?php else: ?>
<img src="gfx/nostar.gif">
<?php endif; ?>

<?php if ($this->_tpl_vars['logged_in']):  if ($this->_tpl_vars['review']['userid'] != $this->_tpl_vars['userid']):  if ($this->_tpl_vars['isstared']): ?>
<a href="index.php?action=removestar&id=<?php echo $this->_tpl_vars['review']['id']; ?>
">remove star</a>
<?php else: ?>
<a href="index.php?action=assignstar&id=<?php echo $this->_tpl_vars['review']['id']; ?>
">assign star for extra merit to this review</a>
<?php endif;  endif;  endif; ?>

<div class="list">

<table>

<tr>
<td class="listcaption" nowrap>Reviewed by</td>
<td><a href="index.php?action=showuser&id=<?php echo $this->_tpl_vars['review']['user']['id']; ?>
"><?php echo $this->_tpl_vars['review']['user']['firstname']; ?>
 <?php echo $this->_tpl_vars['review']['user']['lastname']; ?>
</a></td>
</tr>

<tr>
<td class="listcaption">Submitted</td>
<td><?php echo ((is_array($_tmp=$this->_tpl_vars['review']['submitted'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M")); ?>
</td>
</tr>

<?php if ($this->_tpl_vars['review']['edited']): ?>
<tr>
<td class="listcaption">Last edited</td>
<td><?php echo ((is_array($_tmp=$this->_tpl_vars['review']['edited'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M")); ?>
</td>
</tr>
<?php endif; ?>

<tr>
<td class="listcaption">Expertise</td>
<td>
<?php if ($this->_tpl_vars['review']['expertise'] == 1): ?>
1 - No knowledge
<?php elseif ($this->_tpl_vars['review']['expertise'] == 2): ?>
2 - Passing Knowledge
<?php elseif ($this->_tpl_vars['review']['expertise'] == 3): ?>
3 - Knowledgeable
<?php elseif ($this->_tpl_vars['review']['expertise'] == 4): ?>
4 - Expert
<?php endif; ?>
</td>

</tr>
<tr>
<td class="listcaption">Rating</td>
<td>
<?php if ($this->_tpl_vars['review']['overallrating'] == 1): ?>
1 - Definite reject
<?php elseif ($this->_tpl_vars['review']['overallrating'] == 2): ?>
2 - Probably reject
<?php elseif ($this->_tpl_vars['review']['overallrating'] == 3): ?>
3 - Borderline
<?php elseif ($this->_tpl_vars['review']['overallrating'] == 4): ?>
4 - Probably accept
<?php elseif ($this->_tpl_vars['review']['overallrating'] == 5): ?>
5 - Definite accept
<?php endif; ?>
</td>
</tr>

<?php if ($this->_tpl_vars['review']['relationship']): ?>
<tr>
<td class="listcaption">Relationship</td>
<td>
<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['review']['relationship'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>

</td>
</tr>
<?php endif; ?>

</table>

</div>

<?php if ($this->_tpl_vars['editable']): ?>
<p>
<a href="index.php?action=deletereview&id=<?php echo $this->_tpl_vars['review']['id']; ?>
">delete review</a><br/>
<a href="index.php?action=updatereview&id=<?php echo $this->_tpl_vars['review']['id']; ?>
">edit review</a><br/>
<?php endif; ?>

<p>

<h2>Summary</h2>
<div class="textbox">
<?php echo ((is_array($_tmp=$this->_tpl_vars['review']['summary'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>

</div>

<p>
<h2>Review</h2>
<div class="textbox">
<?php echo ((is_array($_tmp=$this->_tpl_vars['review']['review'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>

</div>

<?php if ($this->_tpl_vars['reviews']): ?>
<h3>Other reviews</h3>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "list_reviews.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>