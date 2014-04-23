<?php

require_once '/home/a2647781/public_html/lobster/model/login.class.php';
require_once '/home/a2647781/public_html/lobster/model/nav.php';
require_once '/home/a2647781/public_html/lobster/model/intro.php';
require_once '/home/a2647781/public_html/lobster/model/forms.php';

class Payment implements Controller
{
	private $MF;
	public $style;
	public $jLib;
	public $header;
	public $nav;
	private $login;
	public $errLog;
	public $editForm;
	private $content;
	private $DB;
	private $forms;
	
	function __construct()
	{
		$this->MF = new MF();
		$this->style = $this->MF->getStyle('dashboard');
		$this->jLib = $this->MF->loadJs('payment');
		$this->header = $this->MF->getHeader('Music to my ears');
		$this->login = new Login();
		$this->nav = new Nav( $this->login->getRole() );
		$this->content = new Intro( $this->login->getRole() );
		$this->errLog = $this->MF->getErrorPanel();
		$this->editForm = $this->MF->getEditForm();
		$this->forms = new Forms();
		$this->DB = $this->login->getDb();
	}
	
	function getDues(){
	
		echo '<h1>Payment Information</h1>';
		$res = $this->DB->select("SELECT * FROM membership_payment WHERE teacher_id =". $_SESSION['user_id']."");
		if( $res->total_paid < $res->total_due){
			echo 	'<p><b>Your current due ballance: </b>$', $res->total_due, '.00<br/>',
					'<b style="color:#c00">Payment due date ', $res->date_due, '</b></p>',
					'<p>Membership dues may be paid by mailing your check to:</p><p>',
					'<b>Music Festival Inc.</b><br/>',
					'815 West Pacific Island<br/>',
					'Springfield, Idaho 81516</p><hr/>',
					'<p><em>We currently have no plans to implement online payment processing. Personal checks, money orders, or traveller\'s checks are the only acceptable payment options we accept at the moment.<br/>Please do not mail in cash. Amounts must be exact. Any returned checks will result in a $50.00 charge to your account, and your students will be dropped from any upcoming festivals if no payment is made within 5 business days.</em></p>';
		}
		else{
			echo 	'<p><b>Your current due ballance: </b>$', ($res->total_due - $res->total_paid), '.00<br/>',
					'<p>Membership dues may be paid by mailing your check to:</p><p>',
					'<b>Music Festival Inc.</b><br/>',
					'815 West Pacific Island<br/>',
					'Springfield, Idaho 81516</p><hr/>',
					'<p><em>We currently have no plans to implement online payment processing. Personal checks, money orders, or traveller\'s checks are the only acceptable payment options we accept at the moment.<br/>Please do not mail in cash. Amounts must be exact. Any returned checks will result in a $50.00 charge to your account, and your students will be dropped from any upcoming festivals if no payment is made within 5 business days.</em></p>';
		}
	}
	
	
	function spaceHor(){
		echo '<hr class="hr_b"/>';
	}
	
	
	function getOutstandingPayments(){
		echo '<h1>Teacher\'s outstanding payments</h1>';
		
		$res = $this->DB->get( " SELECT t.first_name, t.last_name, t.member_id, t.id, m.date_due, m.total_due, m.total_paid FROM teacher t JOIN membership_payment m ON t.id = m.teacher_id WHERE m.total_paid < 75 ORDER BY t.first_name ASC " );
		
		echo	'<table class="dash dash_hov" id="outstanding_payments"><thead><tr>',
				'<td>Teacher</td><td>Membership ID</td><td>Due Date</td><td>Total Due</td><td width="100%"></td><td>Edit</td>',
				'</tr></thead><tbody>';
		$oddRow = 0;
		while( $row = mysql_fetch_object( $res ) ){
			echo 	'<tr';

				if($oddRow++ % 2)
							echo ' class="odd"';
		echo 		'><td>', $row->first_name, ' ', $row->last_name, '</td>',
					'<td>', $row->member_id, '</td>',
					'<td>', $row->date_due, '</td>',
					'<td style="text-align:center">$', ($row->total_due - $row->total_paid), '.00</td>',
					'<td></td>',
					'<td><b class="payment_edit">', $row->id, '</b></td></tr>';
		}
		
		echo '</tbody></table>';
	}
	
	function getPaymentStats(){
				echo '<h1>Payment Statistics</h1>';

		$res = $this->DB->get( " SELECT t.id, m.date_due, m.total_paid FROM teacher t JOIN membership_payment m ON t.id = m.teacher_id WHERE m.total_paid != 0 " );

		$revenue = 0;
		$pay_period = '';
		$total_paid = mysql_affected_rows();

		while( $row = mysql_fetch_object( $res ) ){
			$revenue = $revenue + $row->total_paid;
			$pay_period = $row->date_due;
		}
		
		$total = $this->DB->select("SELECT * FROM membership_payment");
		$total_teachers = mysql_affected_rows();
		$oddRow = 0;
		echo '<table class="dash" id="outstanding_payments"><thead><tr>',
				'<td>Pay Period</td><td>Total Revenue</td><td>Teacher who\'ve paid</td><td width="100%"></td></tr></thead><tbody><tr';

				if($oddRow++ % 2)
							echo ' class="odd"';
		echo 	'>',
				'<td>', $pay_period, '</td>',
				'<td>$', $revenue, '.00</td>',
				'<td>', $total_paid, '/', $total_teachers, '</td>',
				'<td></td></tr></tbody></table>';
	}

	function execute()
	{
		if( $this->login->isLoggedIn() )
			include '/home/a2647781/public_html/lobster/view/payment.php';
		else
			header('Location: /lobster');
	}
	
	function updatePayment(){
		$id = $_GET['t'];
		$paid = $_GET['p'];
		$pay = $this->DB->update( "membership_payment", 
								" total_paid = '". $paid ."'",
								"teacher_id = $id" );
		if( $pay )
			return 1;
		return 0;
	}
}