<?php /* Smarty version 2.6.13, created on 2007-10-23 21:38:45
         compiled from update_review.tpl */ ?>

<h1>Update review for <a href="index.php?action=showsubmission&id=<?php echo $this->_tpl_vars['review']['submission']['id']; ?>
"><?php echo $this->_tpl_vars['review']['submission']['title']; ?>
</a></h1>

<div class="formtable">

<form method="post" action="index.php?action=updatereview&id=<?php echo $this->_tpl_vars['review']['id']; ?>
">

<table>
<tr>
<td class="listcaption">Expertise</td>

<td>
<select name="expertise">
<option value="1" <?php if ($this->_tpl_vars['review']['expertise'] == 1): ?>selected<?php endif; ?>>1 - No knowledge
<option value="2" <?php if ($this->_tpl_vars['review']['expertise'] == 2): ?>selected<?php endif; ?>>2 - Passing knowledge
<option value="3" <?php if ($this->_tpl_vars['review']['expertise'] == 3): ?>selected<?php endif; ?>>3 - Knowledgeable
<option value="4" <?php if ($this->_tpl_vars['review']['expertise'] == 4): ?>selected<?php endif; ?>>4 - Expert
</select>
</td>

</tr>

<tr>
<td class="listcaption">Rating</td>
<td>
<select name="rating">
<option value="1" <?php if ($this->_tpl_vars['review']['overallrating'] == 1): ?>selected<?php endif; ?>>1 - Definite reject
<option value="2" <?php if ($this->_tpl_vars['review']['overallrating'] == 2): ?>selected<?php endif; ?>>2 - Probably reject
<option value="3" <?php if ($this->_tpl_vars['review']['overallrating'] == 3): ?>selected<?php endif; ?>>3 - Borderline
<option value="4" <?php if ($this->_tpl_vars['review']['overallrating'] == 4): ?>selected<?php endif; ?>>4 - Probably accept
<option value="5" <?php if ($this->_tpl_vars['review']['overallrating'] == 5): ?>selected<?php endif; ?>>5 - Definite accept
</select>
</td>
</tr>

<tr>
<td class="listcaption">Relationship</td>
<td>
<textarea name="relationship" style="height: 3em;"><?php echo $this->_tpl_vars['review']['relationship']; ?>
</textarea>
</td>
</tr>

<tr>
<td class="listcaption">Summary</td>
<td>
<textarea name="summary" style="height: 6em;"><?php echo $this->_tpl_vars['review']['summary']; ?>
</textarea>
</td>
</tr>

<tr>
<td class="listcaption">Review</td>
<td>
<textarea name="review" style="height: 20em;"><?php echo $this->_tpl_vars['review']['review']; ?>
</textarea>
</td>
</tr>

<tr>
<td/>
<td><input type="submit" value="Save"></td>
</tr>

</table>

</form>

</div>