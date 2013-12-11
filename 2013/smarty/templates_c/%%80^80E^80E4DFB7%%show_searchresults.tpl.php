<?php /* Smarty version 2.6.13, created on 2013-07-19 02:50:06
         compiled from show_searchresults.tpl */ ?>

<h1>Search for <?php echo $this->_tpl_vars['searchtext']; ?>
</h1>

<div class="list">

<table>
<?php $_from = $this->_tpl_vars['searchresults']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['hit']):
?>
<tr>
<td><a href="<?php echo $this->_tpl_vars['hit']['link']; ?>
"><?php echo $this->_tpl_vars['hit']['text']; ?>
</a></td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>

</div>