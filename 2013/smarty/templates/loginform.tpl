{* smarty *}

<div class="menucaption">Login</div>
<div class="menu">
<form method="post" action="login.php?action=login">
<div class="login">
<label class="userpass">Username:</label> <input type="text" name="username" size=15 value="{$loginform.username}" /><br/>
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
