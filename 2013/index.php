<?php

// $DOWNFORMAINTENANCE = true;
ini_set('display_errors',true);
//ini_set('display_errors', false);

include('init.php');

if (isset($DOWNFORMAINTENANCE)) {
  if (!$system->admin&&$system->user!="test") {
    $smarty->display('downformaintenance.tpl');
    exit();
  }
}
require_once('phpmailer/class.phpmailer.php');
$action = isset($_GET['action'])?$_GET['action']:null;
$sortby = isset($_GET['sortby'])?$_GET['sortby']:"numreviews";
$dir = isset($_GET['dir'])?$_GET['dir']:1;

//stuff for the reviewtools to work
include('libs/Forum.php');

//how many posts, etc to show on one page.  we're not using this, so it's set very high.
define('NUM_POSTS_SHOW',1000); 
define('NUM_THREADS_SHOW',1000);
define('NUM_ITEMS_SHOW',1000);

$forum = new Forum($system);
$document = 'forum_categories.tpl';
if (!isset($dir)) $dir=0;

//there are certain things they can do if they're not logged in:

if (!$logged_in) { 	
	$string = "Location: login.php?";
	if(isset($_GET)){
		foreach ($_GET as $key=>$value){
			$string.=$key."=".$value."&";
		}
	}
	header($string);
	}

