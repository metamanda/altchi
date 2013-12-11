<?php /* Smarty version 2.6.13, created on 2013-12-10 04:03:37
         compiled from loginform.tpl */ ?>

<div class="menucaption">Login</div>
<div class="menu">
<form method="post" action="login.php?action=login">
<div class="login">
<label class="userpass">Username:</label> <input type="text" name="username" size=15 value="<?php echo $this->_tpl_vars['loginform']['username']; ?>
" /><br/>
<br>
<label class="userpass">Password:</label> <input type="password" name="pass" size=15><br/><br/>
</div>
<input type="submit" value="Log In">
</form>

<p>
<a class="links" href="login.php?action=register">register</a>
<br/>
<a class="links" href="login.php?action=retrievepassword">retrieve password</a>
<br/>
</p>

</div>