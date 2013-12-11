<?php

define('SUBMISSIONDISCUSSIONCATEGORY',3);

class Forum
{
  var $system = null;

  function Forum($system)
  {
    $this->system = $system;
  }


  function getCategory($categoryid)
  {
    global $dbprefix;

    $query = "SELECT * FROM {$dbprefix}forum_categories WHERE id='$categoryid'";
    $result = mysql_query($query);

    $row = mysql_fetch_assoc($result);
    mysql_free_result($result);

    return $row;
  }

  function getCategories()
  {
    global $dbprefix;

    $query = "SELECT * FROM {$dbprefix}forum_categories ORDER BY id";
    $result = mysql_query($query);

    $data = array();

    $since = $this->system->lastlogin;

    while($row = mysql_fetch_assoc($result))
    {
      // get number of new posts since last logged in. ($since comes from $_SESSION['lastlogin'])
      $catid = $row['id'];
      $q = "SELECT count(*) FROM {$dbprefix}forum_categories cat,{$dbprefix}forum_threads thr,{$dbprefix}forum_posts pos WHERE cat.id='$catid' AND thr.categoryid=cat.id AND pos.submissionid=thr.id AND pos.posted>'$since'";
      $r = mysql_query($q);
      $w = mysql_fetch_row($r);
      $row['newposts'] = $w[0];

      $data[] = $row;
    }

    mysql_free_result($result);

    return $data;
  }

  function getThread($submissionid)
  {
    global $dbprefix;

    $query = "SELECT * FROM {$dbprefix}forum_threads WHERE id='$submissionid'";
    $result = mysql_query($query);
    if (!$result||mysql_num_rows($result)==0) return false;

    $row = mysql_fetch_assoc($result);
    mysql_free_result($result);

    $row['user'] = $this->system->getUserinfo($row['userid']);

    return $row;
  }

  function getThreads($categoryid,$index,$shownum)
  {
    global $dbprefix;

    $query = "SELECT * FROM {$dbprefix}forum_threads WHERE categoryid='$categoryid' ORDER BY last_posted DESC LIMIT $index,$shownum";
    $result = mysql_query($query);

    $data = array();

    $since = $this->system->lastlogin;

    while($row = mysql_fetch_assoc($result))
    {
      $row['user'] = $this->system->getUserinfo($row['userid']);

      // get number of new posts since last logged in
      $submissionid = $row['id'];
      $q = "SELECT count(*) FROM {$dbprefix}forum_threads thr,{$dbprefix}forum_posts pos WHERE thr.id='$submissionid' AND pos.submissionid=thr.id AND pos.posted>'$since'";
      $r = mysql_query($q);
      $w = mysql_fetch_row($r);
      $row['newposts'] = $w[0];

      $data[] = $row;
    }

    mysql_free_result($result);

    return $data;
  }

  function getNumThreads($categoryid)
  {
    global $dbprefix;

    $query = "SELECT COUNT(*) FROM {$dbprefix}forum_threads WHERE categoryid='$categoryid'";
    $result = mysql_query($query);
    $row = mysql_fetch_row($result);
    mysql_free_result($result);
    return $row[0];
  }

  function getPost($postid)
  {
    global $dbprefix;

    $query = "SELECT * FROM {$dbprefix}reviews WHERE id='$postid'";
    $result = mysql_query($query);

    $row = mysql_fetch_assoc($result);
    mysql_free_result($result);

    $row['user'] = $this->system->getUserinfo($row['userid']);

    return $row;
  }
  
  function isReview($postid)
  {
    global $dbprefix;
    
    $query = "SELECT quality FROM {$dbprefix}reviews WHERE id='$postid'";
    $result = mysql_query($query);    
    $qualityarray = mysql_fetch_array($result);
   
    if ($qualityarray[0]>0)
    	return true;
    else
    	return false;
  }
  
  function isMostCurrentReview($postid, $postauthorid, $submissionid) 
  {
       global $dbprefix;

	   
	   $query="SELECT c.date, MAX(r.id) as id FROM {$dbprefix}reviews as r, {$dbprefix}review_commitments as c WHERE r.quality > 0 and r.userid = '$postauthorid' and r.submissionid = '$submissionid' GROUP BY r.submissionid, r.userid";
	   
       $result = mysql_query($query);
       //print mysql_error();
       $myarray = mysql_fetch_array($result);
  
       if ($myarray['id'] == $postid)
          return "true";
       else
          return "false";
  }
  

