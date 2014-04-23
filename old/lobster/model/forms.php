<?php
@session_start();
require_once '/home/a2647781/public_html/lobster/model/database.class.php';

class Forms
{
	private $type;
	private $DB;
	
	public function __construct($pType = ''){
		$this->type = $pType;
		$this->DB = new Database();
	}
	
	public function getForm(){

		// dynamically form function name
		$form = 'get' . $this->type;

		// attempt to polymorphically call function
		if(method_exists($this, $form))
			return $this->{$form}();

		// return if chosen function doesn't exist
		return 0;
	}
	
	public function getInstruments($pSelId){
	
		$instruments = $this->DB->get( " SELECT * FROM instruments ORDER BY name ASC " );
		$HTML = '<select id="'. $pSelId .'">';

		while( $row = mysql_fetch_object($instruments)){

			$HTML .='<option value="'. $row->id .'" >'.
						$row->name.
						'</option>';
		}
		
		return $HTML;
	}

	private function getStudentEdit(){
		if( $this->type == '' )
			return 'No form specified';

		$ID = $_GET['id'];

		$res = $this->DB->select( " SELECT s.first_name, s.last_name, s.birthdate, r.instrument_id as instrument FROM student s JOIN teacher_registration r ON r.student_id = s.id WHERE s.id = $ID " );

		$instruments = $this->DB->get( " SELECT * FROM instruments ORDER BY name ASC " );

		$HTML = '<p><b>Edit personal info</b></p>'.
					'<input type="text" value="'. $res->first_name .'" id="gse_first_name" size="15"/>'.
					'<input type="text" value="'. $res->last_name .'" id="gse_last_name" size="15"/>'.
					'<input type="text" value="'. $res->birthdate .'" id="gse_birthdate" size="10"/>';

		$HTML .= '<select id="sel_instrument">';

		while( $row = mysql_fetch_object($instruments)){

			$HTML .='<option value="'. $row->id .'"';

				if($row->id == $res->instrument)
					$HTML .= ' selected ';

			$HTML .= '>'.
						$row->name.
						'</option>';
		}
		
		$HTML .= '</select><input type="button" id="student_update" value="Update" /><hr/>';
		
		$HTML .= '<p><b>Edit student registration</b></p>'.
					'<p>If you no longer teach this student, you may remove him from your teaching records. '.
					'<input type="button" id="student_remove" value="Unregister Student" /><hr/>';

		$HTML .= '<input type="button" id="stuEdit_cancel" class="std_dia_button" value="Cancel" />'.
					'<script type="text/javascript">$(function() {$( "#gse_birthdate" ).datepicker({changeMonth: true,changeYear: true,dateFormat: "yy-mm-dd"});});</script>';

		return $HTML;
	}
	
	private function getNoTeacher(){
		return '<p>Our records show that this student is already being taught by someone else.</p><p><b>Would you like to add this student to your teaching pool anyway?</b></p><table><tr><td><input type="button" id="already_add" value="Yes" class="std_dia_button"/></td><td><input type="button" id="already_cancel" value="No" class="std_dia_button"/></td></tr></table>';
	}
	
	
	private function getEditPayment(){
		$teacher = $_REQUEST['teacher'];
		
		$summary = $this->DB->select( " SELECT t.first_name, t.last_name, t.member_id, t.id, t.member_id, m.date_due, m.total_due, m.total_paid FROM teacher t JOIN membership_payment m ON t.id = m.teacher_id WHERE m.teacher_id = $teacher " );

		$HTML = '<p><b>Edit teacher\'s payment info</b></p>'.
					'<table><tr><td>'. $summary->first_name. ' '. $summary->last_name.' ('. $summary->member_id.')</td><td>amount paid: </td><td>'.
					'<input type="hidden" value="'. $summary->id.'" id="gep_id"/>'.
					'<input type="text" value="" id="gep_total_paid" size="8"/>'.
					'</td><td> / $'. ($summary->total_due - $summary->total_paid). '.00</td><td><input type="button" id="gep_submit" value="Confirm payment" /></tr></table>';

		$HTML .= '<input type="button" id="editPay_cancel" class="std_dia_button" value="Cancel" />';

		$HTML .= '<script type="text/javascript">'.
			'$("#gep_submit").click(function(){var totaldue = '.
			$summary->total_due.
			'; id=$("#gep_id").val(); var paid = $("#gep_total_paid").val();'.
			'if( isNaN(paid)){paid = parseFloat( paid.substr(1) ); }'.
			'if(paid.length < 1 || paid == 0 || paid > totaldue){'.
				'showAlert("Invalid payment amount", "Please enter a valid dollar amount to be paid");'.
			'}'.
			'else{ '.
				'$.get("/lobster/controller/refresh.php?q=updateMemberPay&t="+id+"&p="+paid,function(res){ '.
					'if( res ){showAlert("Payment successful", "The payment has been posted.");'.
					'window.location = "http://localhost/lobster/?controller=payment";'.
					'}'.
					'else{showAlert("Error","An error occured while processing the payment. Please try again later");}'.
				'});'.
			'}'.
			'});</script>';
					
		return $HTML;
	}
	
