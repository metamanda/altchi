<?php

include('init.php');
include('libs/Forum.php');
//ini_set('display_errors',true);

//$system->log("submission","submitprepare","visiting submission page");

if (!$logged_in)
{
  header('location: index.php');
  exit();
}

//
// CLOSED FOR SUBMISSIONS
//
$smarty->assign('center','submission_closed.tpl');

//
// OPEN FOR SUBMISSIONS
//
//$smarty->assign('center','submission.tpl');

//$smarty->display('index.tpl');
//exit();

//$forum = new Forum($system);

/*
$formerror = array();
	$agreement = $_POST['agreement'];
	$title = $_POST['title'];
	$authors = $_POST['authors'];
	$keywords = $_POST['keywords'];
	$abstract_ = $_POST['abstract'];
	$file = $_FILES['userfile'];
	$link = $_POST['link'];
	$filename = $_POST['filename'];
	$history = $_POST['history'];
	$hidden = $_POST['hidden'];
	$videolink = $_POST['videolink'];
	$comments = $_POST['comments'];
	//$party = $_POST['andrew w.k.'];

// append http:// to link if not there
if (isset($link)&&$link!="")
{
  if (substr($link,0,7)!="http://" && substr($link,0,8)!="https://") // XXX BE SURE TO TEST THIS
    $_POST['link'] = $link = "http://".$link;
}

if (isset($videolink)&&$videolink!="")
{
  if (substr($videolink,0,7)!="http://" && substr($videolink,0,8)!="https://") // XXX BE SURE TO TEST THIS
    $_POST['videolink'] = $videolink = "http://".$videolink;
}

$action = $_GET['action'];

$system->log("submission","submitprepare","an action has been requested");

// check form
if (isset($title) && $title!="")
{

  if (!isset($keywords)||$keywords=="")
    $formerror[] = "No keywords.";

  if (!isset($abstract_)||$abstract_=="")
    $formerror[] = "No abstract.";

  $isfile = (isset($file['name'])&&$file['name']!="");
  $islink = isset($link)&&$link!=""&&$link!="http://";

  if ((($isfile&&$islink)||(!$isfile&&!$islink))&&!isset($filename))
    $formerror[] = "Please either upload file or specify link";

  if (isset($file))
  {
    if ($file['size']>2000000)
      $formerror[] = "File bigger than 2M. Please resize your file or otherwise upload elsewhere and specify link instead.";
  }
} else if (isset($title))
  $formerror[] = "No title.";

// set default view

$smarty->assign('center','submission.tpl');

$system->log("submission","submitprepare errors",count($formerror).$formerror);

if (count($formerror)==0)
{
  switch($action)
  {
  case "review":
	$_POST['title'] = stripslashes($_POST['title']);
	$_POST['history'] = stripslashes($_POST['history']);
	$_POST['abstract'] = stripslashes($_POST['abstract']);

    //$system->log("submission","submitprepare","about to prepare submission");
	
    $filename = $system->submitSubmissionPrepare($title,$authors,$keywords,$abstract_,$file,$link);
	//echo("here's my filename! ".$filename);
    $smarty->assign('filename',$filename);
//    $smarty->assign('form',$_POST); // set by default.
    $smarty->assign('center','submission_confirm.tpl');
    break;
    
  case "confirm":
    if ($_POST['button']=="Confirm")
    {
      if ($submissionid = $system->submitSubmission($title,$authors,$keywords,htmlspecialchars($abstract_,ENT_QUOTES),$filename,$link,htmlspecialchars($history, ENT_QUOTES),$videolink,$comments,isset($hidden)?$hidden:false))
      {

	//now make a discussion thread for it, unless it's a 'hidden paper'*/
        /*if (!$hidden)		// NOTE *11* is the category for submission discussions
	       {
			   $threadid = $forum->addThread($submissionid, $userid,11,$system->userinfo['lastname']." - ".$title,"index.php?action=showsubmission&id=".$submissionid);
		    }*/
	//and let's go and look at it
       /* header("Location: index.php?action=showsubmission&id=".$submissionid);
      }
      else
        $formerror[] = "Error when submitting. Please try again or contact administrator.";


    }//if post[button] = confirm
    break;
  default:
    break;
  }
}

$smarty->assign('formerror',$formerror);
$smarty->assign('form',$_POST);
//$smarty->assign('center','submission.tpl');*/
$smarty->display('index.tpl');

?>
