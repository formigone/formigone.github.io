<?php

require_once '/home/a2647781/public_html/lobster/model/login.class.php';
require_once '/home/a2647781/public_html/lobster/model/nav.php';
require_once '/home/a2647781/public_html/lobster/model/intro.php';
require_once '/home/a2647781/public_html/lobster/model/forms.php';

class Dashboard implements Controller
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
		$this->jLib = $this->MF->loadJs('dashboard');
		$this->header = $this->MF->getHeader('Music to my ears');
		$this->login = new Login();
		$this->nav = new Nav( $this->login->getRole() );
		$this->content = new Intro( $this->login->getRole() );
		$this->errLog = $this->MF->getErrorPanel();
		$this->editForm = $this->MF->getEditForm();
		$this->forms = new Forms();
		$this->DB = $this->login->getDb();
	}
	
	function insertStudents(){
		echo 	'<h1>Add new student</h1><table class="dash" id="new_student"><thead>',
				'<tr><td>First name</td><td>Last name</td><td>Birthdate</td><td>Instrument</td><td width="100%"></td></tr></thead><tbody><tr>',
				'<td><input type="text" id="new_first_name"/></td>',
				'<td><input type="text" id="new_last_name"/></td>',
				'<td><input type="text" size="10" id="new_birthdate" value="1995-05-05" /></td>',
				'<td>',$this->forms->getInstruments('new_instrument'),'</td>',
				'<td><input type="submit" value="Add now" class="std_button" id="new_submit"/></td>',
				'</tr></tbody></table>',
				'<script type="text/javascript">$(function() {$( "#new_birthdate" ).datepicker({changeMonth: true,changeYear: true,dateFormat: "yy-mm-dd"});});</script>';
	}
	
	function insertStudentsAdmin(){
		$res = $this->DB->get ( " SELECT * FROM teacher ORDER BY first_name ASC " );
		
		echo 	'<h1>Add new student</h1>',
				'<table class="dash_hor" id="new_student_admin"><tr>',
				'<td class="head">First name</td><td class="body"><input type="text" id="new_s_first_name_admin"/></td><td width="100%"></td></tr>',
				'<td class="head">Last name</td><td class="body" colspan="2"><input type="text" id="new_s_last_name_admin"/></td></tr>',
				'<td class="head">Birthdate</td><td class="body" colspan="2"><input type="text" id="new_s_birthdate_admin"/></td></tr>',
				'<td class="head">Instrument</td><td class="body" colspan="2">',$this->forms->getInstruments('new_s_instrument_admin'),'</td></tr>',
				'<td class="head">Teacher</td><td class="body" colspan="2"><select id="new_s_teacher_admin">';
				
				while( $row = mysql_fetch_object($res) ){
					echo '<option value="', $row->id, '">', $row->first_name, ' ', $row->last_name, ' (', $row->member_id, ')</option>';
				}
				
		echo 	'</select></td></tr>',
				'<td class="head"></td><td class="body"><input type="button" class="std_button" id="new_s_submit_admin" value="Add now" /></td><td></td></tr>',
				'</table>',
				'<script type="text/javascript">$(function() {$( "#new_s_birthdate_admin" ).datepicker({changeMonth: true,changeYear: true,dateFormat: "yy-mm-dd"});});</script>';
	}
	
	function insertTeachers(){
		echo 	'<h1>Add new teacher</h1>',
				'<table class="dash_hor" id="new_teacher"><tr>',
				'<td class="head">First name</td><td class="body"><input type="text" id="new_t_first_name"/></td><td width="100%"></td></tr>',
				'<td class="head">Last name</td><td class="body" colspan="2"><input type="text" id="new_t_last_name"/></td></tr>',
				'<td class="head">Phone</td><td class="body" colspan="2"><input type="text" id="new_t_phone"/></td></tr>',
				'<td class="head">Email</td><td class="body" colspan="2"><input type="text" id="new_t_email"/></td></tr>',
				'<td class="head">Membership ID</td><td class="body" colspan="2"><input type="text" id="new_t_member_id"/></td></tr>',
				'<td class="head">Role</td><td class="body" colspan="2"><select id="new_t_role"><option value="admin">Administrator</option><option value="teacher">Teacher</option></select</td></tr>',
				'<td class="head"></td><td class="body"><input type="button" class="std_button" id="new_t_submit" value="Add now" /></td><td></td></tr>',
				'</table>';
	}
	
	function spaceHor(){
		echo '<hr class="hr_b"/>';
	}
	
	function viewAllLink($pTable){
		echo '<b class="view_all" id="view_all_', $pTable, '">&raquo; view all</b>';
	}
	
	function viewAll($pTable){
		// dynamically form function name
		$func = $pTable;

		// attempt to polymorphically call function
		if(method_exists($this, $func))
			return $this->{$func}(999);

		// return if chosen function doesn't exist
		return 'Error: invalid argument '.$pTable.' caught in viewAll()';
	}

	function getTeachers($pViewLimit = 3){
		$T = $this->login->getUserId();
		
		$res = $this->DB->get(	" SELECT * ".
										" FROM teacher t ".
										" JOIN user_accounts a ON t.account_id = a.id ".
										" WHERE a.role = 'teacher' ".
										" ORDER BY t.first_name " );

		$len = mysql_affected_rows();
		
		$res = $this->DB->get(	" SELECT * ".
										" FROM teacher t ".
										" JOIN user_accounts a ON t.account_id = a.id ".
										" WHERE a.role = 'teacher' ".
										" ORDER BY t.first_name ".
										" LIMIT 0, $pViewLimit " );

		$thisLen = mysql_affected_rows();
		
		$oddRow = 0;

		$HTML = '<div id="getTeachers"><h1>Registered teachers ('.$thisLen.'/'.$len.')</h1><table class="dash dash_hov">';
		$HTML .= '<thead><tr><td width="100%">Teacher Information</td><td>Edit</td></tr></thead><tbody>';

		while( $row = mysql_fetch_object($res)){
			$HTML .= '<tr';
						if($oddRow++ % 2)
							$HTML .= ' class="odd"';
			$HTML .= '><td>'. 
						'<b>Name</b> - '. $row->first_name. ' '. $row->last_name. '<br/>'.
						'<b>Phone</b> - '. $row->phone. '<br/>'.
						'<b>Email</b> - <a href="mailto:'. $row->email. '">'. $row->email. '</a><br/>'.
						'<b>Membership ID</b> - '. $row->member_id. '<br/>'.
						'</td><td><b class="teacher_edit">'.
						$row->id.
						'</b></tr>';
		}
		$HTML .= '</tbody></table></div>';

		return $HTML;
	}


	function getStudentsAdmin($pViewLimit = 3){
		$T = $this->login->getUserId();
		
		$res = $this->DB->get(	" SELECT s.id as s_id, s.first_name as s_fn, s.last_name as s_ln, s.birthdate, r.teacher_id as t_id, i.name as instrument, t.first_name as t_fn, t.last_name as t_ln, t.member_id FROM student s LEFT JOIN teacher_registration r ON r.student_id = s.id LEFT JOIN instruments i ON r.instrument_id = i.id LEFT JOIN teacher t ON r.teacher_id = t.id ORDER BY s_fn ASC " );

		$len = mysql_affected_rows();
		
		$res = $this->DB->get(	" SELECT s.id as s_id, s.first_name as s_fn, s.last_name as s_ln, s.birthdate, r.teacher_id as t_id, i.name as instrument, t.first_name as t_fn, t.last_name as t_ln, t.member_id FROM student s LEFT JOIN teacher_registration r ON r.student_id = s.id LEFT JOIN instruments i ON r.instrument_id = i.id LEFT JOIN teacher t ON r.teacher_id = t.id ORDER BY s_fn ASC LIMIT 0, $pViewLimit " );

		$thisLen = mysql_affected_rows();
		
		$oddRow = 0;

		$HTML = '<div id="getStudentsAdmin"><h1>Registered students ('.$thisLen.'/'.$len.')</h1><table class="dash dash_hov">';
		$HTML .= '<thead><tr><td width="100%">Teacher Information</td><td>Edit</td></tr></thead><tbody>';

		while( $row = mysql_fetch_object($res)){
			$bday = substr($row->birthdate, 0, 4) + 0;
			$HTML .= '<tr';
						if($oddRow++ % 2)
							$HTML .= ' class="odd"';
			$HTML .= '><td>'. 
						'<b>Name</b> - '. $row->s_fn. ' '. $row->s_ln. '<br/>'.
						'<b>Age</b> - '. (2011 - $bday). '<br/>';

			if( $row->t_fn ){
				$HTML .=	'<b>Teacher</b> - '. $row->t_fn. ' '. $row->t_ln .'<br/>'.
						'<b>Teacher Membership ID</b> - '. $row->member_id. '<br/>'.
						'<b>Instrument</b> - '. $row->instrument. '</td>';
			}
			else{
				$HTML .= '<b>Teacher</b> - <em>No teacher assigned</em>';
			}
						
			$HTML .= '<td><b class="student_edit_admin">'.
						$row->s_id.
						'</b></tr>';
		}
		$HTML .= '</tbody></table></div>';

		return $HTML;
	}

	function getStudents(){
		$T = $this->login->getUserId();
		$res = $this->DB->get(	" SELECT s.id, s.first_name, s.last_name, s.birthdate, i.name as instrument ".
										" FROM student s ".
										" JOIN teacher_registration r ON r.student_id = s.id ".
										" JOIN instruments i ON i.id = r.instrument_id ".
										" WHERE r.teacher_id = $T ".
										" ORDER BY s.first_name " );

		$len = mysql_affected_rows();
		$oddRow = 0;

		$HTML = '<h1>Your current students ('.$len.')</h1><table class="dash dash_hov">';
		$HTML .= '<thead><tr><td>Student</td><td>Age</td><td width="100%">Instrument</td><td>Edit</td></tr></thead><tbody>';

		while( $row = mysql_fetch_object($res)){
			$bday = substr($row->birthdate, 0, 4) + 0;
			$HTML .= '<tr';
						if($oddRow++ % 2)
							$HTML .= ' class="odd"';
			$HTML .= '><td>'. 
						$row->first_name. ' '. $row->last_name. 
						'</td><td>'.
						(2011 - $bday).
						'</td><td>'.
						$row->instrument. 
						'</td><td><b class="student_edit">'.
						$row->id.
						'</b></tr>';
		}
		$HTML .= '</tbody></table>';

		return $HTML;
	}

	function execute()
	{
		if( $this->login->isLoggedIn() )
			include '/home/a2647781/public_html/lobster/view/dashboard.php';
		else
			header('Location: /home/a2647781/public_html/lobster/');
	}
}