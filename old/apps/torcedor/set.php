<?php

mysql_connect('mysql10.000webhost.com', 'a2647781_apps', 'f0r3ns1cs')
  or die('Could not connect: ' . mysql_error());
mysql_select_db('a2647781_chrome') or die('Could not select database');

$T = $_GET['t'];
mysql_query("INSERT INTO team_votes (team_id) VALUES('".$T."') ");

$result = mysql_query("SELECT * FROM teams WHERE img = '".$T."'");
$row = mysql_fetch_array($result);
echo $row['team'];
exit();
?>