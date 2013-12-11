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
cleanUpAdditionalAuthors($submissions);

exit();

function cleanUpAdditionalAuthors($submissions)
{
  foreach ($submissions as $submission)
  {
	echo "\"".$submission['title']."\",\"".$submission['user']['firstname']." ".$submission['user']['lastname']."\",";
	  
    if($submission['additionalauthors'] != null)
    {
	  $addAuthors = $submission['additionalauthors'];
	  //try splitting several ways
	  $splitAuthors = explode(" and ", $addAuthors);
	  if (count($splitAuthors) <= 1)
	  {
		$splitAuthors = explode(";", $addAuthors);
		if (count($splitAuthors) <= 1)
		{
			$splitAuthors = explode(".,", $addAuthors);
			if (count($splitAuthors) <= 1)
			{
				$splitAuthors = explode(",", $addAuthors);
			}
		}
		//$submission['additionalauthors'] = $splitAuthors;
		foreach ($splitAuthors as $addauthor)
		  echo "\"".trim($addauthor)."\",";
	  }
	  else // "and" just gives you the final author
	  {
		  $moreAuthors = explode(";", $splitAuthors[0]);
		  if (count($moreAuthors) <= 1)
		  {
			  $moreAuthors = explode(".,", $splitAuthors[0]);
			  if (count($moreAuthors) <= 1)
			  {
				$moreAuthors = explode(",", $splitAuthors[0]);  
			  }
		  }
		  $moreAuthors[] = $splitAuthors[1];
		  //$submission['additionalauthors'] = $moreAuthors;
		  foreach ($moreAuthors as $addauthor)
		    echo "\"".trim($addauthor)."\",";
	  }
	  echo "<br/>"; 
	}
  }
  return $submissions;	
}
?>