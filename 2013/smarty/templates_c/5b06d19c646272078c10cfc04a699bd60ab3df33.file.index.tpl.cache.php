<?php /* Smarty version Smarty-3.1.3, created on 2011-10-15 12:11:21
         compiled from "smarty/templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2184007394e99ccc9d85d47-59986316%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5b06d19c646272078c10cfc04a699bd60ab3df33' => 
    array (
      0 => 'smarty/templates/index.tpl',
      1 => 1318444592,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2184007394e99ccc9d85d47-59986316',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'error' => 0,
    'msg' => 0,
    'hidemenu' => 0,
    'logged_in' => 0,
    'admin' => 0,
    'center' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.3',
  'unifunc' => 'content_4e99ccc9e814a',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4e99ccc9e814a')) {function content_4e99ccc9e814a($_smarty_tpl) {?>

<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css" />
<title>alt.chi 2008</title>
</head>
<body>

<div id="pagewidth">

<?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>


<div id="errors">
<?php  $_smarty_tpl->tpl_vars["msg"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["msg"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['error']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["msg"]->key => $_smarty_tpl->tpl_vars["msg"]->value){
$_smarty_tpl->tpl_vars["msg"]->_loop = true;
?>
<span class="errormessage"><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</span><br>
<?php } ?>
</div> 

<div id="main">

<?php if ($_smarty_tpl->tpl_vars['hidemenu']->value!="true"){?>

<div id="leftmenu">
<?php if ($_smarty_tpl->tpl_vars['logged_in']->value){?>
<?php echo $_smarty_tpl->getSubTemplate ("usermenu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>


<?php if ($_smarty_tpl->tpl_vars['admin']->value){?>
<?php echo $_smarty_tpl->getSubTemplate ("adminmenu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

<?php }?>

<?php echo $_smarty_tpl->getSubTemplate ("searchmenu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>


<?php }else{ ?>
<?php echo $_smarty_tpl->getSubTemplate ("loginform.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

<?php }?>
</div> 

<?php }?>

<div id="content">
<?php if (!$_smarty_tpl->tpl_vars['logged_in']->value){?>
<div>
</div>

<?php }?>

<?php if ($_smarty_tpl->tpl_vars['center']->value){?>
<?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['center']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

<?php }?>
</div> 

</div> 

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>


</div> 

</body>
</html>
<?php }} ?>