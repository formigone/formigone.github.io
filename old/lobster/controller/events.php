<?php

require_once '/home/a2647781/public_html/lobster/model/login.class.php';
require_once '/home/a2647781/public_html/lobster/model/nav.php';
require_once '/home/a2647781/public_html/lobster/model/intro.php';
require_once '/home/a2647781/public_html/lobster/model/forms.php';

class Events implements Controller
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
		$this->jLib = $this->MF->loadJs('events');
		$this->header = $this->MF->getHeader('Music to my ears');
		$this->login = new Login();
		$this->nav = new Nav( $this->login->getRole() );
		$this->content = new Intro( $this->login->getRole() );
		$this->errLog = $this->MF->getErrorPanel();
		$this->editForm = $this->MF->getEditForm();
		$this->forms = new Forms();
		$this->DB = $this->login->getDb();
	}
	
	function timePicker($pClass){
		$HTML = '<select class="'. $pClass .'">';
		
		for($i = 8; $i < 18; $i++){
			$HTML .= '<option value="'. $i .'">'. $i .':00';
			if($i > 11)
				$HTML .= 'p';
			else
				$HTML .= 'a';
			$HTML .= '.m.</option>';
		}
		
		$HTML .= '</select>';
		
		return $HTML;
				  
	}
	
	function getCurrentEvents(){
		$res = $this->DB->get( " SELECT v.name as venue, v.address, e.name, e.cost, e.venue_id as v_id, e.open_date as open, e.close_date as close, e.id as id FROM venues v JOIN events e ON e.venue_id = v.id " );
		$oddRow = 0;
		$total = mysql_affected_rows();
		
		echo "<h1>Current Events ($total)</h1>";
		
		echo '<table class="dash dash_hov"><thead><tr>',
				'<td>Event Name</td><td>Venue</td><td>Cost</td><td>Open</td><td>Close</td><td>Rooms</td><td width="100%"></td><td></td>',
				'</tr></thead><tbody>';
				
				while( $row = mysql_fetch_object( $res )){
					$rooms = $this->DB->get("SELECT * FROM rooms WHERE event_id = '$row->id' ");
					$len = mysql_affected_rows();
					
					echo '<tr';
					if($oddRow++ % 2)
						echo ' class="odd"';
					
					echo '><td>', $row->name, '</td><td>', $row->venue, '</td><td>$', $row->cost, '.00</td><td>', date('D, M jS y', strtotime( $row->open )), '</td><td>', date('D, M jS y', strtotime( $row->close )), '</td><td>', $len, '</td><td></td><td></td></tr>';
				}

				
				echo '</tbody></tr></thead></table>';
	}
	
	function insertEvent(){
		
		$ven = $this->DB->get( " SELECT * FROM venues ORDER BY name ASC " );
		echo '<h1>Add New Event</h1>';
		
		echo '<table class="dash_hor">',
				'<tr><td class="head">Event Name</td><td class="body"><input type="text" id="event_name"/></td><td width="100%"></td></tr>',
				'<tr><td class="head">Venue</td><td class="body"><select id="event_venue">';
				
				while( $row = mysql_fetch_object( $ven )){
					echo '<option value="', $row->id, '">', $row->name, '</option>';
				}
				
		echo '</select></td><td></td></tr>',
				'<tr><td class="head">Cost</td><td class="body"><input type="text" id="event_cost"/></td><td></td></tr>',
				'<tr><td class="head">Open Date</td><td class="body"><input type="text" class="dater" id="event_open"/></td><td></td></tr>',
				'<tr><td class="head">Close Date</td><td class="body"><input type="text" class="dater" id="event_close"/></td><td></td></tr>',
				'<tr><td class="head" valign="top">Rooms</td><td class="body">';
				
				
		$skill = $this->DB->get("SELECT * FROM skills ORDER BY id ASC");
		$instrument = $this->DB->get("SELECT * FROM instruments ORDER BY name ASC");

		echo '<b>Specify rooms for event</b>';
		echo '<table id="all_rooms"><tr><td>Room</td><td>Open</td><td>Close</td><td>Instrument</td><td>Skill Level</td><td></td></tr><tr>',
					'<td><input type="text" size="10" class="ev_room"/></td>',
					'<td>', $this->timePicker('ev_open'), '</td>',
					'<td>', $this->timePicker('ev_close'), '</td>',
					'<td><select class="ev_instrument">';
					
					while( $row = mysql_fetch_object( $instrument ))
						echo '<option value="', $row->id, '">', $row->name, '</option>';
						
		echo '</select></td>',
					'<td><select class="ev_skill">';

					while( $row = mysql_fetch_object( $skill ))
						echo '<option value="', $row->id, '">', $row->name, '</option>';

		echo 	'</select></td><td><input type="button" class="ev_new_row" value="+" /><input type="button" class="ev_les_row" value="-" /></td></tr></table>',
				'</td><td></td></tr>',
				'<tr><td class="head"></td><td class="body"><input type="button" id="event_submit" class="std_button" value="Add New"/></td><td></td></tr>',
				'</table>';
		echo '<script type="text/javascript">$(function() {$( ".dater" ).datepicker({changeMonth: true,changeYear: true,dateFormat: "yy-mm-dd"}); });</script>';
		
	}
	
	function getOpenFestivals(){
		$res = $this->DB->get("SELECT e.id, e.name, e.cost, e.close_date, v.name as venue FROM events e JOIN venues v ON e.venue_id = v.id");
		$oddRow = 0;
		$total = mysql_affected_rows();
		
		echo "<h1>Festivals Opened for Registartion ($total)</h1>";
		
		echo '<table class="dash dash_hov"><thead><tr>',
				'<td>Festival Name</td><td>Venue</td><td>Cost</td><td>Close Date</td><td width="100%"></td><td>Register</td>',
				'</tr></thead><tbody>';
				
		while( $row = mysql_fetch_object( $res )){
			
			echo '<tr';
			if($oddRow++ % 2)
				echo ' class="odd"';
			
			echo '><td>', $row->name, '</td><td>', $row->venue, '</td><td>$', $row->cost, '.00</td><td>', date('D, M jS y', strtotime( $row->close_date )), '</td><td></td><td><b class="register_edit">', $row->id, '</b></td></tr>';
		}
		echo '</tbody></table>';
				
	}
	
	function getRegisteredStudents(){
		$id = $_SESSION['user_id'];
		$res = $this->DB->get("SELECT e.name as event, s.first_name, s.last_name, k.name as skill, i.name as instr FROM festival_registration r JOIN student s ON s.id = r.student_id JOIN skills k ON r.skills_id = k.id JOIN instruments i ON r.instrument_id = i.id JOIN events e ON r.event_id = e.id WHERE teacher_id = '$id'");
		$len = mysql_affected_rows();
		echo "<h1>Your Registered Students ($len)</h1>";
		
		if( $res ){
			echo '<table class="dash_hor">';
			while( $row = mysql_fetch_object( $res )){
				echo '<tr style="border-top:1px solid #333"><td class="head">Student</td><td class="body">',
						$row->first_name,' ', $row->last_name, 
						'</td><td width="100%"></td></tr>',
						
						'<tr><td class="head">Instrument</td><td class="body">',
						$row->instr, 
						'</td><td width="100%"></td></tr>',
						
						'<tr><td class="head">Skill Level</td><td class="body">',
						$row->skill, 
						'</td><td width="100%"></td></tr>',
						
						'<tr><td class="head">Festival</td><td class="body">',
						$row->event, 
						'</td><td width="100%"></td></tr>';
			}
			echo '</table>';
		}
	}

	
	function spaceHor(){
		echo '<hr class="hr_b"/>';
	}

	function execute()
	{
		if( $this->login->isLoggedIn() )
			include '/home/a2647781/public_html/lobster/view/events.php';
		else
			header('Location: /lobster');
	}
}