<?php /* Smarty version 2.6.13, created on 2013-01-14 06:37:26
         compiled from forum_categories.tpl */ ?>

<?php $_from = $this->_tpl_vars['error']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['msg']):
?>
<span class="errormessage"><?php echo $this->_tpl_vars['msg']; ?>
</span><br>
<?php endforeach; endif; unset($_from); ?>

<h1>Categories</h1>

<?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
<h2>
<a href="forum.php?action=showcategory&id=<?php echo $this->_tpl_vars['category']['id']; ?>
"><?php echo $this->_tpl_vars['category']['name']; ?>
</a>
<?php if ($this->_tpl_vars['logged_in']):  if ($this->_tpl_vars['category']['newposts'] > 0): ?>
-
<?php echo $this->_tpl_vars['category']['newposts']; ?>
 new posts since last logged in.
<?php endif;  else:  endif; ?>
</h2>
<div class="textbox">
<?php echo $this->_tpl_vars['category']['description']; ?>

</div>
<?php endforeach; else: ?>
No categories.
<?php endif; unset($_from); ?>

<?php if ($this->_tpl_vars['admin']): ?>
<hr>
<h2>Add Category</h2>
<form method="post" action="forum.php?action=addcategory">
Name: <input type="text" name="categoryname" value="<?php echo $this->_tpl_vars['form']['name']; ?>
" style="width:100%"><br>
Description:<br>
<textarea name="categorydescription"><?php echo $this->_tpl_vars['form']['categorydescription']; ?>
</textarea><br>
<input type="submit" value="submit">
</form>
<?php endif; ?>