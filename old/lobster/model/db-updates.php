<?php
session_start();

require '/home/a2647781/public_html/lobster/model/database.class.php';

class DbUpdates
{
	private $DB;
	private $command;
	
	public function __construct($pCommand = ''){
		$this->command = $pCommand;
		$this->DB = new Database();
	}
	
	public function exec(){
		// dynamically form function name
		$func = 'update' . $this->command;

		// attempt to polymorphically call function
		if(method_exists($this, $func))
			return $this->{$func}();

		// return if chosen function doesn't exist
		return 'Error: the function you requested does not exist in model DB-Update';
	}

		private function updateStudentOverride(){

		$first_name = $_REQUEST['first_name'];
		$last_name = $_REQUEST['last_name'];
		$birthdate = $_REQUEST['birthdate'];
		$instrument = $_REQUEST['instrument'];
		$teacher_id = $_SESSION['user_id'];

		$res = $this->DB->select( " SELECT id FROM student WHERE  birthdate = '".
					$birthdate ."' AND first_name = '". 
					$first_name ."' AND last_name = '". 
					$last_name ."' " );

		$rel = $this->DB->select( " SELECT id FROM teacher_registration WHERE student_id = $res->id AND instrument_id = $instrument " );

		$this->DB->update( "teacher_registration", "teacher_id = $teacher_id", "id = $rel->id" );
		return 'success';
	}

	private function updatePersonalInfo(){

		$id = $_REQUEST['id'];
		$first_name = $_REQUEST['first_name'];
		$last_name = $_REQUEST['last_name'];
		$birthdate = $_REQUEST['birthdate'];
		$instrument = $_REQUEST['instrument'];
		
		$res = $this->DB->update( "student", 
								" birthdate = '". $birthdate ."', ".
								" first_name = '". $first_name ."', ".
								" last_name = '". $last_name ."' ",
								"id = $id" );

		$res = $this->DB->update( "teacher_registration", 
								" instrument_id = ". $instrument,
								"student_id = $id" );								
		return $res;
	}
	
	private function updateUnregister(){
		$id = $_REQUEST['id'];

		return $this->DB->remove( "teacher_registration", "student_id = $id");
	}
}