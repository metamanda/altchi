<?php /* Smarty version 2.6.13, created on 2013-12-10 01:57:51
         compiled from unverified.tpl */ ?>

<h1>Unverified</h1>

<p>

You need to verify yourself by following the link in your mail box.
If you did not receive an email, please enter your password again to
receive a new email:
<form method="post" action="index.php?action=sendverification&id=<?php echo $this->_tpl_vars['user']['id']; ?>
">
Password: <input type="password" name="pass">
<input type="submit" value="Ok">
</form>

</p>