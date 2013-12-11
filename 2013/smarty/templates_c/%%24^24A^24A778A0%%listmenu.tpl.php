<?php /* Smarty version 2.6.13, created on 2007-10-23 19:44:54
         compiled from listmenu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'counter', 'listmenu.tpl', 7, false),array('modifier', 'truncate', 'listmenu.tpl', 12, false),)), $this); ?>

<div class="menucaption"><?php echo $this->_tpl_vars['title']; ?>
</div>
<div class="menu">

<?php echo smarty_function_counter(array('start' => 0,'print' => false), $this);?>


<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
 if ($this->_tpl_vars['listnumbers']):  echo smarty_function_counter(array(), $this);?>
. <?php endif; ?>

<?php if ($this->_tpl_vars['item']['link']): ?><a class="menuoption" href="<?php echo $this->_tpl_vars['item']['link']; ?>
"><?php endif;  echo ((is_array($_tmp=$this->_tpl_vars['item']['text'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 18, "...", true) : smarty_modifier_truncate($_tmp, 18, "...", true));  if ($this->_tpl_vars['item']['link']): ?></a><?php endif; ?><br>

<?php endforeach; else: ?>
No items.
<?php endif; unset($_from); ?>

</div>