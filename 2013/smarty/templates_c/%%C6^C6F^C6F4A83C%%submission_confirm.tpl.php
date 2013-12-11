<?php /* Smarty version 2.6.13, created on 2013-01-09 22:22:21
         compiled from submission_confirm.tpl */ ?>

<h1>Confirm submission</h1>

<div class="formtable">

<form method="post" action="submission.php?action=confirm" enctype="multipart/form-data">

<input type="hidden" name="agreement" value="true">

<table>

<tr>
<input type="hidden" name="title" value="<?php echo $this->_tpl_vars['form']['title']; ?>
"><br>
<td class="formtablelabel">Title</td>
<td>
<?php echo $this->_tpl_vars['form']['title']; ?>

</td>
</tr>

<?php if ($this->_tpl_vars['form']['authors']): ?>
<tr>
<input type="hidden" name="authors" value="<?php echo $this->_tpl_vars['form']['authors']; ?>
">
<td class="formtablelabel" nowrap><span style="white-space: nowrap">Authors</span></td>
<td>
<?php echo $this->_tpl_vars['form']['authors']; ?>

</td>
</tr>
<?php endif; ?>

<tr>
<input type="hidden" name="keywords" value="<?php echo $this->_tpl_vars['form']['keywords']; ?>
">
<td class="formtablelabel">Keywords</td>
<td>
<?php echo $this->_tpl_vars['form']['keywords']; ?>

</td>
</tr>

<tr>
<td class="formtablelabel">Submission History</td>
<td>
<textarea id="input_history" name="history" READONLY><?php echo $this->_tpl_vars['form']['history']; ?>
</textarea><br>
</td>
</tr>

<tr>
<td class="formtablelabel">Abstract:</td>
<td>
<textarea id="input_abstract" name="abstract" READONLY><?php echo $this->_tpl_vars['form']['abstract']; ?>
</textarea><br>
</td>
</tr>

<tr>
<?php if ($this->_tpl_vars['form']['link']): ?>
<input type="hidden" name="link" value="<?php echo $this->_tpl_vars['form']['link']; ?>
">
<td class="formtablelabel">Link</td>
<td>
<?php echo $this->_tpl_vars['form']['link']; ?>

</td>
<?php else: ?>
<input type="hidden" name="filename" value="<?php echo $this->_tpl_vars['filename']; ?>
">
<td class="formtablelabel">Uploaded file</td>
<td>
<?php echo $this->_tpl_vars['filename']; ?>

</td>
<?php endif; ?>
</tr>

<?php if ($this->_tpl_vars['form']['videolink']): ?>
<tr>
<input type="hidden" name="videolink" value="<?php echo $this->_tpl_vars['form']['videolink']; ?>
">
<td class="formtablelabel">Link to Video</td>
<td>
<?php echo $this->_tpl_vars['form']['videolink']; ?>

</td>
</tr>
<?php endif; ?>

<?php if ($this->_tpl_vars['form']['comments']): ?>
<tr>
<input type="hidden" name="comments" value="<?php echo $this->_tpl_vars['form']['comments']; ?>
" />
<td class="formtablelabel">Author Comments:</td>
<td>
<textarea id="input_comments" name="comments" READONLY><?php echo $this->_tpl_vars['form']['comments']; ?>
</textarea>
</td>
</tr>
<?php endif; ?>

<?php if ($this->_tpl_vars['form']['extras_name']):  unset($this->_sections['extras']);
$this->_sections['extras']['name'] = 'extras';
$this->_sections['extras']['loop'] = is_array($_loop=$this->_tpl_vars['form']['extras_name']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['extras']['show'] = true;
$this->_sections['extras']['max'] = $this->_sections['extras']['loop'];
$this->_sections['extras']['step'] = 1;
$this->_sections['extras']['start'] = $this->_sections['extras']['step'] > 0 ? 0 : $this->_sections['extras']['loop']-1;
if ($this->_sections['extras']['show']) {
    $this->_sections['extras']['total'] = $this->_sections['extras']['loop'];
    if ($this->_sections['extras']['total'] == 0)
        $this->_sections['extras']['show'] = false;
} else
    $this->_sections['extras']['total'] = 0;
if ($this->_sections['extras']['show']):

            for ($this->_sections['extras']['index'] = $this->_sections['extras']['start'], $this->_sections['extras']['iteration'] = 1;
                 $this->_sections['extras']['iteration'] <= $this->_sections['extras']['total'];
                 $this->_sections['extras']['index'] += $this->_sections['extras']['step'], $this->_sections['extras']['iteration']++):
$this->_sections['extras']['rownum'] = $this->_sections['extras']['iteration'];
$this->_sections['extras']['index_prev'] = $this->_sections['extras']['index'] - $this->_sections['extras']['step'];
$this->_sections['extras']['index_next'] = $this->_sections['extras']['index'] + $this->_sections['extras']['step'];
$this->_sections['extras']['first']      = ($this->_sections['extras']['iteration'] == 1);
$this->_sections['extras']['last']       = ($this->_sections['extras']['iteration'] == $this->_sections['extras']['total']);
?>
<tr>
<input type="hidden" name="extras_name[]" value="<?php echo $this->_tpl_vars['form']['extras_name'][$this->_sections['extras']['index']]; ?>
">
<td class="formtablelabel"><?php echo $this->_tpl_vars['form']['extras_name'][$this->_sections['extras']['index']]; ?>
</td>
<input type="hidden" name="extras_content[]" value="<?php echo $this->_tpl_vars['form']['extras_content'][$this->_sections['extras']['index']]; ?>
">
<td><?php echo $this->_tpl_vars['form']['extras_content'][$this->_sections['extras']['index']]; ?>
</td>
</tr>
<?php endfor; endif;  endif; ?>

<?php if ($this->_tpl_vars['admin']): ?>
<tr>
<td class="formtablelabel">ADMIN hidden</td>
<td>
<input type="checkbox" name="hidden"<?php if ($this->_tpl_vars['form']['hidden']): ?> CHECKED<?php endif; ?>>
</td>
</tr>
<?php endif; ?>

<tr>
<td/>
<td>
<input type="submit" name="button" value="Confirm">
<input type="submit" name="button" value="Back">
</td>
</tr>

</table>

</form>
</div>