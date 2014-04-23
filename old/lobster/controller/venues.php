<?php

require_once '/home/a2647781/public_html/lobster/model/login.class.php';
require_once '/home/a2647781/public_html/lobster/model/nav.php';
require_once '/home/a2647781/public_html/lobster/model/intro.php';
require_once '/home/a2647781/public_html/lobster/model/forms.php';

class Venues implements Controller
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
		$this->jLib = $this->MF->loadJs('venues');
		$this->header = $this->MF->getHeader('Music to my ears');
		$this->login = new Login();
		$this->nav = new Nav( $this->login->getRole() );
		$this->content = new Intro( $this->login->getRole() );
		$this->errLog = $this->MF->getErrorPanel();
		$this->editForm = $this->MF->getEditForm();
		$this->forms = new Forms();
		$this->DB = $this->login->getDb();
	}
	
	function getCurrentVenues(){
		$res = $this->DB->get( " SELECT * FROM venues " );
		$total_venues = mysql_affected_rows();
		
		echo "<h1>Current Venues ($total_venues)</h1>";
		$oddRow = 0;
		echo '<table class="dash dash_hov" id="all_venues"><thead><tr>',
				'<td>Venue Name</td><td>Address</td><td width="100%"></td><td>Edit</td></tr></thead><tbody>';

		while($row = mysql_fetch_object( $res )){
			echo '<tr';
					if($oddRow++ % 2)
								echo ' class="odd"';
			echo 	'><td>', $row->name, '</td><td>', $row->address, '</td></td><td></td><td><b class="venue_edit">',$row->id,'</b></td></tr>';
		}
		
		echo '</tbody></table>';
	}
	
	function insertVenue(){
		echo '<h1>Insert Venue</h1>';
		
		echo '<table class="dash" id="new_student"><thead>',
				'<tr><td>Venue Name</td><td>Venue Address</td><td></td><td width="100%"></td></tr></thead>',
				'<tbody><tr>',
				'<td><input type="text" id="iv_name"/></td>',
				'<td><input type="text" id="iv_address"/></td>',
				'<td><input type="submit" value="Add now" class="std_button" id="iv_submit"/></td><td></td>',
				'</tr></tbody></table>';
	}
	
	
	function spaceHor(){
		echo '<hr class="hr_b"/>';
	}
	
	function execute()
	{
		if( $this->login->isLoggedIn() )
			include '/home/a2647781/public_html/lobster/view/venues.php';
		else
			header('Location: /lobster');
	}

}