  function getPosts($submissionid,$index,$shownum)
  {
    global $dbprefix;
    //$query = "SELECT * FROM {$dbprefix}forum_posts WHERE submissionid='$submissionid' ORDER BY posted ASC LIMIT $index,$shownum";
	$query = "SELECT r.*, c.date FROM {$dbprefix}reviews as r, {$dbprefix}review_commitments as c WHERE r.submissionid='$submissionid' AND c.reviewid=r.id ORDER BY c.date ASC LIMIT $index,$shownum";
    $result = mysql_query($query);
    $data = array();
	if ($result != null)
	{
    while($row = mysql_fetch_assoc($result)) {
      $row['user'] = $this->system->getUserinfo($row['userid']);
      $row['isCurrentReview'] = $this->isMostCurrentReview($row['id'],$row['userid'],$row['submissionid']);
      $data[] = $row;
	  //print "<br>review: ".$row['summary'];
	  //print "<br>$submissionid:".$row['isCurrentReview'];
    }
    mysql_free_result($result);
	}
    return $data;
  }

 function getAllReviews()
  {
    global $dbprefix;
    //$query = "SELECT * FROM {$dbprefix}forum_posts ORDER BY posted ASC";
	$query = "SELECT r.*, c.date FROM {$dbprefix}reviews as r, {$dbprefix}review_commitments as c WHERE c.reviewid=r.id ORDER BY MAX(c.date) ASC";
    $result = mysql_query($query);
    $data = array();
    while($row = mysql_fetch_assoc($result)) {
      $row['user'] = $this->system->getUserinfo($row['userid']);
      $row['isCurrentReview'] = $this->isMostCurrentReview($row['id'],$row['userid'],$row['submissionid']);
      $data[] = $row;
	  //print "<br>$submissionid:".$row['isCurrentReview'];
    }
    mysql_free_result($result);
    return $data;
  }
  
  function getNumPosts($submissionid)
  {
    global $dbprefix;

    //$query = "SELECT COUNT(*) FROM {$dbprefix}forum_posts WHERE submissionid='$submissionid'";
	$query = "SELECT COUNT(*) FROM {$dbprefix}reviews WHERE submissionid='$submissionid'";
    $result = mysql_query($query);
    $row = mysql_fetch_row($result);
    mysql_free_result($result);
    return $row[0];
  }

  function addCategory($userid,$name,$description)
  {
    global $dbprefix;

    $created = date("Y-m-d H:i:s");
    $query = "INSERT INTO {$dbprefix}forum_categories (name,description,userid,created) VALUES ('$name','$description','$userid','$created')";
    if (!mysql_query($query)) return false;

    $id = mysql_insert_id();

    $this->system->log("forum","add category","$id,$name");

    return $id;
  }

  /*function addThread($submissionid, $userid,$categoryid,$subject,$link)
  {
    global $dbprefix;

    $started = date("Y-m-d H:i:s");
    $query = "INSERT INTO {$dbprefix}forum_threads (submissionid, categoryid,userid,subject,started,link) VALUES('$submissionid','$categoryid','$userid','$subject','$started','$link')";
    if (mysql_query($query))
    {
      $id = mysql_insert_id();
      $this->system->log("forum","add thread","$id,$categoryid,$subject");
      return $id;
    }
    else
    {
      return false;
    }
  }*/

  function addPost($userid,$submissionid,$post,$qual,$qualtext,$app,$apptext,$cont,$conttext)
  {
    global $dbprefix;
	
	$this->system->log("forum","add post","in add post function");

    $posted = date("Y-m-d H:i:s");

    $post = $this->fmlToHTML($post);

    $query = "INSERT INTO {$dbprefix}reviews (submissionid,userid,quality,qualitytext,appropriate,appropriatetext,controversial,controversialtext,review) VALUES('$submissionid','$userid','$qual','$qualtext','$app','$apptext','$cont','$conttext','$post')";
	
	if (mysql_query($query))
    {
	  print mysql_error();
      $id = mysql_insert_id();

      //$query = "UPDATE {$dbprefix}forum_threads SET last_posted='$posted' WHERE id='$submissionid'";
      //mysql_query($query);
	  //print mysql_error();
	  
	  $query = "INSERT INTO {$dbprefix}review_commitments (userid,submissionid, date, reviewid) VALUES ('$userid','$submissionid','$posted','$id')";
	  mysql_query($query);
	  print mysql_error();

      $this->system->log("forum","add post","$id,$submissionid");

      return $id;
    }
    else
    {
	  $this->system->log("forum","add post","failed to add post");
      return false;
    }
  }

