<?php
session_start();

require_once '/home/a2647781/public_html/lobster/model/database.class.php';

class DbSelect
{
	private $DB;
	private $command;
	
	public function __construct($pCommand = ''){
		$this->command = $pCommand;
		$this->DB = new Database();
	}
	
	public function exec(){
		// dynamically form function name
		$func = 'get' . $this->command;

		// attempt to polymorphically call function
		if(method_exists($this, $func))
			return $this->{$func}();

		// return if chosen function doesn't exist
		return 'Error: the function you requested does not exist in model DB-Select';
	}
	
	private function getNewTeacher(){
		$first_name = $_REQUEST['first_name'];
		$last_name = $_REQUEST['last_name'];
		$phone = $_REQUEST['phone'];
		$email = $_REQUEST['email'];
		$member_id = $_REQUEST['member_id'];
		$role = $_REQUEST['role'];

		$res = $this->DB->select( " SELECT * FROM teacher WHERE member_id = '".
					$member_id ."' AND first_name = '". 
					$first_name ."' AND last_name = '". 
					$last_name ."' " );
					
		if ( $res )
			return 'already';
		// create access account with default password of byui123 hashed in MD5
		$account = $this->DB->insert( "user_accounts",
							"email, password, role",
							"'$email', '2135a20cd19971ac8297bf1fa3c95a8b', '$role'" );
		
		$teacher = $this->DB->insert( "teacher",
							"first_name, last_name, phone, email, member_id, account_id",
							"'$first_name', '$last_name', '$phone', '$email', '$member_id', '".mysql_insert_id()."'" );
							
		if( $account && $teacher )
			return 'success';
		
		return var_dump($account).var_dump($teacher);
	}
	
	private function getNewStudentAdmin(){
		$first_name = $_REQUEST['first_name'];
		$last_name = $_REQUEST['last_name'];
		$birthdate = $_REQUEST['birthdate'];
		$instrument = $_REQUEST['instrument'];
		$teacher = $_REQUEST['teacher'];

		$res = $this->DB->select( " SELECT * FROM student WHERE  birthdate = '".
					$birthdate ."' AND first_name = '". 
					$first_name ."' AND last_name = '". 
					$last_name ."' " );

		// student already in database
		if( $res ){
			return 'already';
		}

		// new student
		else{
			$this->DB->insert( "student",
						"first_name, last_name, birthdate",
						"'$first_name', '$last_name', '$birthdate'" );

			$this->DB->insert( "teacher_registration",
						"teacher_id, student_id, instrument_id",
						"'$teacher', '".mysql_insert_id()."', '$instrument'" );

			return 'success';
		}
		
	}

	private function getStudentInfo(){
		$first_name = $_REQUEST['first_name'];
		$last_name = $_REQUEST['last_name'];
		$birthdate = $_REQUEST['birthdate'];
		$instrument = $_REQUEST['instrument'];

		$res = $this->DB->select( " SELECT * FROM student WHERE  birthdate = '".
					$birthdate ."' AND first_name = '". 
					$first_name ."' AND last_name = '". 
					$last_name ."' " );

		// student already in database
		if( $res ){

			// find out who is teaching student
			$rel = $this->DB->select( " SELECT r.teacher_id, r.student_id, r.instrument_id, r.id FROM teacher_registration r JOIN student s ON r.student_id = s.id WHERE s.id = $res->id " );
			
			// student not being taught by anyone
			if( !$rel ){

				$this->DB->insert( "teacher_registration",
							"teacher_id, student_id, instrument_id",
							"'".$_SESSION['user_id']."', '".$res->id."', '$instrument'" );

				return 'success';
			}

			// student already being taught by requesting teacher
			if( $rel->teacher_id == $_SESSION['user_id'] )
				return 'already';

			// student being taught by someone else
			else
				return 'different';
		}

		// new student
		else{
			$this->DB->insert( "student",
						"first_name, last_name, birthdate",
						"'$first_name', '$last_name', '$birthdate'" );

			$this->DB->insert( "teacher_registration",
						"teacher_id, student_id, instrument_id",
						"'".$_SESSION['user_id']."', '".mysql_insert_id()."', '$instrument'" );

			return 'success';
		}
	}
}