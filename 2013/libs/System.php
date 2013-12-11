<?php

include('phpmailer/class.phpmailer.php');

//comment this for production use
//ini_set('display_errors',true);

require('db.php');

class OpenSession
{
  var $user = null;
  var $userid = null;
  var $firstname = null;
  var $lastname = null;
  var $status = null;
  var $admin = false;
  var $isVerified = false;

  //var $submissionsPath = "/acminfo/2/sigs/sigchi/chi2008/altchisystem/submissions/";
  /* MAY NEED TO CHANGE THIS WHEN WE PUT THIS ON THE REAL SERVER*/
  var $submissionsPath = "/home1/altchior/public_html/2013/submissions/";
  //var $submissionsPath = "/acminfo/7/conferences/chi2012/altchisystem/submissions/";
  var $submissionsUrl = "submissions/";

  function login($user,$pass)
  {
    global $dbprefix;
    $md = md5($pass);

    $query = "SELECT * FROM {$dbprefix}users WHERE user='$user'";// AND pass='$md'";
    $query .= " AND pass='$md'";

    $result = mysql_query($query);

    if (mysql_num_rows($result)==0) return false;

    $id = mysql_result($result,0,'id');
    $lastlogin = mysql_result($result,0,'lastlogin');

    $now = date("Y-m-d H:i:s");
    $query = "UPDATE {$dbprefix}users SET lastlogin='$now' WHERE id='$id'";
    mysql_query($query);

    if ($this->loadUserinfo($user))
    {
      if ($this->isVerified)
      {
        if (!isset($_SESSION[$dbprefix]['user'])||$_SESSION[$dbprefix]['user']!=$this->user)
        {
          $_SESSION[$dbprefix]['user'] = $this->user;
          $_SESSION[$dbprefix]['userid'] = $this->userid;
          $_SESSION[$dbprefix]['lastlogin'] = $lastlogin;
        }
      }
      else
        return "unverified";
    }
    else
      return false;

    $userid = $this->userid;
    $this->log("users","login","$userid,$user");

    return true;
  }

  function logout()
  {
	global $dbprefix;
//    unset($_SESSION[$dbprefix]['user']);
//    unset($_SESSION[$dbprefix]['userid']);
	unset($_SESSION[$dbprefix]);
	session_destroy();
	$userid = $this->userid;
    $user = $this->user;
    $this->log("users","logout","$userid,$user");
  }

  function register($user,$pass,$first,$last,$affiliation,$email)
  {
    global $dbprefix;
    $md = md5($pass);

    $registered = date("Y-m-d H:i:s");

    $query = "INSERT INTO {$dbprefix}users (user,firstname,lastname,pass,affiliation,email,status,registered,lastlogin) VALUES ('$user','$first','$last','$md','$affiliation','$email','','$registered', '$registered')";
    mysql_query($query);

    $id = mysql_insert_id();

    $this->log("user","registered","$id,$user");

    return true;
  }
	
  function userVerify( $userid )
  {
    global $dbprefix;
    $query = "UPDATE {$dbprefix}users SET status='user' WHERE id='$userid'";
    return mysql_query($query);
  }

  function userSetPassword( $userid, $password )
  {
    global $dbprefix;
    $md = md5($password);
    $query = "UPDATE {$dbprefix}users SET pass='$md' WHERE id='$userid'";
    return mysql_query($query);
  }

  function userSetProfile( $userid, $email, $affiliation)
  {
    global $dbprefix;
    $query = "UPDATE {$dbprefix}users SET email='$email', affiliation='$affiliation' WHERE id='$userid'";
    return mysql_query($query);
  }
  