  /*function addPost($userid,$submissionid,$post)
  {
    global $dbprefix;

    $posted = date("Y-m-d H:i:s");

    $post = $this->fmlToHTML($post);

    $query = "INSERT INTO {$dbprefix}reviews (submissionid,userid) VALUES('$submissionid','$userid')";
    if (mysql_query($query))
    {
      $id = mysql_insert_id();

      $query = "UPDATE {$dbprefix}forum_threads SET last_posted='$posted' WHERE id='$submissionid'";
      mysql_query($query);
	  
	  $query = "INSERT INTO {$dbprefix}review_commitments (userid,submissionid, date, reviewid) VALUE ('$userid','$submissionid','$posted','$id')";
	  mysql_query($query);

      $this->system->log("forum","add post","$id,$submissionid");

      return $id;
    }
    else
    {
      return false;
    }
  } */
  
  function editPost($postid,$post)
  {
    global $dbprefix;

    $edited = date("Y-m-d H:i:s");
    $post = $this->fmlToHTML($post);

    $query = "UPDATE {$dbprefix}reviews SET review='$post', edited='$edited' WHERE id='$postid'";
    return mysql_query($query);
  }

/*  
  function deleteCategory($categoryid)
  {
    global $dbprefix;

    $query = "DELETE FROM {$dbprefix}forum_categories WHERE id='$categoryid'";
    mysql_query($query);
    $query = "DELETE FROM {$dbprefix}forum_threads,{$dbprefix}forum_posts USING {$dbprefix}forum_threads,{$dbprefix}forum_posts WHERE {$dbprefix}forum_threads.categoryid='$categoryid' AND {$dbprefix}forum_posts.submissionid={$dbprefix}forum_threads.id";
    mysql_query($query);

    $this->system->log("forum","delete category","$categoryid");
  }
*/

  function deleteThread($submissionid)
  {
    global $dbprefix;

    //$query = "DELETE FROM {$dbprefix}forum_threads WHERE id='$submissionid'";
    //mysql_query($query);
    $query = "DELETE FROM {$dbprefix}forum_posts WHERE submissionid='$submissionid'";
    mysql_query($query);
	$query = "DELETE FROM ($dbprefix}reviews WHERE submissionid='$submissionid'";
	mysql_query($query);

    $this->system->log("forum","delete thread","$submissionid");
  }

  function deletePost($postid, $userid)
  {
    global $dbprefix;

    $query = "DELETE FROM {$dbprefix}forum_posts WHERE id='$postid'";
    mysql_query($query);
	
	$deleted = date("Y-m-d H:i:s");
	$query = "INSERT INTO {$dbprefix}deleted_reviews (id,userid,submissionid,expertise,quality,qualitytext,appropriate,appropriatetext,controversial,controversialtext,summary,review,relationship,submitted,edited) SELECT id,userid,submissionid,expertise,quality,qualitytext,appropriate,appropriatetext,controversial,controversialtext,summary,review,relationship,submitted,edited FROM {$dbprefix}reviews WHERE id='$postid'";
	mysql_query($query);
	$query = "UPDATE {$dbprefix}deleted_reviews SET deleted='$deleted', deletedby='$userid' WHERE id='$postid'";
	mysql_query($query);
	
	
	$query = "DELETE FROM {$dbprefix}reviews WHERE id='$postid'";
    mysql_query($query);

    $this->system->log("forum","delete post","$postid");
  }



  function getTopDiscussedSubmissions($num)
  {
//    $query = "SELECT submissionid,count(*) count FROM forum_posts GROUP BY submissionid ORDER BY count DESC LIMIT 0,$num";
    
  }

  //
  // parser
  //
  function fmlToHTML($fml)
  {
    $matches = array();
    preg_match_all("/(\\[([\w]+)[^\\]]*\\])(.*)(\\[\/\\2\\])/", $fml, $matches, PREG_SET_ORDER);

    $html = $fml;

    foreach($matches as $vals)
    {
      $html = str_replace($vals[0],"<div class=\"quote\">".$vals[3]."</div>",$html);
    }

    return $html;
  }

  function htmltoFML($html)
  {
    $matches = array();
    preg_match_all("/(<([\w]+)[^>]*>)(.*)(<\/\\2>)/", $html,$matches,PREG_SET_ORDER);

    $fml = $html;

    foreach($matches as $vals)
    {
      $fml = str_replace($vals[0],"[quote]".$vals[3]."[/quote]",$fml);
    }

    return $fml;
  }
}

?>
