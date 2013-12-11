<?php /* Smarty version 2.6.13, created on 2013-04-03 22:20:53
         compiled from update_submission.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'update_submission.tpl', 55, false),array('modifier', 'nl2br', 'update_submission.tpl', 55, false),)), $this); ?>

<script src="submission.js"></script>

<h1>Editing submission</h1>

<div class="formtable">

<form method="POST" action="index.php?action=updatesubmission&id=<?php echo $this->_tpl_vars['submission']['id']; ?>
">
<table id="submission_formtable">

<tr>
<td class="formtablelabel">Title</td>
<td><input type="text" name="title" value="<?php echo $this->_tpl_vars['submission']['title']; ?>
"></td>
</tr>

<tr>
<td class="formtablelabel" nowrap><span style="white-space:nowrap;">Additional authors</span></td>
<td><input type="text" name="authors" value="<?php echo $this->_tpl_vars['submission']['additionalauthors']; ?>
"></td>
</tr>

<tr>
<td class="formtablelabel">Keywords</td>
<td><input type="text" name="keywords" value="<?php echo $this->_tpl_vars['submission']['keywords']; ?>
"></td>
</tr>

<?php if ($this->_tpl_vars['submission']['link']): ?>
<tr>
<td class="formtablelabel">Link</td>
<td><input type="text" name="link" value="<?php echo $this->_tpl_vars['submission']['link']; ?>
"></td>
</tr>
<?php endif; ?>

<?php if ($this->_tpl_vars['submission']['extras']):  $_from = $this->_tpl_vars['submission']['extras']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['extra']):
?>
<tr>
<td class="formtablelabel"><input type="text" name="extras_name[]" value="<?php echo $this->_tpl_vars['extra']['name']; ?>
"></td>
<td><input type="text" name="extras_content[]" value="<?php echo $this->_tpl_vars['extra']['content']; ?>
"></td>
</tr>
<?php endforeach; endif; unset($_from); ?>

<?php endif; ?>

<tr>
<td class="formtablelabel">Submission history</td>
<td>
<textarea name="history"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['submission']['history'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</textarea>
</td>
</tr>

<tr>
<td class="formtablelabel">Abstract</td>
<td>
<textarea name="abstract"><?php echo $this->_tpl_vars['submission']['abstract']; ?>
</textarea>
</td>
</tr>

<tr>
<input type="hidden" name="videolink" value="<?php echo $this->_tpl_vars['submission']['videolink']; ?>
">
<td class="formtablelabel">Link to Video</td>
<td><input type="text" name="videolink" value="<?php echo $this->_tpl_vars['submission']['videolink']; ?>
" /></td>
</td>
</tr>

<tr>
<input type="hidden" name="comments" value="<?php echo $this->_tpl_vars['submission']['comments']; ?>
" />
<td class="formtablelabel">Author Comments:</td>
<td>
<textarea id="input_comments" name="comments"><?php echo $this->_tpl_vars['submission']['comments']; ?>
</textarea><br />
</td>
</tr>

<!--tr>
<td></td>
<td><input type="button" value="Add field" onclick="javascript:addField()"></td>
</tr-->

<tr>
<td></td>
<td><input type="submit" value="Save"></td>
</tr>

<?php if ($this->_tpl_vars['submission']['message']): ?>
<tr>
<td></td>
<td><?php echo $this->_tpl_vars['submission']['message']; ?>

</td>
</tr>
<?php endif; ?>

</table>
</form>

</div>