<?php
//ini_set('display_errors',true);
// do not allow direct access to init.php
if (strpos($_SERVER["SCRIPT_NAME"],"init.php"))
{
  header("location: index.php");
  exit();
}
require('libs/smarty/Smarty.class.php');
include('libs/System.php');

//
// setup smarty paths
//
$smarty =& new Smarty();
//$smarty is a pointer to an instance of the Smarty() class.
$smarty->template_dir = 'smarty/templates';
$smarty->compile_dir = 'smarty/templates_c';
$smarty->cache_dir = 'smarty/cache';

$smarty->debugging = true;
$smarty->caching = true;
$smarty->cache_lifetime = 120;

//and system is a pointer to an instance of Opensession(), which has a few variables and LOTS of functions in libs/System.php.
$system =& new OpenSession();

// we use this to keep track of the errors in a submission, for example.
$error = array();

// check if logged in
$logged_in = false;

session_start();
session_register($dbprefix);
//print "we're in init.php";

if (isset($_SESSION[$dbprefix]['user']))
{
  $user = $_SESSION[$dbprefix]['user'];
  $logged_in = $system->loadUserinfo($user);
}

if ($logged_in)
{
  $smarty->assign('username',$system->user);
  $smarty->assign('userid',$system->userid);

  $system->userinfo = $system->getUserinfo($system->userid);
}

$smarty->assign('admin',$system->admin);

$system->logged_in = $logged_in;
$smarty->assign('logged_in',$logged_in);
$smarty->assign('admin',$system->admin);

// setup plugin data
//
if ($logged_in)
{
  // set top rated submissions list
  $topratedsubmissions = $system->getTopratedSubmissions(10);
  $topratedsubmissionslist = array();
  foreach($topratedsubmissions as $submission)
  {
    $topratedsubmissionslist[] = array('text' => $submission['title'],
                                       'link' => "index.php?action=showsubmission&id=".$submission['id']);
  }
  $smarty->assign('topratedsubmissions',$topratedsubmissionslist);

  // set top reviewers list
  $topreviewers = $system->getTopReviewers(10);
  $topreviewerslist = array();
  //foreach($topreviewers as $reviewer)
  //{
  //  $topreviewerslist[] = array('text' => $reviewer['firstname']." ".$reviewer['lastname'],
  //                              'link' => "index.php?action=showuser&id=".$reviewer['id']);
  //}
  //$smarty->assign('topreviewers',$topreviewerslist);
}

?>
