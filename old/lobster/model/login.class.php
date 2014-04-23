<?php
session_start();

require '/home/a2647781/public_html/lobster/model/database.class.php';

class Login
{
	private $db;
	private $email;
	private $password;
	private $role;
	private $id;
	
	public function __construct(){
		$this->db = new Database();
		$this->email = @$_GET['u'];
		$this->password = @$_GET['p'];
	}
	
	public function isLoggedIn(){
		return @$_SESSION['is_logged'];
	}
	
	public function getRole(){
		return @$_SESSION['user_role'];
	}
	
	public function getUserId(){
		return @$_SESSION['user_id'];
	}
	
	public function authenticate(){
		$row = $this->db->select(" SELECT id, role FROM user_accounts WHERE ".
				"email = '$this->email' AND password = '".md5($this->password)."' ");

		if($row){
			$_SESSION['user_id'] = $row->id;
			$_SESSION['user_role'] = $row->role;
			$_SESSION['is_logged'] = 1;
		}
		else{
			echo 'fail';
			exit();
		}
		
		return $row->role;
	}
	
	public function getDb(){
		return $this->db;
	}
	
	public function logout(){
		$_SESSION['user_id'] = 0;
		$_SESSION['user_role'] = 0;
		$_SESSION['is_logged'] = 0;
		
		return 1;
	}
}