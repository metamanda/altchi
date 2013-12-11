<?php /* Smarty version 2.6.13, created on 2013-01-14 06:40:25
         compiled from forum_editpost.tpl */ ?>

<h1>Edit post</h1>

<?php if ($this->_tpl_vars['isreview']): ?>
<p class='warning'>Please note! You cannot change your review scores after submitting.  To change them, you must submit a new review.</p>
<?php endif; ?>

<h3>Post</h3>

<form method="post" action="index.php?action=editpost&id=<?php echo $this->_tpl_vars['post']['id']; ?>
&index=<?php echo $this->_tpl_vars['index']; ?>
">
<textarea rows=5 cols=60 name="post"><?php echo $this->_tpl_vars['post']['post']; ?>
</textarea>
<br>
<input type="submit" name="button" value="Save">
<input type="button" value="Cancel" onClick="document.location = 'index.php?action=showsubmission&id=<?php echo $this->_tpl_vars['post']['threadid']; ?>
&index=<?php echo $this->_tpl_vars['index']; ?>
';">
</form>