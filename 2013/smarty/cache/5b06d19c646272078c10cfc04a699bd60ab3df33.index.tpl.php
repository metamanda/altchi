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
    '3ce3b413f6943a3cb78bad3ca6d7606ada58b50d' => 
    array (
      0 => 'smarty/templates/header.tpl',
      1 => 1318444591,
      2 => 'file',
    ),
    '4e8c2dd9ff4c53e3c300239eee9fd37c7af0090d' => 
    array (
      0 => 'smarty/templates/loginform.tpl',
      1 => 1318444596,
      2 => 'file',
    ),
    '3168be0a665e5d5abe76cc6b33099293776ae0f7' => 
    array (
      0 => 'smarty/templates/introduction.tpl',
      1 => 1318444594,
      2 => 'file',
    ),
    '7078552075d617a5cbee87f74ec2b36b1d711d33' => 
    array (
      0 => 'smarty/templates/footer.tpl',
      1 => 1318444586,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2184007394e99ccc9d85d47-59986316',
  'version' => 'Smarty-3.1.3',
  'unifunc' => 'content_4e99cfde16f09',
  'has_nocache_code' => false,
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4e99cfde16f09')) {function content_4e99cfde16f09($_smarty_tpl) {?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css" />
<title>alt.chi 2008</title>
</head>
<body>

<div id="pagewidth">


<div id="headerone">
<div id="headerlinks">
<a href="http://chi2008.org/alt.chi.html">Call for Participation</a> | <a href="http://chi2008.org">chi2008.org</a>
</div>
</div>


<div id="errors">
</div> 

<div id="main">


<div id="leftmenu">
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
<label class="userpass">Username:</label> <input type="text" name="username" size=15 value="" /><br/>
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

</div> 


<div id="content">
<div>
</div>


<p>
Alt.chi invites controversial ideas, novel prototypes, failed but valuable user studies, bold experiments, and anything else that can give a fresh perspective on CHI.  We invite work that would otherwise not have been presented at CHI 2008, because it is too controversial or outside of the norm.
</p>
<p>
All papers are submitted, reviewed, and discussed in a non-anonymous forum to allow for discussion, constructive criticism and rich interaction between authors, reviewers and commentators.
</p>
<p>To read submissions and discussions, <a href="http://www.chi2008.org/altchisystem/dev/login.php?action=submissions&sortby=date&dir=1&simple">click here.</a>
<p>
To review or discuss papers, please login on your left or <a href="http://www.chi2008.org/altchisystem/login.php?action=register">register</a> first.
</p>

<p>
We look forward to your contributions!
</p>
</div> 

</div> 


<div id="footerone">
</div>


</div> 

</body>
</html>
<?php }} ?>