	private function getInsertVenue(){
		$name = $_GET['name'];
		$addr = $_GET['addr'];
		
		$res = $this->DB->insert( "venues", "name, address", "'".$name."', '".$addr."'" );
	}

	private function arrayToInsert($pReq){
		$temp = explode( ',', $_REQUEST[$pReq] );
		$len = count( $temp );
		$i = 0;

		$str = '';

		foreach( $temp as $row ){
			if( $row != '')
				$str .= '("'. $row .'")';
			if( ++$i < $len - 1 )
				$str .= ',';
		}

		return array( 'name' => $pReq, 'string' => $str );
	}
	

	private function getInsertEvent(){
		$name = $_GET['name'];
		$ven = $_GET['venue'];
		$cost = $_GET['cost'];
		$open = $_GET['open'];
		$close = $_GET['close'];
		
		$res = $this->DB->insert( "events", 
			"name, venue_id, cost, open_date, close_date",
			"'".$name."', '".$ven."', '".$cost."', '".$open."', '".$close."'" );
			
		$rooms = explode( ',', $_REQUEST['rooms'] );
		$opens = explode( ',', $_REQUEST['opens'] );
		$close = explode( ',', $_REQUEST['close'] );
		$instr = explode( ',', $_REQUEST['instr'] );
		$skill = explode( ',', $_REQUEST['skill'] );
		
		$roomInserts = '';
		
		$len = count($rooms) - 1;
		
		for($i = 0; $i < $len; $i++){
			$roomInserts .= 	'("'.$rooms[$i].'",'.
									'"'.$opens[$i].'",'.
									'"'.$close[$i].'",'.
									'"'.$instr[$i].'",'.
									'"'.$skill[$i].'",'.
									'"'.mysql_insert_id().'")';
			if($i < $len - 1)
				$roomInserts .= ',';
		}

		$this->DB->inserts( "rooms",
				"name, open, close, instrument_id, skill_id, event_id",
				$roomInserts );
	}
	
	private function getEditEvent(){
	
		$skill = $this->DB->get("SELECT * FROM skills ORDER BY id ASC");
		$instrument = $this->DB->get("SELECT * FROM instruments ORDER BY name ASC");

		$HTML = '<b>Specify rooms for event</b>';
		$HTML .= '<table id="ev_all_rooms"><tr><td>Room</td><td>Open</td><td>Close</td><td>Instrument</td><td>Skill Level</td><td width="100%"></td></tr><tr>'.
					'<td><input type="text" size="10" class="ev_room"/></td>'.
					'<td><input type="text" size="7" class="dater ev_open"/></td>'.
					'<td><input type="text" size="7" class="dater ev_close"/></td>'.
					'<td><select id="ev_instrument">';
					while( $row = mysql_fetch_object( $instrument ))
						$HTML .= '<option value="'. $row->id .'">'. $row->name. '</option>';
		$HTML .= '</select></td>'.
					'<td><select id="ev_skill">';
					while( $row = mysql_fetch_object( $skill ))
						$HTML .= '<option value="'. $row->id .'">'. $row->name. '</option>';
		$HTML .= '</select></td><td><input type="button" class="ev_new_row" value="Add Room" /></td></tr></table>';

		$HTML .= '<input type="button" id="evEdit_submit" class="std_dia_button" value="Save" />'.
					'<script type="text/javascript">$(function() {$( ".dater" ).datepicker({changeMonth: true,changeYear: true,dateFormat: "yy-mm-dd"});});</script>';
					
		return $HTML;
	}
	