switch($action) //here's the big one. everything in this file, really the whole site, runs off this switch.
{

case "submissions": //this one is All Papers - Summary
  if (!$smarty->get_template_vars('center'))
  {
    $index = isset($_GET['index'])?$_GET['index']:0;
    $numitems = $system->getNumSubmissions(null);
    $numscreens = ceil($numitems / NUM_ITEMS_SHOW);

    $smarty->assign('numscreens',$numscreens);
    $smarty->assign('numitemsshow',NUM_ITEMS_SHOW);
    $smarty->assign('numitems',$numitems);
    $smarty->assign('index',$index);
    $smarty->assign('script','index.php?');
    $smarty->assign('showabstract',true);

    if (isset($_GET['hideabstract'])) $smarty->assign('showabstract',false);
    $smarty->assign('dir',$dir);
    $smarty->assign('sorting',$sortby); //set by the user.  where's the default?

    $submissions = $system->getSubmissions(null,$index*NUM_ITEMS_SHOW,NUM_ITEMS_SHOW,$sortby,$dir);
    
    $smarty->assign('submissions',$submissions);
    if (isset($_GET['simple'])) {
      $smarty->assign('showabstract',false);
      $smarty->assign('center','submissions_simple.tpl');
      }
    else {
      $smarty->assign('center','submissions.tpl');
      }
  }
  break;

//this is the page that shows a submission and allows you to enter reviews and comments
case "showsubmission":
  $submissionid = $_GET['id'];
  if ($submission = $system->getSubmission($submissionid))
  {
    if ($system->admin || $submission['userid']==$userid) $smarty->assign('editable',true);
    $smarty->assign('submission',$submission);
    $smarty->assign('center','show_submission.tpl');
  }

  $index = isset($_GET['index'])?$_GET['index']:0;
  $thread = $forum->getThread($submissionid);

  if (!$thread['locked'] && isset($_POST['post']) && $system->logged_in) //if they're adding a post
  {
    	$post = $_POST['post'];
    if (strlen($post)>1) 
    {
      if (isset($_POST['quality'])) { //is a review
	  
	        //$system->log('review', 'reviewsubmit', 'about to add post');
	  
            $forum->addPost($system->userid,
      		$submissionid,str_replace("\n","<br>",htmlspecialchars($post, ENT_QUOTES)),
      		$_POST['quality'], htmlspecialchars($_POST['qualitytext'], ENT_QUOTES),
      		$_POST['appropriate'], htmlspecialchars($_POST['appropriatetext'], ENT_QUOTES),
      		$_POST['controversial'], htmlspecialchars($_POST['controversialtext'], ENT_QUOTES)
      		);}
      	else { //is a comment
	       $forum->addPost($system->userid, $submissionid,str_replace("\n","<br>",htmlspecialchars($post, ENT_QUOTES)),null,null,null,null,null,null);		
      		} 		
     $index = 1048576;  //we have no idea what this is doing.  is it supposed to be some kinda security thing?  because we can't figured it out.  jofish and caitlin.
    }
    else
      $error[] = "Post length must be at least two characters long";
  }
  $numposts = $forum->getNumPosts($submissionid); 
  $numscreens = ceil($numposts / NUM_POSTS_SHOW);  
  if ($index>=$numscreens) $index = $numscreens-1;  
  //$category = $forum->getCategory($thread['categoryid']);
  $posts = $forum->getPosts($submissionid,$index*NUM_POSTS_SHOW,NUM_POSTS_SHOW); //go get all the reviews or comments for this submission  
  $smarty->assign('numscreens',$numscreens);
  $smarty->assign('numpostsshow',NUM_POSTS_SHOW);
  $smarty->assign('numitemsshow',NUM_POSTS_SHOW);
  $smarty->assign('numposts',$numposts);
  $smarty->assign('numitems',$numposts);
  $smarty->assign('index',$index);
  $smarty->assign('script',"index.php?action=showsubmission&id=$submissionid");
  //$smarty->assign('category',$category);
  //$smarty->assign('thread',$thread);
  $smarty->assign('posts',$posts);
  $smarty->assign('reviewcount',$reviewcount);
  $document = 'show_submission.tpl';
  $smarty->assign('center',$document);
  break;

case "updatesubmission":
  if (!$logged_in) { header("Location: index.php"); exit(); }

  $id = $_GET['id'];
  if (!isset($id)) break;

  $submission = $system->getSubmission($id);
  if (!$submission) { $error[] = "No submission to edit."; break; }
  if (!$system->admin && ($submission['userid']!=$system->userid))
  {
    $error[] = "You are not allowed to edit this submission.";
    break;
  }
  $title = $_POST['title'];
  $additionalauthors = $_POST['authors'];
  $type = $_POST['type'];
  $keywords = $_POST['keywords'];
  $abstract_ = $_POST['abstract'];
  $link = $_POST['link'];
  $extras_name = $_POST['extras_name'];
  $extras_content = $_POST['extras_content'];
  $history = $_POST['history'];
  $videolink = $_POST['videolink'];
  $comments = $_POST['comments'];
  
  if (isset($title))
  {
    if ($title=="") $formerror[] = "No title.";
    //if (!isset($type)||$type=="") $formerror[] = "No type.";
    if (!isset($keywords)||$keywords=="") $formerror[] = "No keywords.";
    if (!isset($abstract_)||$abstract_=="") $formerror[] = "No abstract.";
    if (!$title) $error[] = "title";
    if (!$additionalauthors) $error[] = "additionalauthors";
    if (!$keywords) $error[] = "keywords";
    if (!$abstract_) $error[] = "abstract";
    if (!$link) $error[] = "link";
	if (isset($videolink)&&$videolink!="")
    {
      if (substr($videolink,0,7)!="http://")
      $_POST['videolink'] = $videolink = "http://".$videolink;
    }
    if (count($formerror)==0)
    {
      if (!($system->updateSubmission( $id,$title,$additionalauthors,$keywords,htmlspecialchars($abstract_, ENT_QUOTES),$link,$history,$videolink,$comments )))
      {
        //$system->updateSubmissionExtras( $id, $extras_name,$extras_content );
        //header("Location: index.php?action=showsubmission&id=$id");
        //exit();
      //}
      //else
      //{
        $error[] = "Unable to update submission.";
        break;
      }
	  else {
		$submission = $system->getSubmission($id); //need to get the submission again, to update fields.
		$submission['message'] = "Your submission has been updated.";  
	  }
    }
  }
  $smarty->assign("submission",$submission);
  $smarty->assign("formerror",$formerror);
  $smarty->assign("center","update_submission.tpl");
  break;
  
case "deletepost": //ie, delete review/comment.
  $postid = $_GET['id'];
  $userid = $system->userid;
  $index = isset($_GET['index'])?$_GET['index']:0;
  $thispost = $forum->getPost($postid);
  $thissubmissionid = $thispost['submissionid'];
  if ($system->admin || $thispost['userid']==$userid)
  {
    $forum->deletePost($postid, $userid);
    header("Location: index.php?action=showsubmission&id=$thissubmissionid&index=$index");
    exit();
  }
  break;

case "editpost": //ie, delete review/comment
  $postid = $_GET['id'];
  $index = isset($_GET['index'])?$_GET['index']:0;
  $post = $_POST['post'];
  if (isset($postid))
    $postdata = $forum->getPost($postid);
  if (!isset($post))
  {
    $smarty->assign('isreview', $forum->isReview($postid));
    $smarty->assign('index',$index);
    $postdata['post'] = str_replace("<br>","\n",$forum->htmlToFML($postdata['post']));
    $smarty->assign('post',$postdata);
    $document = 'forum_editpost.tpl';
  }
  else
  {
    if ($system->admin || $postdata['userid']==$system->userid)
    {
      $forum->editPost($postid,str_replace("\n","<br>",$post));
      header("Location: index.php?action=showsubmission&id=".$postdata['submissionid']."&index=$index");
    }
    else
      $error[] = "Not authorised to edit this post.";
  }
  $smarty->assign('center',$document);
  break;

case "myprofile":
  if(isset($_POST['email'])) {$email = $_POST['email'];}
  if(isset($_POST['pass1'])) {$pass1 = $_POST['pass1'];}
  if(isset($_POST['pass2'])) {$pass2 = $_POST['pass2'];}
  if(isset($_POST['affiliation'])) {$affiliation = $_POST['affiliation']; }
  $formerror = array();

  if (isset($email))
  {
    if ($pass1!=$pass2)
      $formerror[] = "Password mismatch.";
    if ($affiliation=="")
      $formerror[] = "No affiliation.";
    if ($email=="")
      $formerror[] = "No email.";
    if (count($formerror)==0)
    {
      if ($pass1!="")
        $system->userSetPassword( $system->userid, $pass1 );
      $system->userSetProfile( $system->userid, $email, $affiliation);
      $formerror[] = "Saved.";
    }
  }
  $userprofile = $system->getUserinfo($system->userid);
  $smarty->assign('userprofile',$userprofile);
  $smarty->assign('formerror',$formerror);
  $smarty->assign('center','myprofile.tpl');
  break;

case "deletesubmission":
    $submissionid = $_GET['id'];
    $submission = $system->getSubmission($submissionid);
    if ($system->admin || $submission['user']['id']==$system->userid) // make sure you have the privileges
    {
      $system->deleteSubmission($submissionid,$system->userid);
      //header("Location: index.php");
      //exit();
	  $smarty->assign("center","deletesubmission_confirm.tpl");
    }
	else
	{
	  $submission['nocandelete'] = "You don't have permission to delete this submission";
	  header("Location: index.php?action=showsubmission&id=".$submissionid);
	  exit(); 	
	}
  break;


  
case "search":
    $searchtext = $_POST['searchtext'];
    if (!isset($searchtext)) break;
  
    $results = $system->search($searchtext);
    $searchresults = array();
    foreach($results as $result)
    {
      switch($result['location'])
      {
      case "submissions":
        $submission = $system->getSubmission($result['id']);
        if ($submission)
          $searchresults[] = array('text' => "Submission: ".$submission['user']['lastname']." - ".$submission['title'] ,'link' => "index.php?action=showsubmission&id=".$submission['id']);
        break;
  
      case "reviews":
        $review = $system->getReview($result['id']);
        if ($review)
          $searchresults[] = array('text' => "Review: ".$review['user']['firstname']." ".$review['user']['lastname']." on ".$review['submission']['title'], 'link' => "index.php?action=showreview&id=".$review['id']);
        break;
      }
    }
    $smarty->assign("searchtext",$searchtext);
    $smarty->assign("searchresults",$searchresults);
    $smarty->assign("center","show_searchresults.tpl");
  break;
  
case "logout":
    $system->logout();
    header('Location: index.php');
    exit();
  break;
  
case "englishreview":
	$smarty->assign('center','english_review.tpl');
break;

case "jury":
	$smarty->assign('center','jurors.tpl');
break;
  
/*****************************************************************
Admin stuff only below this line.... well, except for default.
******************************************************************/

case "makeadmin":

  $uid = $_GET['id'];
  $index = isset($_GET['index'])?$_GET['index']:0;

  if (isset($uid) && $system->admin)
  {
    $system->userMakeAdmin($uid);
    //header("index.php?action=adminusers&index=$index");
	header('Location: index.php?action=adminusers');
    exit();
  }
  break;

case "dumplogs":
  if ($system->admin)
  {
    $logs = $system->getLogs();
    $smarty->assign('logs',$logs);
    $smarty->display('logs.tpl');
    exit();
  }
  else
    $error[] = "Not admin.";
  break;

case "showbugs":
  if ($system->admin)
  {
	$bugs = $system->getBugs();
	$smarty->assign('bugs',$bugs);
	$smarty->display('bugs.tpl');
	exit();  
  }
  else
  	$error[] = "Not admin.";
  break;

case "listusers":
  if ($logged_in)
  {
    $index = isset($_GET['index'])?$_GET['index']:0;
    $numitems = $system->getNumUsers();
    $numscreens = ceil($numitems / NUM_ITEMS_SHOW);
    $smarty->assign('numscreens',$numscreens);
    $smarty->assign('numitemsshow',NUM_ITEMS_SHOW);
    $smarty->assign('numitems',$numitems);
    $smarty->assign('index',$index);
    $smarty->assign('script','index.php?action=listusers');
    $users = $system->getUsers($index*NUM_ITEMS_SHOW,NUM_ITEMS_SHOW);
    $smarty->assign('users',$users);
    $smarty->assign('center','show_users.tpl');
  }
  else
    $error[] = "Sorry, you need to register and login to list users.";

  break;

case "adminusers":

  if ($system->admin)
  {
    $index = isset($_GET['index'])?$_GET['index']:0;
    $numitems = $system->getNumUsers();
    $numscreens = ceil($numitems / NUM_ITEMS_SHOW);
    $smarty->assign('numscreens',$numscreens);
    $smarty->assign('numitemsshow',NUM_ITEMS_SHOW);
    $smarty->assign('numitems',$numitems);
    $smarty->assign('index',$index);
    $smarty->assign('script','index.php?action=adminusers');
    $users = $system->getUsers($index*NUM_ITEMS_SHOW,NUM_ITEMS_SHOW);
    $smarty->assign('users',$users);
    $smarty->assign('center','show_users.tpl');
  }
  else
    $error[] = "Not admin.";

  break;

case "showuser":
  $showuserid = $_GET['id'];
  $showuser = $system->getUserinfo($showuserid);
  if ($showuser)
  {
    $submissions = $system->getSubmissions($showuserid,0,1048576);
    $reviews = $system->getUserReviews($showuserid);
    $smarty->assign('submissions',$submissions);
    $smarty->assign('reviews',$reviews);
    $smarty->assign('showuser',$showuser);
    $smarty->assign('center','show_user.tpl');
  }
  else
    $error[] = "User not found.";
  break;

case "deleteuser":
  if ($system->admin)
  {
    $userid = $_GET['id'];
    $index = isset($_GET['index'])?$_GET['index']:0;
    if ($userid)
    {
      $system->deleteUser($userid);
      header("Location: index.php?action=adminusers&index=$index");
      exit();
    }
  }
  else
    $error[] = "Not admin.";
  break;
  
  
case "reportbug":
    if (!$logged_in) { header("Location: index.php"); exit(); }
    $text = $_POST['text'];
    if (isset($text))
    {
      $system->bugSubmitReport($text);
      header('location: index.php');
      break;
    }
    else
      $smarty->assign('center',"bug_report.tpl");
  break;

case "mailall":
  if (!$logged_in) { header("Location: index.php"); exit(); }
  $subject = $_POST['subject'];
  $content = $_POST['content'];
  if (isset($subject)&&isset($content))
  {
    header('Content-Type: text/plain');
    echo "sending...<br>\n";
    if ($system->mailAll($subject,$content))
      echo "subject: ".$subject."<br>\n $content";
    else
      echo "ERROR sending mail.\n";
    exit();
  }
  else
    $smarty->assign('center','mailall.tpl');
  break;
  
case "printsubmissions": //displays them suitable for printing or saving offline.
  if (!$logged_in) { header("Location: index.php"); exit(); }

  if (!$smarty->get_template_vars('center'))
  {
    $index = isset($_GET['index'])?$_GET['index']:0;
    $numitems = $system->getNumSubmissions(null);
    $numscreens = ceil($numitems / NUM_ITEMS_SHOW);
    $smarty->assign('numscreens',$numscreens);
    $smarty->assign('numitemsshow',NUM_ITEMS_SHOW);
    $smarty->assign('numitems',$numitems);
    $smarty->assign('index',$index);
    $smarty->assign('script','index.php?');
    if (isset($_GET['showabstract'])) $smarty->assign('showabstract',true);
    $smarty->assign('dir',$dir);
    $smarty->assign('sorting',$sortby);
//    $submissions = $system->getSubmissions(null,$index*NUM_ITEMS_SHOW,NUM_ITEMS_SHOW,$sortby,$dir);
    $submissions = $system->getSubmissions(null,0,999999,$sortby,$dir);
    $smarty->assign('submissions',$submissions);
    $smarty->assign('hidemenu','true');
//    $smarty->assign('center','print_submissions.tpl');
	$smarty->display('print_submissions.tpl');
	exit();
  }
  break;

 case "shownumbers": //this one is Numbers Page

  if (!$smarty->get_template_vars('center'))
  {
    $index = isset($_GET['index'])?$_GET['index']:0;
    $numitems = $system->getNumSubmissions(null);
    $numscreens = ceil($numitems / NUM_ITEMS_SHOW);

    $smarty->assign('numscreens',$numscreens);
    $smarty->assign('numitemsshow',NUM_ITEMS_SHOW);
    $smarty->assign('numitems',$numitems);
    $smarty->assign('index',$index);
    $smarty->assign('script','index.php?');
    $smarty->assign('showabstract',true);

    if (isset($_GET['hideabstract'])) $smarty->assign('showabstract',false);
    $smarty->assign('dir',$dir);
    if (!isset($_GET['sortby'])) $sortby = 'total'; //override the normal default for this page
    $smarty->assign('sorting',$sortby); //set by the user.  where's the default?
    $submissions = $system->getSubmissions(null,$index*NUM_ITEMS_SHOW,NUM_ITEMS_SHOW,$sortby,$dir);
    
    $smarty->assign('submissions',$submissions);
    $smarty->assign('showabstract',false);
    $smarty->assign('center','show_numbers.tpl');
  }
  break; 

 case "showreviewers": //show reviewers for printing

  if (!$smarty->get_template_vars('center'))
  {
    $index = isset($_GET['index'])?$_GET['index']:0;
    $numitems = $system->getNumSubmissions(null);
    $numscreens = ceil($numitems / NUM_ITEMS_SHOW);

    $smarty->assign('numscreens',$numscreens);
    $smarty->assign('numitemsshow',NUM_ITEMS_SHOW);
    $smarty->assign('numitems',$numitems);
    $smarty->assign('index',$index);
    $smarty->assign('script','index.php?');
    $smarty->assign('showabstract',true);

	$posts = $forum->getAllReviews(); //go get all the reviews or comments for this submission
	$smarty->assign('posts',$posts);

	
    if (isset($_GET['hideabstract'])) $smarty->assign('showabstract',false);
    $smarty->assign('dir',$dir);
    if (!isset($_GET['sortby'])) $sortby = 'total'; //override the normal default for this page
    $smarty->assign('sorting',$sortby); //set by the user.  where's the default?
    $submissions = $system->getSubmissions(null,$index*NUM_ITEMS_SHOW,NUM_ITEMS_SHOW,$sortby,$dir);
    
    $smarty->assign('submissions',$submissions);
    $smarty->assign('showabstract',false);
    $smarty->assign('center','show_reviewers.tpl');
  }
  break; 
	

  
 case "showreviewsummaries": //this one is review summaries Page

  if (!$smarty->get_template_vars('center'))
  {
    $index = isset($_GET['index'])?$_GET['index']:0;
    $numitems = $system->getNumSubmissions(null);
    $numscreens = ceil($numitems / NUM_ITEMS_SHOW);

    $smarty->assign('numscreens',$numscreens);
    $smarty->assign('numitemsshow',NUM_ITEMS_SHOW);
    $smarty->assign('numitems',$numitems);
    $smarty->assign('index',$index);
    $smarty->assign('script','index.php?');
    $smarty->assign('showabstract',true);

	$posts = $forum->getAllReviews(); //go get all the reviews or comments for this submission
	$smarty->assign('posts',$posts);

	
    if (isset($_GET['hideabstract'])) $smarty->assign('showabstract',false);
    $smarty->assign('dir',$dir);
    if (!isset($_GET['sortby'])) $sortby = 'total'; //override the normal default for this page
    $smarty->assign('sorting',$sortby); //set by the user.  where's the default?
    $submissions = $system->getSubmissions(null,$index*NUM_ITEMS_SHOW,NUM_ITEMS_SHOW,$sortby,$dir);
    
    $smarty->assign('submissions',$submissions);
    $smarty->assign('showabstract',false);
    $smarty->assign('center','show_review_summaries.tpl');
  }
  break; 
	
 case "accepted": //accepted papers
  if (!$smarty->get_template_vars('center'))
  {
    $submissions = $system->getSubmissions(null,0,NUM_ITEMS_SHOW,'title',0);
    $smarty->assign('submissions',$submissions);
    $smarty->assign('center','accepted_papers.tpl');
  }
  break; 

default:
  if (!$smarty->get_template_vars('center'))
  {
  
  //first get all the variables and stuff we'll need to display My Submissions
    $index = isset($_GET['index'])?$_GET['index']:0;
    $numitems = $system->getNumSubmissions(null);
    $numscreens = ceil($numitems / NUM_ITEMS_SHOW);
    $smarty->assign('numscreens',$numscreens);
    $smarty->assign('numitemsshow',NUM_ITEMS_SHOW);
    $smarty->assign('numitems',$numitems);
    $smarty->assign('index',$index);
    $smarty->assign('script','index.php?');
    if (isset($_GET['showabstract'])) $smarty->assign('showabstract',true);
    $smarty->assign('dir',$dir);
    $smarty->assign('sorting',$sortby);

    //first get all of their submissions and send them into smarty.
    $submissions = $system->getSubmissions($system->userid,$index*NUM_ITEMS_SHOW,NUM_ITEMS_SHOW,$sortby,$dir);
    $smarty->assign('submissions',$submissions);

  //now get all of their reviews and send them into smarty
    $reviews = $system->getUserReviews($system->userid);
    $smarty->assign('reviews',$reviews);
    $smarty->assign('center','portal.tpl');

//edit and enable the following when you want to [start to] remove
//all of the active functionality from the site
//	$smarty->assign('center','start.tpl');
  }
  break;
}
$smarty->assign('error',$error);
$smarty->display('index.tpl');
?>