  function sendEmail( $userid, $email )
  {
	$user = $this->getUserinfo($userid);
	if (!$user) return false;
    $mail = new PHPMailer();

    if (!$mail) return false;

    $mail->IsSMTP();
    $mail->Host = "localhost";
    //$mail->SMTPAuth = true;
    //$mail->SMTPAuth = false;
    //$mail->Username = "noreply";
    //$mail->Password = "8ouq2abr";

    $mail->From = "altchi@chi2013.acm.org";
    $mail->FromName = "alt.chi 2013";
    $mail->AddAddress($user['email'],$user['firstname']." ".$user['lastname']);
    // $mail->AddReplyTo("noreply@acm.org","No reply");

    $mail->IsHTML(false);

    $mail->Subject = "[alt.chi]";
    $mail->Body = $email;
    if ($mail->Send())
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  function sendVerificationMail( $username )
  {
    $user = $this->getUserByName($username);
    if (!$user) return false;

    $mail = new PHPMailer();

    if (!$mail) return false;

    $mail->IsSMTP();
    $mail->Host = "localhost";
    //$mail->SMTPAuth = true;
    //$mail->Username = "noreply";
    //$mail->Password = "8ouq2abr";

    //$mail->cc = "jofish@cornell.edu";
    $mail->From = "altchi@chi2013.acm.org";
    $mail->FromName = "alt.chi 2013";
    $mail->AddAddress($user['email'],$user['firstname']." ".$user['lastname']);
    $mail->AddReplyTo("noreply@acm.org","No reply");

    $mail->IsHTML(false);

    $mail->Subject = "[alt.chi] Verification";
    $mail->Body = "";

    $code = md5($user['firstname'].$user['lastname'].$user['email']);
$mail->Body .= "Thanks for your interest in alt.chi 2013!

To verify your account, please click on the link below.

IMPORTANT: You must agree to certain conditions to be able to participate in the alt.chi review process. These are clearly stated on the web site you reach through the link. READ THEM CAREFULLY before you accept!

We look forward to your contributions!

   - Amanda and Daniela

http://altchi.org/2013/login.php?action=verify&user=$username&code=$code
";

    if ($mail->Send())
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  function userExists($user)
  {
    global $dbprefix;
    $query = "SELECT * FROM {$dbprefix}users WHERE user='$user'";
    $result = mysql_query($query);
    if (mysql_num_rows($result)==0) return false;
    else return true;
  }

  function setPermissions()
  {
    if (!isset($this->userid)) return false;

    switch($this->status)
    {
    case 'admin':
      $this->admin = true;
    default:
      break;
    }

    return true;
  }

  function loadUserinfo($user)
  {
    global $dbprefix;
    if ($user=="") return false;

    $query = "SELECT * FROM {$dbprefix}users WHERE user='$user'";
    $result = mysql_query($query);
    
    //echo "<pre>";
    //print_r(mysql_fetch_array($result));
    //echo "</pre>";
    
    if (mysql_num_rows($result)==0) return false;

    $this->user = $user;
    $this->userid = mysql_result($result,0,'id');
    $this->firstname = mysql_result($result,0,'firstname');
    $this->lastname = mysql_result($result,0,'lastname');
    $this->status = mysql_result($result,0,'status');
    $this->isVerified = $this->status!=""?true:false;
    $this->lastlogin = $_SESSION[$dbprefix]['lastlogin'];

    $this->setPermissions();

    return true;
  }

  function getUserByEmail( $email )
  {
    global $dbprefix;
    $query = "SELECT * FROM {$dbprefix}users WHERE email='$email'";
    $result = mysql_query($query);

    if (mysql_num_rows($result)==0) return null;

    $user = mysql_fetch_assoc($result);
    mysql_free_result($result);

    // make backwards compatible
    $user['name'] = $user['user'];

    return $user;
  }

  function getUserByName($username)
  {
    global $dbprefix;
    $query = "SELECT * FROM {$dbprefix}users WHERE user='$username'";
    $result = mysql_query($query);

    if (mysql_num_rows($result)==0) return null;

    $user = mysql_fetch_assoc($result);
    mysql_free_result($result);

    // make backwards compatible
    $user['name'] = $user['user'];

    return $user;
  }

  function getUserinfo($userid)
  {
    global $dbprefix;
    $query = "SELECT * FROM {$dbprefix}users WHERE id='$userid'";
    $result = mysql_query($query);

    if (mysql_num_rows($result)==0) return null;

    $user = mysql_fetch_assoc($result);
    mysql_free_result($result);

    // make backwards compatible
    $user['name'] = $user['user'];

    return $user;
  }

  function userMakeAdmin($userid)
  {
    global $dbprefix;
    $query = "UPDATE {$dbprefix}users SET status='admin' WHERE id='$userid'";
    return mysql_query($query);
  }

  //
  // submissions
  //

  //
  // prepares the submitted file.
  // copies the temporary file to user temp directory and returns filename
  //
  //function submitSubmissionPrepare($title,$authors,$type,$keywords,$abstract_,$file,$link)
  
  /*
  XXX 2013 XXX Will need to alter this to accommodated db changes for additional authors.
  */
  function submitSubmissionPrepare($title,$authors,$keywords,$abstract_,$file,$link)
  {
    $userid = $this->userid;

    $filename = null;
    $filesize = 0;
	
	//$this->log("submissions","submitprepare","tried to copy file");
    if ($file && $file['tmp_name']!="")
    {
	  $this->log("submissions","submitprepare","tried to copy file, file had tmp_name");
      $filename = $file['name'];
	  mkdir($this->submissionsPath.$this->user);
      if (copy($file['tmp_name'],$this->submissionsPath.($this->user)."/".$filename))
      {
        $this->log("submissions","submitprepare","copying file $filename");
        return $filename;
      }
      else
      {
        $this->log("submissions","submitprepare","FAILED to copy $filename");
      }
    }
    else
      $this->log("submissions","submitprepare","FAIL. no file to prepare: $filename");


    return null;
  }

  //function submitSubmission($title,$authors,$type,$keywords,$abstract_,$filename,$link, $extras_name,$extras_content, $history, $hidden)
  
    /*
  XXX 2013 XXX Will need to alter this to accommodated db changes for additional authors.
  */
  
  function submitSubmission($title,$authors,$keywords,$abstract_,$filename,$link, $history, $videolink, $comments, $hidden)
  {
    global $dbprefix;

    $userid = $this->userid;
	
	$this->log("submissions","submit","trying to submit ".$filename);

    $filesize = 0;
    if ($filename)
    {
      $query = "SELECT COUNT(*) FROM {$dbprefix}submissions WHERE userid='$userid'";
      $result = mysql_query($query);
      $row = mysql_fetch_row($result);
      $numsubs = $row[0];

      $oldfilename = $this->submissionsPath.$this->user."/".$filename;
      $newfilename = "submission_".($this->user)."_".$numsubs.substr($filename, strrpos($filename,"."));
      $filesize = filesize($oldfilename);
	  
	  $this->log("submissions","submit","trying to submit ".$oldfilename);
	  $this->log("submissions","submit","trying to submit ".$newfilename);
	 


      if (!rename($oldfilename,$this->submissionsPath.$newfilename)) return false;
      $filename = $newfilename;
	  $temppath = $this->submissionsPath."$newfilename";
	  
	 // if (file_exists($temppath))
		//print "FILE DEFINITELY EXISTS";
	  
	  //print "making public: $temppath";
	  chmod($temppath,0777); 
	  
    }
    else
      {
	//print("jofisherror: no \$filename <br>");
      }
	  

    $date = date("Y-m-d H:i:s");

    $hiddenstr = $hidden?"1":"0";
	
	  /*
  XXX 2013 XXX Will need to alter this to accommodated db changes for additional authors.
  */

    $query = "INSERT INTO {$dbprefix}submissions (userid,title,additionalauthors,keywords,abstract,filename,filesize,link,history,videolink,comments,submitted,hidden)".
      "VALUES ".
      "('$userid','".
      mysql_real_escape_string($title)."','".
      mysql_real_escape_string($authors)."','".
      mysql_real_escape_string($keywords)."','".
      mysql_real_escape_string($abstract_)."'".
      ",'$filename','$filesize','$link','".
      mysql_real_escape_string($history)."','".
	  mysql_real_escape_string($videolink)."','".
	  mysql_real_escape_string($comments).
      "','".$date."','$hiddenstr')";
    if (!mysql_query($query)) 
      {
	echo "there was some mysql error:". mysql_error();
	return false;
      }

    $id = mysql_insert_id();

    $this->log("submissions","submit","$id,$title");

    // adding extras
    /*if (count($extras_name)>0 && count($extras_content)>0)
    {
      for ($i=0;$i<count($extras_name)&&$i<count($extras_content);$i++)
      {
        $name = $extras_name[$i];
        $content = $extras_content[$i];
        if ($name!="" || $content!="")
        {
          $query = "INSERT INTO {$dbprefix}submissions_extrafields (submissionid,name,content) VALUES ('$id','$name','$content')";
          mysql_query($query);
        }
      }
    }*/

    // set search words
    $this->parseForSearchWords($title,"submissions","$id");
    $this->parseForSearchWords($abstract_,"submissions","$id");
	
	  /*
  XXX 2013 XXX Will need to alter this to accommodated db changes for additional authors.
  */
  
    $this->parseForSearchWords($authors,"submissions","$id");
    $this->parseForSearchWords($keywords,"submissions","$id");
    $this->parseForSearchWords($this->firstname." ".$this->lastname,"submissions","$id");

    return $id;
  }

  
  //function updateSubmission($id,$title,$authors,$type,$keywords,$abstract_,$link,$history)
  
    /*
  XXX 2013 XXX Will need to alter this to accommodated db changes for additional authors.
  */
  
  function updateSubmission($id,$title,$authors,$keywords,$abstract_,$link,$history,$videolink,$comments)
  {
    global $dbprefix;
    if (!$id||!$title||!abstract_) return false;

    $submission = $this->getSubmission($id);
    if (!$submission) return false;

    $editdate = date("Y-m-d H:i:s");
	
	  /*
  XXX 2013 XXX Will need to alter this to accommodated db changes for additional authors.
  */

    $query = "UPDATE {$dbprefix}submissions SET title='$title',additionalauthors='$authors',keywords='$keywords',abstract='$abstract_',history='$history',videolink='$videolink',comments='$comments',edited='$editdate' WHERE id='$id'";
    if (mysql_query($query))
    {
      $this->log("submissions","update","$id");

      // update search words
      $this->removeSearchWords("submissions","$id");
      $this->parseForSearchWords($title,"submissions","$id");
      $this->parseForSearchWords($abstract_,"submissions","$id");
	  
	    /*
  XXX 2013 XXX Will need to alter this to accommodated db changes for additional authors.
  */
  
      $this->parseForSearchWords($authors,"submissions","$id");
      $this->parseForSearchWords($this->firstname." ".$this->lastname,"submissions","$id");
      $this->parseForSearchWords($keywords,"submissions","$id");
      return true;
    }
    return false;
  }

  /*
  function updateSubmissionExtras( $id, $extras_name,$extras_content )
  {
    global $dbprefix;
    $query = "DELETE FROM {$dbprefix}submissions_extrafields WHERE submissionid='$id'";
    mysql_query($query);

    // adding extras
    if (count($extras_name)>0 && count($extras_content)>0)
    {
      for ($i=0;$i<count($extras_name)&&$i<count($extras_content);$i++)
      {
        $name = $extras_name[$i];
        $content = $extras_content[$i];
        if ($name!="" || $content!="")
        {
          $query = "INSERT INTO {$dbprefix}submissions_extrafields (submissionid,name,content) VALUES ('$id','$name','$content')";
          mysql_query($query);
        }
      }
    }



    return true;
  }
*/

  function getSubmission($id)
  {
    global $dbprefix;

    $query = "SELECT * FROM {$dbprefix}submissions WHERE id='$id'";

    $result = mysql_query($query);
    $numrows = mysql_num_rows($result);

    if ($numrows==0) return null;

    $submission = mysql_fetch_assoc($result);
    mysql_free_result($result);

    if ($submission['hidden'] && !$this->admin)
      return false;

    if ($submission['filename'])
    {
      // beware order
      $submission['url'] = $this->submissionsUrl.$submission['filename'];
      $submission['filename'] = $this->submissionsPath.$submission['filename'];
    }
    $user = $this->getUserinfo($submission['userid']);
    $submission['user'] = $user;

	$submission['numreviews']=0;
    $query = "SELECT count(*) FROM {$dbprefix}reviews WHERE submissionid=$id AND quality > 0";
    $result = mysql_query($query);
    $submission['numreviews']+=mysql_result($result,0);	

	/*$submission['numcomments']=0;	
	$query = "SELECT count(*) as count FROM {$dbprefix}forum_posts WHERE submissionid=$id AND quality = 0";
    $result = mysql_query($query);
	$count = mysql_fetch_array($result);
    $submission['numcomments']+=$count['count'];*/

    //$query = "SELECT name,content FROM {$dbprefix}submissions_extrafields WHERE submissionid='$id'";
    //$result = mysql_query($query);

    /*
	if (mysql_num_rows($result)>0)
      $submission['extras'] = array();
    while($row = mysql_fetch_assoc($result))
    {
      $submission['extras'][] = $row;
    }
	*/
	
    //mysql_free_result($result);

    $submission['reviewcommitments'] = $this->getCommittedUsers($id);
    $submission['committedtoreview'] = $this->hasCommitted( $this->userid, $id );

    return $submission;
  }

  function getNumSubmissions($userid)
  {
    global $dbprefix;

    if ($userid)
      $query = "SELECT COUNT(*) FROM {$dbprefix}submissions WHERE userid='$userid' AND hidden='0'";
    else
      $query = "SELECT COUNT(*) FROM {$dbprefix}submissions WHERE hidden='0'";

    $result = mysql_query($query);
    if (!$result) return 0;

    $row = mysql_fetch_row($result);
    mysql_free_result($result);

    return $row[0];
  }

  function getNumNewPosts($submissionid)
  {
	global $dbprefix;
    $since = $_SESSION[$dbprefix]['lastlogin'];
    $q = "SELECT count(*) FROM {$dbprefix}review_commitments com WHERE com.date>'$since' AND submissionid = $submissionid";
    $r = mysql_query($q);
    $w = mysql_fetch_row($r);
    mysql_free_result($r);
    return $w[0];
  }
  
  function getMostRecentActivity($submissionid)
  {
      global $dbprefix;      
      
      //start off by looking at the posted date.
      $q = "SELECT MAX(date) FROM {$dbprefix}review_commitments com WHERE submissionid = $submissionid";
      $r = mysql_query($q);
      $latestdatearray = mysql_fetch_array($r);
      $latestdate = $latestdatearray[0];
      
      if ($latestdate != '') //if nobody's made any comments, then this is ''
      {
      	//if they've edited it... otherwise this'll just be null.
      	$q = "SELECT MAX(edited) FROM {$dbprefix}reviews r WHERE submissionid = $submissionid";
      	$r2 = mysql_query($q);
      	if ($r2)
      		{
      		$latestedit = mysql_fetch_array($r2);
		if ($latestedit[0] != '')
		      	$latestdate = $latestedit[0];
      		}
      	     
	$timedif = time() - strtotime($latestdate); //number of seconds since activity
	$daysdif = floor($timedif / (60*60*24)); //convert to days
        return $daysdif;
      }
      else
      {
	$myquery66 = "SELECT submitted FROM {$dbprefix}submissions WHERE id=$submissionid";
	$myresult66 = mysql_query($myquery66);
	$myarray66 = mysql_fetch_array($myresult66);
	//print $myarray66[0]."<br>";
	$timedif = time() - strtotime($myarray66[0]); //number of seconds since activity
	$daysdif = floor($timedif / (60*60*24)); //convert to days
	return $daysdif; 
	//return 0;
	}
  }


  
  function getSubmissions($userid,$index,$num, $sortby = null,$dir = 0)
  {
    global $dbprefix;

    $udir = $dir==0?"DESC":"ASC";
    $ddir = $dir==0?"ASC":"DESC";

    $order = "ORDER BY submitted $udir";
    if ($sortby!=null) {
      switch($sortby) {
      case "title":
        $order = "ORDER BY title $ddir";
        break;
      case "quality":
        $order = "ORDER BY quality $udir";
        break;
      case "author":
        $order = "ORDER BY (SELECT concat(lastname,' ',firstname) FROM {$dbprefix}users WHERE id={$dbprefix}submissions.userid) $ddir";
        break;
      case "date":
        $order = "ORDER BY submitted $udir";
        break;
      }
    }

    if ($userid)
        $query = "SELECT * FROM {$dbprefix}submissions WHERE userid='$userid' $order LIMIT $index,$num";
    else
        $query = "SELECT * FROM {$dbprefix}submissions $order LIMIT $index,$num";

    $result = mysql_query($query);
    $numrows = mysql_num_rows($result);
    $data = array();

    while($submission = mysql_fetch_assoc($result)){
    	$submission['abstract']=html_entity_decode($submission['abstract']);
		$id = $submission['id'];
		if ($submission['filename']) {
			$submission['url'] = $this->submissionsUrl.$submission['filename'];
			$submission['filename'] = $this->submissionsPath.$submission['filename'];
	        }
		$user = $this->getUserinfo($submission['userid']);
		if (!$user) continue;	// don't include this is user has been deleted
			$submission['user'] = $user;
	
		//so for this submission id, get the most total number of reviews (where quality >0) for each user.
		$submission['numreviews']=0;
		$myquery = "SELECT distinct(userid) FROM {$dbprefix}reviews WHERE quality > 0 AND submissionid = $id";
		$myresult = mysql_query($myquery);
		$countarray = mysql_fetch_array($myresult);
		$submission['numreviews']+=mysql_num_rows($myresult);
    	
		//and let's get the number of comments too
		//comments are just reviews with no rating, so overallrating would be 0 or NULL
		$submission['numcomments']=0;
		$myquery22 = "SELECT count(*) FROM {$dbprefix}reviews WHERE submissionid = $id AND quality = 0 OR quality IS NULL";
		$myresult22 = mysql_query($myquery22);
		$countarray = mysql_fetch_array($myresult22);
		$submission['numcomments']+=$countarray[0];	  
			
		//and let's get the date of the last discussion
		$myquery44 = "SELECT MAX(date) FROM {$dbprefix}review_commitments WHERE submissionid = $id GROUP BY userid";
		$myresult44 = mysql_query($myquery44);
		if (mysql_num_rows($myresult44)>0) {
			$myarray44 = mysql_fetch_array($myresult44);
			$submission['lastdiscussed']=$myarray44[0];
		}
		else
		{
			$myquery66 = "SELECT submitted FROM {$dbprefix}submissions WHERE id=$id";
			$myresult66 = mysql_query($myquery66);
			$myarray66 = mysql_fetch_array($myresult66);
    		$submission['lastdiscussed']=$myarray66[0];
    	}

		$myquery33 = "SELECT distinct(userid) FROM {$dbprefix}reviews WHERE quality > 0 AND submissionid = $id";
		$myresult33 = mysql_query($myquery33);	
		if($myresult33){ //so if there are any reviews for this particular submissionid
			$totalqual=0;
			$totalapp=0;
			$totalcont=0;
			//$totalrating=0;
			$reviewcount=0;
			while($myline = mysql_fetch_array($myresult33)){ //iterate through all the reviews
			$thisid = $myline['userid'];		     //this is horrible because acm doesn't have mysql5 so no nested queries <-- FUCKING REALLY? WTF ACM.
			//plus note that we're not taking out cancelled reviews here right now.
				//$myquery2 = "SELECT quality, appropriate, controversial, posted FROM {$dbprefix}forum_posts WHERE userid=$thisid and submissionid=$id AND quality>0 ORDER BY posted DESC";
				$myquery2 = "SELECT r.quality, r.appropriate, r.controversial, c.date FROM {$dbprefix}reviews as r, {$dbprefix}review_commitments as c WHERE r.userid=$thisid and r.submissionid=$id AND quality>0 AND c.reviewid = r.id ORDER BY c.date DESC";
				$myresult2 = mysql_query($myquery2);
				if ($myresult2) {
					$myline = mysql_fetch_array($myresult2);
					if ($myline['quality']>0){ //don't include comments in the counts
						//echo ($myline['quality'].", ".$myline['appropriate'].", ".$myline['controversial'].";  ");
						$totalqual += $myline['quality'];
						$totalapp += $myline['appropriate'];
						$totalcont += $myline['controversial'];
						$reviewcount++;
					}
					/*if ($myline['overallrating']>0){ //don't include comments in the counts
						$totalrating += $myline['overallrating'];
						$reviewcount++;
					}*/
				}
			}	
			//echo ("total ratings: ".$totalqual.", ".$totalapp.", ".$totalcont."; ");	
			// If there's time, let's put back the quality, appropriate, and controversial ratings...
			
			$submission['avgtotal']=0;
	        if ($totalqual>0 && $reviewcount>0){
				//echo ("total qual was greater than zero, and so was the number of reviews ");
				$submission['avgqual'] = $totalqual/$reviewcount;
				$submission['avgappr'] = $totalapp/$reviewcount;
				$submission['avgdisc'] = $totalcont/$reviewcount;
				$submission['avgtotal'] = ($totalqual + $totalapp + $totalcont)/$reviewcount;
			}
	        else {
	            $submission['avgqual'] = null;
	            $submission['avgappr'] = null;
				$submission['avgdisc'] = null; 
			}
			//echo ($submission['title'].": ".$submission['avgqual'].", ".$submission['avgappr'].", ".$submission['avgdisc']."<br>");
			/*$submission['avgrating']=0;
			if ($totalrating>0){
				$submission['avgrating'] = $totalrating/$reviewcount;
			}
			else {
				$submission['avgrating'] = null;
			}*/
        }
        $id = $submission['id'];
		$submission['numnewposts'] = $this->getNumNewPosts($id);
		$submission['latestdate'] = $this->getMostRecentActivity($id);
		$data[] = $submission;
    }

	//$newdata = sort($data, numreviews);
    mysql_free_result($result);
	
 //-----------------stuff to deal with sorting by number of reviews-------------------------------
 //a helper for the sorting of the list of submissions in order of number of reviews
  function compareNumReview ($a, $b) {
	if($a["numreviews"] == $b["numreviews"]){
		return 0;
	}else {
		return ($a["numreviews"] < $b["numreviews"]) ? -1 : 1;
	}
  }  
 //a helper for the sorting of the list of submissions in order of number of reviews
  function compareNumReviewDesc ($b, $a) {
	if($a["numreviews"] == $b["numreviews"]){
		return 0;
	}else {
		return ($a["numreviews"] < $b["numreviews"]) ? -1 : 1;
	}
  }  	
	if($sortby=="numreviews" && $dir==0){
		usort($data, 'compareNumReview');
	}elseif($sortby=="numreviews" && $dir==1){
		usort($data, 'compareNumReviewDesc');
	}

	//---------------stuff to deal with sorting by total score------------------------------------------
  //a helpder for sorting the list of submissions by total score
  function compareTotal ($a, $b) {
	if($a["avgtotal"] == $b["avgtotal"])
		return 0;
	else 
		return ($a["avgtotal"] > $b["avgtotal"]) ? -1 : 1;
  }  
	if($sortby=="total") //we don't care about direction, really.
		usort($data, 'compareTotal');

    return $data;
  }

  function getTopratedSubmissions($num)
  {
    global $dbprefix;

    $query = "SELECT * FROM {$dbprefix}submissions WHERE averagerating IS NOT NULL AND hidden='0' ORDER BY averagerating DESC LIMIT 0,$num";
    $result = mysql_query($query);
    if (!$result) return array();

    $data = array();

    while($row = mysql_fetch_assoc($result))
    {
      $data[] = $row;
    }

    mysql_free_result($result);

    return $data;
  }

  function deleteSubmission($submissionid,$byid)
  
    /*
  XXX 2013 XXX Will need to alter this to accommodated db changes for additional authors.
  */
  
  {
    global $dbprefix;

    $submission = $this->getSubmission($submissionid);
    $query = "DELETE FROM {$dbprefix}submissions WHERE id='$submissionid'";
    mysql_query($query);

    $reviews = $this->getReviews($submissionid);
	if ($reviews != null)
	{
      foreach($reviews as $review)
        $this->deleteReview($review[id],$byid);
	}
    $id = $submission['id'];
    $userid = $submission['userid'];
    $title = $submission['title'];
	
	  /*
  XXX 2013 XXX Will need to alter this to accommodated db changes for additional authors.
  */
  
    $authors = $submission['additionalauthors'];
    //$type = $submission['type'];
    $abstract_ = $submission['abstract'];
    $filename = $submission['filename'];
    $filesize = $submission['filesize'];
    $link = $submission['link'];
	$history = $submission['history'];
	$videolink = $submission['videolink'];
	$comments = $submission['comments'];
    $submitted = $submission['submitted'];
    //$forumthreadid = $submission['forumthreadid'];
    $deleted = date("Y-m-d H:i:s");

      /*
  XXX 2013 XXX Will need to alter this to accommodated db changes for additional authors.
  */

     //$query = "INSERT INTO {$dbprefix}deleted_submissions (id,userid,title,additionalauthors,abstract,filename,filesize,link,history,videolink,comments,submitted,forumthreadid,deleted,deletedby) VALUES ('$id','$userid','$title','$authors','$abstract_','$filename','$filesize','$link','$history','$videolink','$comments','$submitted','$forumthreadid','$deleted','$byid')";
	 $query = "INSERT INTO {$dbprefix}deleted_submissions (id,userid,title,additionalauthors,abstract,filename,filesize,link,history,videolink,comments,submitted,deleted,deletedby) VALUES ('$id','$userid','$title','$authors','$abstract_','$filename','$filesize','$link','$history','$videolink','$comments','$submitted','$deleted','$byid')";
    mysql_query($query);

    $this->log("submissions","delete","$id, $title");

    $this->removeSearchWords("submissions","$submissionid");
  }

  /*
  function setSubmissionThread($submissionid,$threadid)
  {
    global $dbprefix;

    $query = "UPDATE {$dbprefix}submissions SET forumthreadid='$threadid' WHERE id='$submissionid'";
    return mysql_query($query);
  }
*/

  // ...
  // submission-review commitments
  //

  function setReviewCommitment( $userid, $submissionid )
  {
	global $dbprefix;
    if ($this->hasCommitted($userid,$submissionid)) return false;
    $date = date("Y-m-d H:i:s");
    $query = "INSERT INTO {$dbprefix}review_commitments (userid,submissionid,date) VALUES ('$userid','$submissionid','$date')";
    mysql_query($query);
  }

  function hasCommitted( $userid, $submissionid )
  {
	global $dbprefix;
    $query = "SELECT * FROM {$dbprefix}review_commitments WHERE userid='$userid' AND submissionid='$submissionid'";
    $result = mysql_query($query);
    return mysql_num_rows($result)>0;
  }

  function removeReviewCommitment( $userid, $submissionid )
  {
	global $dbprefix;
    $query = "DELETE FROM {$dbprefix}review_commitments WHERE userid='$userid' AND submissionid='$submissionid'";
    return mysql_query($query);
  }

  function checkCommitmentAndSetReview( $reviewid )
  {
    global $dbprefix;

    $review = $this->getReview( $reviewid );
    if (!$review) return false;

    $userid = $review['userid'];
    $submissionid = $review['submissionid'];
/*    $query = "SELECT id FROM {$dbprefix}review_commitments WHERE submissionid='$submissionid' AND userid='$userid'";
    $result = mysql_query($query);
    if (mysql_num_rows($result)>0)
    {
      $row = mysql_fetch_row($result);
      $id = $row[0];

      $query = "UPDATE {$dbprefix}review_commitments SET reviewid='$reviewid' WHERE id='$id'";
      mysql_query($query);
    }
    mysql_free_result($result);
*/

    $query = "UPDATE {$dbprefix}review_commitments SET reviewid='$reviewid' WHERE userid='$userid' AND submissionid='$submissionid'";
    mysql_query($query);

    return true;
  }

  function getCommittedUsers( $submissionid )
  {
	global $dbprefix;
    $query = "SELECT * FROM {$dbprefix}review_commitments WHERE submissionid='$submissionid' AND reviewid is NULL";
    $result = mysql_query($query);

    $data = array();
    while($row = mysql_fetch_assoc($result))
    {
      $row['user'] = $this->getUserinfo($row['userid']);
      $data[] = $row;
    }
    mysql_free_result($result);

    return $data;
  }

  function getCommittedSubmissions( $userid )
  {
	global $dbprefix;
    $query = "SELECT * FROM {$dbprefix}review_commitments WHERE userid='$userid' AND reviewid is NULL";
    $result = mysql_query($query);

    $data = array();
    while($row = mysql_fetch_assoc($result))
    {
      $row['submission'] = $this->getSubmission($row['submissionid']);
      $data[] = $row;
    }
    mysql_free_result($result);

    return $data;
  }

  function getCommitments( $sortby="submission" )
  {
	global $dbprefix;
    $query = "SELECT rc.* FROM {$dbprefix}review_commitments rc";
    switch($sortby)
    {
    case "submission":
      $query .= ", {$dbprefix}submissions subs WHERE rc.submissionid=subs.id ORDER BY subs.title ASC";
      break;
    case "user":
      $query .= ", {$dbprefix}users usr WHERE rc.userid=usr.id ORDER BY CONCAT(usr.lastname,usr.firstname) ASC";
      break;
    }

    $result = mysql_query($query);

    $data = array();
    while($row = mysql_fetch_assoc($result))
    {
      $row['user'] = $this->getUserinfo($row['userid']);
      $row['submission'] = $this->getSubmission($row['submissionid']);
      $data[] = $row;
    }
    mysql_free_result($result);

    return $data;
  }

  // find submissions based on matching items
  //
  // ex. findSubmissions(array( "forumthreadid" => $threadid ))
  //
  function findSubmissions($vals)
  {
    global $dbprefix;
    $query = "SELECT * FROM {$dbprefix}submissions WHERE";
    foreach($vals as $field => $value)
    {
      $query.= " $field='$value'";
    }

    $result = mysql_query($query);
    $data = array();
    while($row = mysql_fetch_assoc($result))
    {
      $data[] = $row;
    }
    mysql_free_result($result);
    return $data;
  }

  function expertiseToFactor($expertise)
  {
    global $dbprefix;

    switch($expertise)
    {
    case 1: return 0.5;
    case 2: return 0.75;
    case 3: return 1;
    case 4: return 1.25;
    default: return 0;
    }
  }

  function calcAndSetSubmissionRating($submissionid)
  {
    global $dbprefix;

    $reviews = $this->getReviews($submissionid);
    if (!$reviews) return false;

    $rating = 0.0;
    foreach($reviews as $review)
    {
//      $rating+=$review['overallrating']*$this->expertiseToFactor($review['expertise']);
      $rating+=$review['quality'];
    }

    if (count($reviews)>0)
      $rating/=count($reviews);

    if (count($reviews)==0)
      $query = "UPDATE {$dbprefix}submissions SET averagerating=NULL WHERE id='$submissionid'";
    else
      $query = "UPDATE {$dbprefix}submissions SET averagerating='$rating' WHERE id='$submissionid'";
    return mysql_query($query);
  }

  //
  // reviews
  //
  function findReview($userid,$submissionid)
  {
    global $dbprefix;

    $query = "SELECT * FROM {$dbprefix}reviews WHERE userid='$userid' AND submissionid='$submissionid'";
    $result = mysql_query($query);
    $row = mysql_fetch_assoc($result);
    mysql_free_result($result);
    return $row;
  }

  function getReviews($submissionid)
  {
    global $dbprefix;
    
    if ($submissionid)
		$query = "SELECT * FROM {$dbprefix}reviews WHERE submissionid='$submissionid' ORDER BY submitted DESC";
    else
      $query = "SELECT revs.* FROM {$dbprefix}reviews as revs, {$dbprefix}submissions as subs WHERE revs.submissionid=subs.id ORDER BY subs.query($query);    
    $data = array()averagerating, subs.id DESC";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
    {
      $row['user'] = $this->getUserinfo($row['userid']);
      if (!$row['user']) continue; // don't include if user not exists
      $reviewid = $row['id'];
      //blooody hell.  ok, i'm commenting out.  no stars for anyone.
      // set stars
      $row['stars'] = $this->getNumReviewStars($reviewid);
      $data[] = $row;
	  
	  //call to see if this is the most recent review
	  
	  
	  
    }
    mysql_free_result($result);
    return $data;
  }

  /*function getNumCommentsSinceLastComment($userid, $submissionid)
  {
  global $dbprefix;
 
  //figure out the last time they posted
  $q = "SELECT MAX(posted) FROM {$dbprefix}forum_posts WHERE userid=$userid AND submissionid=$submissionid";
  $r = mysql_query($q);
  $da = mysql_fetch_array($r);
  $d = $da[0];
  
  //figure out the number of comments since then.  damn you acm for not having MySQL v5+.
  $q2 = "SELECT COUNT(*) FROM {$dbprefix}forum_posts WHERE submissionid=$submissionid AND posted>$d";
  $r2 = mysql_query($q2);
  if ($r2)
  	{
	  $countarray = mysql_fetch_array($r2);
	  return $countarray[0];
	 }
  else
  	return 0;
  
  }*/


  function getUserReviews($userid)
  {
    global $dbprefix;

//    $query = "SELECT id, submissionid, userid, post, MAX(posted), edited, expertise, quality, qualitytext, appropriate, appropriatetext, controversial, controversailtext FROM {$dbprefix}forum_posts WHERE userid='$userid' GROUP BY submissionid ORDER BY posted DESC";

    //$query = "SELECT id, submissionid, userid, MAX(posted), quality, appropriate, controversial, posted  FROM {$dbprefix}forum_posts WHERE userid=".$userid." GROUP BY submissionid ORDER BY posted DESC";
	
	$query = "SELECT r.id, r.submissionid, r.userid, MAX(c.date), r.quality, r.appropriate, r.controversial, r.expertise, c.date FROM {$dbprefix}reviews AS r, {$dbprefix}review_commitments AS c WHERE r.userid='$userid' AND c.reviewid=r.id GROUP BY submissionid ORDER BY date DESC";
	// want date on review_commitments from this review_id -- no longer have posted
	/* replace "quality, appropriate, controverisal with overallrating and expertise"*/
	
    $result = mysql_query($query);



    $data = array();

    while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
    {
      $row['submission'] = $this->getSubmission($row['submissionid']);
      // set stars
      //$row['stars'] = $this->getNumReviewStars($reviewid);
      $row['latestdate'] = $this->getMostRecentActivity($row['submissionid']);
      //$row['commentcount'] = $this->getNumCommentsSinceLastComment($userid, $row['submissionid']);


      $data[] = $row;
    }

    mysql_free_result($result);

    return $data;
  }

  function getReview($reviewid)
  {
    global $dbprefix;

    $query = "SELECT * FROM {$dbprefix}reviews WHERE id='$reviewid'";
    $result = mysql_query($query);

    $row = mysql_fetch_array($result,MYSQL_ASSOC);

    mysql_free_result($result);

    $row['user'] = $this->getUserinfo($row['userid']);
    $row['submission'] = $this->getSubmission($row['submissionid']);

    // set stars
    $row['stars'] = $this->getNumReviewStars($reviewid);

    return $row;
  }

/* prob have to fix this -- overall rating shouldn't be there anymore? */
  function submitReview($userid,$submissionid, $expertise,$overallrating, $summary, $review, $relationship, $quality, $qualitytext, $appropriate, $appropriatetext, $controversial, $controversialtext)
  {
    global $dbprefix;

    $date = date("Y-m-d H:i:s");
    $query = "INSERT INTO {$dbprefix}reviews ".
      "(id,userid,submissionid,expertise,overallrating,summary,review,relationship,submitted,quality,qualitytext,appropriate,appropriatetext,controversial,controversialtext)".
      "VALUES ('','$userid','$submissionid','$expertise','$overallrating','".
      mysql_real_escape_string($summary)."','".
      mysql_real_escape_string($review)."','".
      mysql_real_escape_string($relationship)."',".
      "'$date')";
      //      "'$quality','".
      //mysql_real_escape_string($qualitytext)."',".
      //"'$appropriate','".
      //mysql_real_escape_string($appropriatetext)."','".
      //"$controversial','".
      //mysql_real_escape_string($controversialtext)."')";

    if (!mysql_query($query))
      {
	echo "there was a mysql error submitting the review: ".mysql_error();
	return false;
      }

    $id = mysql_insert_id();

    $this->log("reviews","submit","$id,$submissionid");

    $this->calcAndSetSubmissionRating($submissionid);

    $user = $this->getUserinfo($userid);

    // parse for search words
    $this->parseForSearchWords($summary,"reviews","$id");
    $this->parseForSearchWords($user['firstname']." ".$user['lastname'],"reviews","$id");

    // increase num reviews
    $query = "UPDATE {$dbprefix}submissions SET numreviews=numreviews+1 WHERE id='$submissionid'";
    if (!mysql_query($query))
      echo "error in increase num reviews: ".mysql_error();
    

    $this->checkCommitmentAndSetReview( $id );

    return $id;
  }

  function updateReview($id,$expertise,$rating,$summary,$reviewtext,$relationship)
  {
    global $dbprefix;

    if (!$id||!$expertise||!$rating||!$summary||!$reviewtext) return false;

    $review = $this->getReview($id);
    if (!$review) return false;

    $editdate = date("Y-m-d H:i:s");

    $query = "UPDATE {$dbprefix}reviews SET expertise='$expertise',overallrating='$rating',summary='$summary',review='$reviewtext',relationship='$relationship',edited='$editdate' WHERE id='$id'";
    if (mysql_query($query))
    {
      $this->log("reviews","update","$id");
      $this->calcAndSetSubmissionRating($review['submissionid']);

      // parse for search words
      $this->parseForSearchWords($summary,"reviews","$id");
      $this->parseForSearchWords($review['user']['firstname']." ".$review['user']['lastname'],"reviews","$id");

      return true;
    }
    return false;
  }

  function deleteReview($reviewid,$byid)
  {
    global $dbprefix;

    $review = $this->getReview($reviewid);
    $query = "DELETE FROM {$dbprefix}reviews WHERE id='$reviewid'";
    if (!mysql_query($query)) return false;

    $query = sprintf("INSERT INTO {$dbprefix}deleted_reviews (id,userid,submissionid,expertise,overallrating,summary,review,relationship,submitted,edited,deleted,deletedby) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",$review['id'],$review['userid'],$review['submissionid'],$review['expertise'],$review['overallrating'],$review['summary'],$review['review'],$review['relationship'],$review['submitted'],$review['edited'],date("Y-m-d H:i:s"),$byid);
    mysql_query($query);

    $this->log("reviews","delete","$reviewid");

    $this->calcAndSetSubmissionRating($review['submissionid']);

    // decreaswe num reviews
    $query = "UPDATE {$dbprefix}submissions SET numreviews=numreviews-1 WHERE id='" . $review['submissionid'] . "'";
    mysql_query($query);

    return true;
  }

  function hasUserReviewed($userid,$submissionid)
  {
    global $dbprefix;

    $query = "SELECT count(*) FROM {$dbprefix}reviews WHERE userid='$userid' AND submissionid='$submissionid'";
    $result = mysql_query($query);
    $row = mysql_fetch_row($result);
    mysql_free_result($result);
    if ($row[0]>0) return true;
    else return false;
  }

  function getTopReviewers($num)
  {
    global $dbprefix;

    $query = "SELECT u.* FROM {$dbprefix}users u, (SELECT count(*) AS cnt,{$dbprefix}users.id id FROM {$dbprefix}users,{$dbprefix}review_stars t1,{$dbprefix}reviews t2 WHERE t1.reviewid=t2.id AND t2.userid={$dbprefix}users.id GROUP BY t2.userid) c WHERE u.id=c.id ORDER BY c.cnt DESC LIMIT 0,$num";
    $result = mysql_query($query);
    if (!$result) return array();

    $data = array();
    while($row = mysql_fetch_assoc($result))
    {
      $data[] = $row;
    }
    mysql_free_result($result);

    return $data;
  }

  //
  // Users
  //
  function getNumUsers()
  {
    global $dbprefix;

    $query = "SELECT COUNT(*) FROM {$dbprefix}users";
    $result = mysql_query($query);
    $row = mysql_fetch_row($result);
    mysql_free_result($result);
    return $row[0];
  }

  function getUsers($index,$num)
  {
    global $dbprefix;

    $query = "SELECT * FROM {$dbprefix}users LIMIT $index,$num";
    $result = mysql_query($query);

    $data = array();
    while($row = mysql_fetch_assoc($result))
    {
      $data[] = $row;
    }

    return $data;
  }

  function deleteUser($userid)
  {
    global $dbprefix;

    if ($userid == $this->userid) return false;

    $user = $this->getUserinfo($userid);

    $query = "DELETE FROM {$dbprefix}users WHERE id='$userid'";
    if (mysql_query($query))
    {
      $this->log("users","delete","$userid,".$user['user']);
      return true;
    }
    else
      return false;
  }

  //
  // stars! * * * * *
  //
  function assignStarToReview($reviewid)
  {
    global $dbprefix;

    $review = $this->getReview($reviewid);
    if (!$review) return false;

    // should not allow assigning star to your own work.
    if ($review['userid']==$userid)
    {
      return false;
    }

    $query = "SELECT count(*) c FROM {$dbprefix}review_stars WHERE reviewid='$reviewid' AND userid='" . $this->userid . "'";
    $result = mysql_query($query);
    if (mysql_result($result,0,'c')==0)
    {
      $query = "INSERT INTO {$dbprefix}review_stars (reviewid,userid) VALUES ('$reviewid','" . $this->userid . "')";
      return mysql_query($query);
    }

    return true;
  }

  function removeStarFromReview($reviewid)
  {
    global $dbprefix;

    if (!$this->getReview($reviewid)) return false;

    $userid = $this->userid;
    $query = "DELETE FROM {$dbprefix}review_stars WHERE reviewid='$reviewid' AND userid='$userid'";
    return mysql_query($query);
  }

  function getNumReviewStars($reviewid)
  {
    global $dbprefix;

    $query = "SELECT count(*) FROM {$dbprefix}review_stars WHERE reviewid='$reviewid'";
    $result = mysql_query($query);
    $row = mysql_fetch_row($result);
    $num = $row[0];
    mysql_free_result($result);
    return $num;
  }

  function userPutStar($userid,$reviewid)
  {
    global $dbprefix;

    $query = "SELECT count(*) c FROM {$dbprefix}review_stars WHERE reviewid='$reviewid' AND userid='$userid'";
    $result = mysql_query($query);
    if (mysql_result($result,0,'c')==0)
      return false;
    else
      return true;
  }

  //
  // log
  //
  function log($category,$event,$details)
  {
    global $dbprefix;

    $time = date("Y-m-d H:i:s");
    $userid = $this->userid;
    $query = "INSERT INTO {$dbprefix}log (category,event,details,userid,time) VALUES ('$category','$event','$details','$userid','$time')";
    return mysql_query($query);
  }

  function getLogs()
  {
    global $dbprefix;

    $query = "SELECT * FROM {$dbprefix}log";
    $result = mysql_query($query);
    $data=array();
    while($row = mysql_fetch_assoc($result))
    {
      $data[] = $row;
    }
    mysql_free_result($result);
    return $data;
  }
  
  function getBugs()
  {
	global $dbprefix;

    $query = "SELECT * FROM {$dbprefix}bugs";
    $result = mysql_query($query);
    $data=array();
    while($row = mysql_fetch_assoc($result))
    {
      $data[] = $row;
    }
    mysql_free_result($result);
    return $data;
  }

  //
  // searching
  //
  function parseForSearchWords($text,$location,$id)
  {
    global $dbprefix;

    $text = ereg_replace("(\\,|\\.|\\!|\\?|\n|\(|\))"," ",$text);
    $words = explode(" ",$text);
    foreach($words as $word)
    {
      if (strlen($word)<3) continue;

//      echo $word."<br>\n";

      $query = "INSERT INTO {$dbprefix}searchwords (word,location,id) VALUES ('$word','$location','$id')";
      mysql_query($query);
    }
  }

  function removeSearchWords($location,$id)
  {
    global $dbprefix;

    $query = "DELETE FROM {$dbprefix}searchwords WHERE location='$location',id='$id'";
    return mysql_query($query);
  }

  function search($words)
  {
    global $dbprefix;

    $str = $words;
//    $query = "SELECT word,location,id FROM searchwords WHERE MATCH (word) AGAINST ('$str') GROUP BY location,id";
    $words = explode(" ",$words);
    for($i=0;$i<count($words);$i++) $words[$i] = "'".$words[$i]."'";
    $str = implode(" OR word=",$words);
    $query = "SELECT location,id FROM {$dbprefix}searchwords WHERE word=$str GROUP BY location,id";
    $result = mysql_query($query);

    $data = array();
    while($row = mysql_fetch_assoc($result))
    {
      $data[] = $row;
    }
    mysql_free_result($result);

    return $data;
  }

  function bugSubmitReport($text)
  {
    global $dbprefix;

    $userid = $this->userid;
    $query = "INSERT INTO {$dbprefix}bugs (text,status,userid) VALUES ('$text','submitted','$userid')";
    mysql_query($query);
  }

  function mailAll($subject,$content)
  {
    global $dbprefix;

    if (!$subject || !$content) return false;

    $mail = new PHPMailer();

    if (!$mail) return false;

    $mail->IsSMTP();
    $mail->Host = "localhost";
    //$mail->SMTPAuth = true;
    //$mail->Username = "noreply";
    //$mail->Password = "8ouq2abr";

    $mail->From = "altchi@chi2012.acm.org";
    $mail->FromName = "alt.chi 2012";
//    $mail->AddAddress($user['email'],$user['firstname']." ".$user['lastname']);

// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// add mailaddresses here!
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    $query = "SELECT firstname,lastname,email FROM {$dbprefix}users";
    $result = mysql_query($query);
    while($row = mysql_fetch_assoc($result))
    {
      $mail->AddBCC($row['email'],$row['firstname']." ".$row['lastname']);
    }
    mysql_free_result($result);
//    $mail->AddReplyTo("noreply@acm.org","No reply");

    $mail->IsHTML(false);

    $mail->Subject = $subject;
    $mail->Body = $content;

    if ($mail->Send())
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  
  function userHasPermission($perm, $userid=false)
  {
	global $dbprefix;

	if (!$userid)
		$userid = $this->userid;

	$query = "SELECT permission,value FROM {$dbprefix}userpermissions WHERE userid='$userid'";
	$result = mysql_query($query);

	if ($row = mysql_fetch_assoc($result))
	{
		return $row['value']=='y';
	}

	return false;
  }
  
  function assignUserToReview($submissionid, $userid)
  {
	global $dbprefix;

	$now = date("Y-m-d H:i:s");

	$query = "SELECT * FROM {$dbprefix}review_assignments WHERE submissionid='$submissionid' AND userid='$userid'";
	$result = mysql_query($query);
	if ($row = mysql_fetch_assoc($result))	// if exists then increase reminders
	{
		$reminders = $row['reminders'] + 1;
		$query = "UPDATE {$dbprefix}review_assignments SET reminders='$reminders' WHERE submissionid='$submissionid' AND userid='$userid'";
		if (!mysql_query($query)) return false;
	}
	else
	{
		$query = "INSERT INTO {$dbprefix}review_assignments (submissionid,userid,time_assigned,reminders) VALUES ('$submissionid','$userid','$now','0')";
		if (!mysql_query($query)) return false;
	}
	return true;
  }
  
  function getReviewAssignedUsers($submissionid)
  {
	global $dbprefix;
	
	$query = "SELECT * FROM {$dbprefix}review_assignments WHERE submissionid='$submissionid'";
    $result = mysql_query($query);
    $data=array();
    while($row = mysql_fetch_assoc($result))
    {
		$userid = $row['userid'];
		$user = $this->getUserinfo($userid);
		$data[] = $user;
    }
    mysql_free_result($result);
    return $data;
  }
  
  function getUserEmail($identifier)
  {
	global $dbprefix;

	$userid = $this->userid;
	
	$query = "SELECT email FROM {$dbprefix}user_emails WHERE userid='$userid' AND identifier='$identifier'";
	$result = mysql_query($query);
	if ($row = mysql_fetch_assoc($result))
	{
		return $row['email'];
	}
	return "";
  }
  
  function setUserEmail($identifier,$email)
  {
	global $dbprefix;
	$userid = $this->userid;
	
	$sqlemail = mysql_real_escape_string($email);

	$query = "SELECT * FROM {$dbprefix}user_emails WHERE userid='$userid' AND identifier='$identifier'";
	$result = mysql_query($query);
	if (mysql_num_rows($result)>0)
	{
		$query = "UPDATE {$dbprefix}user_emails SET email='$sqlemail' WHERE userid='$userid' AND identifier='$identifier'";
	}
	else
	{
		$query = "INSERT INTO {$dbprefix}user_emails (userid,identifier,email) VALUES ('$userid','$identifier','$sqlemail')";
	}
	mysql_query( $query );
  }
}

?>
