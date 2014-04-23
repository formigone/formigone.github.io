<?php

require_once '/home/a2647781/public_html/lobster/model/login.class.php';
require_once '/home/a2647781/public_html/lobster/model/nav.php';
require_once '/home/a2647781/public_html/lobster/model/intro.php';
require_once '/home/a2647781/public_html/lobster/model/forms.php';

class Profile implements Controller
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
		$this->jLib = $this->MF->loadJs('profile');
		$this->header = $this->MF->getHeader('Music to my ears');
		$this->login = new Login();
		$this->nav = new Nav( $this->login->getRole() );
		$this->content = new Intro( $this->login->getRole() );
		$this->errLog = $this->MF->getErrorPanel();
		$this->editForm = $this->MF->getEditForm();
		$this->forms = new Forms();
		$this->DB = $this->login->getDb();
	}
	
	function getSummary(){
	
		echo '<h1>My Profile</h1>';
		
		$id = $_SESSION['user_id'];
		$res = $this->DB->select( " SELECT t.first_name, t.last_name, t.id, t.email,t.phone, u.email FROM teacher t JOIN user_accounts u ON u.id = t.account_id WHERE t.id = '$id' " );
		
		echo	'<table class="dash_hor" id="my_profile"><tr>',
				'<td class="head">Name</td><td class="body">', $res->first_name, ' ', $res->last_name,
				'</td><td width="100%"></td></tr>',
				'<td class="head">Phone</td><td class="body" colspan="2">', $res->phone,
				'</td></tr>',
				'<td class="head">Email</td><td class="body" colspan="2">', $res->email,
				'</td></tr>',
				'<td class="head" valign="top">Change Password<br/><span style="color:#fff;font-size:12px;font-weight:400">enter new password twice</span></td><td class="body" colspan="2"><input type="password"/><br/><input type="password"/><br/><input type="button" value="Change password" disabled/>',
				'</td></tr>',
				'</table>';
		
		$this->spaceHor(); 
		echo '<hr class="hr_b" />',
				'<p>Since this is just a demo page, no implementation will be set up to update a user\'s perfonal profile page. You get the idea, though... update the two tables involved in this transaction, which would be the <em>teacher</em> table and the <em>user_account</em> table, being liked by both the email address, and the account id.</p>';

	}
	
	
	function spaceHor(){
		echo '<hr class="hr_b"/>';
	}
	
	function execute()
	{
		if( $this->login->isLoggedIn() )
			include '/home/a2647781/public_html/lobster/view/profile.php';
		else
			header('Location: /lobster');
	}

}