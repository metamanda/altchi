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

$submissions = $system->getSubmissions(null, 0, 99999, null, 0);
cleanUpEmail($submissions);

exit();

function cleanUpEmail($submissions)
{
  foreach ($submissions as $submission)
  {
	echo "\"".$submission['title']."\",\"".$submission['user']['firstname']." ".$submission['user']['lastname']."\",".$submission['user']['email'];	  
	echo "<br/>";
  }
  return $submissions;	
}
?>