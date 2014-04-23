<?php

if( !isset($_REQUEST['q']) )
	return 0;

require_once '/home/a2647781/public_html/lobster/model/mf.class.php';
require_once '/home/a2647781/public_html/lobster/controller/controller.interface.php';
require_once '/home/a2647781/public_html/lobster/music-festival.php';

switch( $_REQUEST['q'] )
{
	case 'studentList' :
		require '/home/a2647781/public_html/lobster/controller/dashboard.php';
		$dash = new Dashboard();
		echo $dash->getStudents();
		break;
	
	case 'viewAll' :
		require_once '/home/a2647781/public_html/lobster/controller/dashboard.php';
		$o = new Dashboard();
		echo $o->viewAll($_GET['t']);
		break;
		
	case 'updateMemberPay' :
		require_once '/home/a2647781/public_html/lobster/controller/payment.php';
		$o = new Payment();
		echo $o->updatePayment($_GET['t']);
		break;
}