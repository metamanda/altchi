<?php /* Smarty version Smarty-3.1.3, created on 2011-10-15 12:07:19
         compiled from "smarty/templates/loginform.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21215810834e99cbd714da61-82825345%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4e8c2dd9ff4c53e3c300239eee9fd37c7af0090d' => 
    array (
      0 => 'smarty/templates/loginform.tpl',
      1 => 1318444596,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21215810834e99cbd714da61-82825345',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'loginform' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.3',
  'unifunc' => 'content_4e99cbd717877',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4e99cbd717877')) {function content_4e99cbd717877($_smarty_tpl) {?>
<div class="menucaption">Papers</div>
<div class="menu">
<a class="menuoption" href="index.php?action=accepted">Accepted papers</a>

<br />

<a class="menuoption" href="login.php?action=submissions&sortby=date&dir=1&simple">See all papers</a><br/>
</div>

<div class="menucaption">Login</div>
<div class="menu">
<form method="post" action="login.php?action=login">
<div class="login">
<label class="userpass">Username:</label> <input type="text" name="username" size=15 value="<?php echo $_smarty_tpl->tpl_vars['loginform']->value['username'];?>
" /><br/>
<br>
<label class="userpass">Password:</label> <input type="password" name="pass" size=15><br/><br/>
</div>
<input type="submit" value="Ok">
</form>

<p>
<a class="links" href="login.php?action=register">register</a>
<br/>
<a class="links" href="login.php?action=retrievepassword">retrieve password</a>
<br/>
</p>

</div>
<?php }} ?>