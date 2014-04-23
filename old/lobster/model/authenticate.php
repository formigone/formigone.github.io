<?php

require '/home/a2647781/public_html/lobster/model/login.class.php';

$o = new Login();

if( isset($_GET['q']) ){
	switch( $_GET['q'] )
	{
		case 'role' :
			echo $o->getRole();
			break;
			
		case 'out' :
			echo $o->logout();
			break;
			
		default:
			echo $o->isLoggedIn();
	}
}
else{
	$o->authenticate();
}