	private function getFestivalRegister(){
		$event = $_REQUEST['id'];
		$HTML = '<b>Select a student to register</b>';

		$students = $this->DB->get("SELECT s.first_name, s.last_name, s.id FROM teacher_registration r JOIN student s on r.student_id = s.id WHERE r.teacher_id = '".$_SESSION['user_id']."' ORDER BY s.first_name ASC");

		$rooms = $this->DB->get( "SELECT r.name, r.id FROM rooms r JOIN events e ON r.event_id = e.id WHERE e.id = '$event' ORDER BY r.name ASC" );
		
		$times = $this->DB->get( "SELECT r.open, r.close FROM rooms r JOIN events e ON r.event_id = e.id WHERE e.id = '$event'" );

		$instrs = $this->DB->get( "SELECT r.instrument_id as instr_id, i.name as instr FROM rooms r JOIN instruments i ON i.id = r.instrument_id JOIN events e ON r.event_id = e.id WHERE e.id = '$event' ORDER BY i.name ASC" );

		$skills = $this->DB->get( "SELECT r.skill_id, s.name as skill FROM rooms r JOIN skills s ON r.skill_id = s.id JOIN events e ON r.event_id = e.id WHERE e.id = '$event' ORDER BY s.name ASC" );
		
		$type = $this->DB->get(" SELECT r.id as id, r.name as room, s.name as skill, i.name as instr FROM rooms r JOIN events e ON r.event_id = e.id JOIN instruments i ON r.instrument_id = i.id JOIN skills s ON r.skill_id = s.id WHERE r.event_id = '$event'");
		
		$HTML .= '<input type="hidden" id="stud_e_id" value="'.$event.'"/><table><tr><td>Student</td></tr>'.
					'<tr><td><select id="stud_list">';
		while( $row = mysql_fetch_object( $students ) ){
			
			$HTML .= '<option value="'. $row->id .'">'. $row->first_name.' '. $row->last_name.'</option>';
		}		
		$HTML .= '</select></td></tr><tr><td>Performance Type</td></tr><tr><td><select id="stud_type">';
		
		while( $row = mysql_fetch_object( $type )){
			$HTML .= '<option value="'.$row->id.'">Room '.$row->room.', '.$row->instr.' - '.$row->skill.'</option>';
		}
		
		$HTML .= '</select></td></tr></table>';
		$HTML .= '<input type="button" value="Register" id="stud_register"/><hr/><b>An optimum time will be selected for you as each student is registered.</b>';
		
		$HTML .= '<input type="button" id="gfr_cancel" value="Cancel" class="std_dia_button" />';

		return $HTML;
	}
	
	private function getRegisterStudent(){
	
		$event = $_GET['event'];
		$student = $_GET['id'];
		$room = $_GET['room'];
		$teacher = $_SESSION['user_id'];
		
		$insert_room = $this->DB->select("SELECT * FROM performance_schedule WHERE room_id = '$room' ");

		if($insert_room){
			$next = $this->DB->select("SELECT MAX(time) + 0.05 as nextTime FROM performance_schedule WHERE room_id = '$room' ");
			$this->DB->insert( "performance_schedule", 
										"event_id, student_id, room_id, time",
										"'$event', '$student', '$room', '$next->nextTime'");
		}
		else{
			$first = $this->DB->select("SELECT open FROM rooms WHERE id = '$room'");
			$this->DB->insert( "performance_schedule", 
										"event_id, student_id, room_id, time",
										"'$event', '$student', '$room', '$first->open'");
		}

		$schedule = $this->DB->select("SELECT id FROM performance_schedule WHERE id = '".mysql_insert_id()."'");
		$insert_room = $this->DB->select("SELECT skill_id, instrument_id FROM performance_schedule s JOIN rooms r ON s.room_id = r.id WHERE room_id = '$room' ");

		$this->DB->insert("festival_registration", 
								"event_id, teacher_id, student_id, skills_id, instrument_id, schedule_id",
								"'$event', '$teacher', '$student', '$insert_room->skill_id', '$insert_room->instrument_id', '$schedule->id'");
	}
}