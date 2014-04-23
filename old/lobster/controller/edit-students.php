<?php

if( !isset($_REQUEST['q']) )
	return 0;

require '/home/a2647781/public_html/lobster/model/db-updates.php';

$q = new DbUpdates($_REQUEST['t']);
echo $q->exec();