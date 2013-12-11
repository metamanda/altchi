<?php

// $DOWNFORMAINTENANCE = true;
define('NUM_ITEMS_SHOW',50);

include('init.php');

//ini_set('display_errors',true);

require_once('phpmailer/class.phpmailer.php');

if(!$logged_in) { header("Location: index.php"); exit(); }

$smarty->assign('center','list_reviews.tpl'); 
?>
