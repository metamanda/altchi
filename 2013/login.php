<?php


// $DOWNFORMAINTENANCE = true;
//init.php initalizes all the smarty stuff, the session, and so on.
include('init.php');
//include('libs/System.php');
include('libs/Forum.php');
$forum = new Forum($system);

define('NUM_POSTS_SHOW',1000); 
define('NUM_THREADS_SHOW',1000);
define('NUM_ITEMS_SHOW',1000);
$numscreens = ceil($numitems / NUM_ITEMS_SHOW);

$sortby = isset($_GET['sortby'])?$_GET['sortby']:"numreviews";
$dir = isset($_GET['dir'])?$_GET['dir']:1;

//only turn this on if you're trying to debug stuff, as it'll break other things
//because you can't redirect the page once it has started to display stuff.
//ini_set('display_errors',true);

$smarty->assign('loginform',$_POST);


//if they haven't set a particular action, then just set it to null and call the case default down below.
$action = isset($_GET['action'])?$_GET['action']:null;

function createRandomPassword() { //only used in case "retrievepassword"
    $chars = "abcdefghijkmnopqrstuvwxyz023456789";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;
    while ($i <= 7) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
}

switch($action)
{
case "retrievepassword":
  require_once('phpmailer/class.phpmailer.php');
  $mail = $_POST['email'];
  if (!isset($mail))
  {
    $smarty->assign('center','retrievepassword.tpl');
  }
  else if($user = $system->getUserByEmail($mail))
  {
    $pass = createRandomPassword();
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = "localhost";
    $mail->SMTPAuth = false;
    $mail->Username = "noreply";
//    $mail->Password = "8ouq2abr";  there's no authent needed here at acm for localhost smtp.
    $mail->From = "noreply@altchi.org";
    $mail->FromName = "";
    $mail->AddAddress($user['email'],$user['firstname']." ".$user['lastname']);
    $mail->AddReplyTo("noreply@altchi.org","No reply");
    $mail->IsHTML(false);
    $mail->Subject = "[alt.chi] Password retrieval";
    $mail->Body = "Hello ".$user['firstname']." ".$user['lastname']."\n\n";
    $mail->Body .= "Your password has been changed as per your request.\n";
    $mail->Body .= "\nYou login name is: ".$user['user'].".\n";
    $mail->Body .= "Your new password is: $pass\n\nPlease use it to login and then change it.";

    if ($mail->Send())
    {
      $system->userSetPassword($user['id'],$pass);
      $smarty->assign('center','passwordsent.tpl');
    }
    else
    {
      $error[] = "Error sending email. Please contact system administrator.";
    }
    $error[] = "Ok";
  }
  else
  {
    $error[] = "No user with such email.";
    $smarty->assign('center','retrievepassword.tpl');
  }
  break;
  
case "englishreview":
	$smarty->assign('center','english_review.tpl');
break;

case "jury":
	$smarty->assign('center','jurors.tpl');
break;

case "login":
  if (!$logged_in)
  {
    $user = $_POST['username'];
    $pass = $_POST['pass'];
    if (isset($user)&&isset($pass)){
      if ($system->login($user,$pass))
      {
        if (!$system->isVerified)
        {
          //ie they have an account but they haven't clicked on the link in the email yet.
          $smarty->assign("user",$system->getUserByName($user));
          $smarty->assign("center","unverified.tpl");
        }else{ //so they've got a real account, they've verified: time to go to useful stuff.
          header("Location: index.php");
          exit();
        }
      }else{
        $error[] = "<p style=\"position: absolute; left: 150px; top: 150px; z-index: 5;\">Username or password not found.<br><br><br>Please note: even if you have registered for alt.chi in the past, you will need to re-register this year.  Our apologies.</p>";
      }
    }
  }else {
  //if user is logged in
    header("Location: index.php");
	exit();
  }
  break;

case "sendverification":
  $id = $_GET['id'];
  $pass = $_POST['pass'];
  if (isset($id) && isset($pass))
  {
    $userinfo = $system->getUserinfo($id);
    if ($userinfo['pass']==md5($pass))
    {
      $system->sendVerificationMail($userinfo['user']);
      header("Location: index.php?action=verify");
      exit();
    }
    else
		$error[] = "Wrong password";
  }
  break;



case "register":
  if(isset($_POST['user'])){ $user = $_POST['user']; }
  if(isset($_POST['pass1'])){ $pass1 = $_POST['pass1']; }
  if(isset($_POST['pass2'])){ $pass2 = $_POST['pass2']; }
  if(isset($_POST['first'])){ $first = $_POST['first']; }
  if(isset($_POST['last'])){ $last = $_POST['last']; }
  if(isset($_POST['affiliation'])){ $affiliation = $_POST['affiliation']; }
  if(isset($_POST['presentation'])){ $presentation = $_POST['presentation']; }
  if(isset($_POST['email'])){ $email = $_POST['email']; }

  $formerror = array();
  if (isset($user) && isset($pass1) && isset($pass2))
  {
    if ($system->userExists($user))
      $formerror[] = "Username exists.";
    if ($pass1=="")
      $formerror[] = "No password";
    if ($pass1!=$pass2)
      $formerror[] = "Passwords different!";
    if (!isset($first)||$first=="")
	      $formerror[] = "No first name";
	if (($first!=htmlentities($first,ENT_QUOTES)) || ($last!=htmlentities($last,ENT_QUOTES)) || ($user!=htmlentities($user,ENT_QUOTES)))
      $formerror[] = "No punctuation characters allowed in first, last or usernames.";
    if (!isset($last)||$last=="")
      $formerror[] = "No last name";
    if (!isset($affiliation)||$affiliation=="")
      $formerror[] = "No affiliation";
    if (!isset($email) || !ereg( "^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+)(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,4})$", $email) )
      $formerror[] = "Invalid or no email address.";
	  
    if (count($formerror)==0 &&
        $system->register( $user, $pass1, $first, $last, $affiliation, $email ))
    {
      $system->sendVerificationMail($user);
      header('Location: login.php?action=verify');
      exit();
    }
	else
	{
	print "we have some errors";
	$smarty->assign('formerror',$formerror);
	}
  }
  $smarty->assign('form',$_POST);
  $smarty->assign('center','register.tpl');
  break;

case "dontagree":
  $smarty->assign("center","verify_notagree.tpl");
  break;

case "verify":
  if(isset($_GET['code'])){ $code = $_GET['code']; }
  if(isset($_GET['user'])){ $user = $_GET['user']; }
  if(isset($_GET['agreement'])){ $agreement = $_POST['agreement']; }
  if(isset($_POST['agreement'])){ $agreement = $_POST['agreement']; }

  if (isset($code)) {
    if (!isset($agreement)) {
      $smarty->assign('code',$code);
      $smarty->assign('user',$user);
      $smarty->assign("center","verify_conditions.tpl");
      break;
    }
	
    if (!agreement) {
      $smarty->assign("center","verify_notagree.tpl");
      break;
    }
	
    $user = $system->getUserByName($user);
    if ($user) {
      if ($user['status']!="") {
        $error[] = "Already verified. Please login.";
        break;
      }
	  
      $c = md5($user['firstname'].$user['lastname'].$user['email']);
      if ($c==$code) {
        // verified
        $system->userVerify( $user['id'] );
        $smarty->assign("center","verified.tpl");
      } else {
        // error
        $error[] = "Illegal link!";
      }
    } else {
		$error[] = "No such user.";
	}
  } else {
    $smarty->assign("center","verify.tpl");
  }
  break;

case "submissions": //this one is All Papers - Summary
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
    $smarty->assign('sorting',$sortby); 
    $submissions = $system->getSubmissions(null,$index*NUM_ITEMS_SHOW,NUM_ITEMS_SHOW,$sortby,$dir);
    //$submissions = $system->getSubmissions(null,0,100,$sortby,$dir);
    $smarty->assign('submissions',$submissions);
    if (isset($_GET['simple'])) {
      $smarty->assign('showabstract',false);
      $smarty->assign('center','submissions_simple_guest.tpl');
      }
    else {
      $smarty->assign('center','submissions_guest.tpl');
      }
  break;

//this is the page that shows a submission and allows you to enter reviews and comments
case "showsubmission":
	$submissionid = $_GET['id'];
	if ($submission = $system->getSubmission($submissionid)) {
		$smarty->assign('submission',$submission);
		$smarty->assign('center','show_submission_guest.tpl');
	}

	$index = isset($_GET['index'])?$_GET['index']:0;

  $numposts = 1000; 
  $thread = $forum->getThread($submissionid);

  $posts = $forum->getPosts($submissionid,0,1000); //go get all the reviews or comments for this submission
  $smarty->assign('numscreens',$numscreens);
//  $smarty->assign('numpostsshow',NUM_POSTS_SHOW);
  $smarty->assign('numitemsshow',NUM_POSTS_SHOW);
//  $smarty->assign('numposts',$numposts);
  $smarty->assign('numitems',$numposts);
  $smarty->assign('index',$index);
  $smarty->assign('script',"index.php?action=showsubmission&id=$submissionid");
  $smarty->assign('thread',$thread);
  $smarty->assign('posts',$posts);
  $document = 'show_submission_guest.tpl';
  $smarty->assign('center',$document);
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
	$smarty->assign('center','introduction.tpl');
	break;
}

$smarty->assign('hidemenu','false');
$smarty->assign('error',$error);
$smarty->display('index.tpl');

?>