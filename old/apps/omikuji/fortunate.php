<?php

mysql_connect('mysql10.000webhost.com', 'a2647781_apps', 'f0r3ns1cs')
  or die('Could not connect: ' . mysql_error());
mysql_select_db('a2647781_chrome') or die('Could not select database');


$result = mysql_query("SELECT * FROM omijuki ORDER BY RAND() LIMIT 0,1");

$row = mysql_fetch_array($result);
echo $row['fortune'];
?>