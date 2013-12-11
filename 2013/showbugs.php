<?php

require('libs/db.php');

$query = "SELECT * FROM bugs";
$result = mysql_query($query);

echo "<table>\n";
while($row=mysql_fetch_assoc($result))
{
  echo "<tr><td style=\"background-color:#aaa;\">" . $row[userid];
  echo "</td></tr>";
  echo "<tr><td>" . $row[text];
  echo "</td></tr>\n";
}


?>
