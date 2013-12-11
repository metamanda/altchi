<?php

include('libs/Forum.php');
define('NUM_POSTS_SHOW',10);
define('NUM_THREADS_SHOW',10);
$forum = new Forum($system);
$document = 'forum_categories.tpl';
$action = $_REQUEST['action'];

$error = array();
switch($action)
{
case "showthread":
  $threadid = $_GET['id'];
  $index = isset($_GET['index'])?$_GET['index']:0;
  $thread = $forum->getThread($threadid);
  $post = $_POST['post'];
  if (!$thread['locked'] && isset($post) && $system->logged_in)
  {
    if (strlen($post)>1)
    {
      $forum->addPost($system->userid,$threadid,str_replace("\n","<br>",htmlspecialchars($post)));
      $index = 1048576;
    }
    else
      $error[] = "Post length must be at least two characters long";
  }

  $numposts = $forum->getNumPosts($threadid);
  $numscreens = ceil($numposts / NUM_POSTS_SHOW);
  
  if ($index>=$numscreens) $index = $numscreens-1;
  
  $category = $forum->getCategory($thread['categoryid']);
  $posts = $forum->getPosts($threadid,$index*NUM_POSTS_SHOW,NUM_POSTS_SHOW);
  $smarty->assign('numscreens',$numscreens);
//  $smarty->assign('numpostsshow',NUM_POSTS_SHOW);
  $smarty->assign('numitemsshow',NUM_POSTS_SHOW);
//  $smarty->assign('numposts',$numposts);
  $smarty->assign('numitems',$numposts);
  $smarty->assign('index',$index);
  $smarty->assign('script',"forum.php?action=showthread&id=$threadid");
  $smarty->assign('category',$category);
  $smarty->assign('thread',$thread);
  $smarty->assign('posts',$posts);
  $document = 'forum_posts.tpl';

  break;


case "deletepost":
  $postid = $_GET['id'];
  $index = isset($_GET['index'])?$_GET['index']:0;

  $post = $forum->getPost($postid);
  if ($system->admin || $post['userid']==$system->userid)
  {
    $forum->deletePost($postid);
    $threadid = $post['threadid'];
    header("Location: forum.php?action=showthread&id=$threadid&index=$index");
    exit();
  }
  break;

case "editpost":

  $postid = $_GET['id'];
  $index = isset($_GET['index'])?$_GET['index']:0;
  $post = $_POST['post'];

  if (isset($postid))
    $postdata = $forum->getPost($postid);

  if (!isset($post))
  {
//    $postdata['post'] = $forum->htmlToFML(str_replace("<br>","\n",$postdata['post']));
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
      header("Location: forum.php?action=showthread&id=".$postdata['threadid']."&index=$index");
    }
    else
      $error[] = "Not authorised to edit this post.";
  }

  break;

default:
  $categories = $forum->getCategories();
  $smarty->assign('categories',$categories);
  break;
}

$smarty->assign('error',$error);
$smarty->assign('center',$document);
$smarty->display('index.tpl');

?>
