<?php /* Smarty version 2.6.13, created on 2012-01-13 02:36:00
         compiled from author_dump.tpl */ ?>
<?php $_from = $this->_tpl_vars['authorSubmissions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['submission']):
?>
"<?php echo $this->_tpl_vars['submission']['title']; ?>
","<?php echo $this->_tpl_vars['submission']['user']['firstname']; ?>
 <?php echo $this->_tpl_vars['submission']['user']['lastname']; ?>
",<?php echo $this->_tpl_vars['submission']['additionalauthors']; ?>
<br/>
<?php $_from = $this->_tpl_vars['submission']['additionalauthors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['addauthor']):
?>
additional author: <?php echo $this->_tpl_vars['addauthor']; ?>
 <br/>
<?php endforeach; endif; unset($_from);  endforeach; endif; unset($_from); ?>