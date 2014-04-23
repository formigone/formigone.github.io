<?php

if( !isset($_REQUEST['q']) )
	return 0;

require '/home/a2647781/public_html/lobster/model/db-select.php';

$q = new DbSelect($_REQUEST['t']);
echo $q->exec();