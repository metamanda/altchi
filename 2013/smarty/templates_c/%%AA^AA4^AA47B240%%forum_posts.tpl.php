<?php /* Smarty version 2.6.13, created on 2007-10-27 17:11:10
         compiled from forum_posts.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'forum_posts.tpl', 21, false),)), $this); ?>

<script src="forum.js"></script>

<div class="forumnav"><a href="forum.php">Forum</a> &gt; <a href="forum.php?action=showcategory&id=<?php echo $this->_tpl_vars['category']['id']; ?>
"><?php echo $this->_tpl_vars['category']['name']; ?>
</a> &gt;
<?php if ($this->_tpl_vars['thread']['link']): ?><a href="<?php echo $this->_tpl_vars['thread']['link']; ?>
"><?php endif;  echo $this->_tpl_vars['thread']['subject'];  if ($this->_tpl_vars['thread']['link']): ?></a><?php endif; ?></div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "screen_browser.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="forumposts">
<table width="100%">

<?php $_from = $this->_tpl_vars['posts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['post']):
?>

<tr class="postheader">
 <td>
  <table>
   <tr>
    <td id="post_header_<?php echo $this->_tpl_vars['post']['id']; ?>
" align="left">
     <a href="index.php?action=showuser&id=<?php echo $this->_tpl_vars['post']['user']['id']; ?>
"><?php echo $this->_tpl_vars['post']['user']['firstname']; ?>
 <?php echo $this->_tpl_vars['post']['user']['lastname']; ?>
</a> wrote on <?php echo ((is_array($_tmp=$this->_tpl_vars['post']['posted'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M")); ?>

    </td>
    <td align="right">
     <?php if ($this->_tpl_vars['post']['edited']): ?>
     <span style="white-space:nowrap;">edited <?php echo ((is_array($_tmp=$this->_tpl_vars['post']['edited'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M")); ?>
</span>
     <?php endif; ?>
    </td>
    <td style="text-align: right;">
     <a href="javascript:quote('<?php echo $this->_tpl_vars['post']['id']; ?>
');">quote</a>
     <?php if ($this->_tpl_vars['post']['editable'] || $this->_tpl_vars['admin']): ?>
     <a href="forum.php?action=editpost&id=<?php echo $this->_tpl_vars['post']['id']; ?>
&index=<?php echo $this->_tpl_vars['index']; ?>
"><span title="edit">edit</span></a>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['admin'] || $this->_tpl_vars['userid'] == $this->_tpl_vars['post']['userid']): ?>
     <a href="forum.php?action=deletepost&id=<?php echo $this->_tpl_vars['post']['id']; ?>
&index=<?php echo $this->_tpl_vars['index']; ?>
"><span title="delete post">x</span></a>
     <?php endif; ?>
    </td>
   </tr>
  </table>
 </td>
</tr>

<tr class="postbody">
 <td id="post_<?php echo $this->_tpl_vars['post']['id']; ?>
" colspan="100">
  <?php echo $this->_tpl_vars['post']['post']; ?>

 </td>
</tr>

<?php endforeach; else: ?>

<tr><td colspan="100">
No posts.
</tr></td>

<?php endif; unset($_from); ?>

</table>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "screen_browser.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['logged_in']):  if (! $this->_tpl_vars['thread']['locked']): ?>
<p>

<form method="post" action="forum.php?action=showthread&id=<?php echo $this->_tpl_vars['thread']['id']; ?>
">
New post:<br>
<textarea id="input_post" name="post"></textarea><br>
<input type="submit" value="Submit">
</form>

</p>
<?php endif;  endif; ?>