<?php

class Database
{
	private $db_host;
	private $db_user;
	private $db_password;
	private $db_name;
	private $con;
	private $isConnected;
	
	public function __construct(){
		$this->db_host = 'mysql10.000webhost.com';
		$this->db_user = 'a2647781_seadmin';
		$this->db_password = '5#d)d9!SFhd_=3+$26Sdfpqie5@3^~!2#)sdf@#FG$Jas';
		$this->db_name = 'a2647781_lobster';
		
		$this->connect();
	}
	
	public function status(){
		return $this->isConnected;
	}
	
	private function connect(){
		$this->con = mysql_connect($this->db_host, $this->db_user, $this->db_password);
		if (!$this->con) {
			die('Could not connect: ' . mysql_error());
			exit();
		}

		mysql_select_db($this->db_name, $this->con);
		$this->isConnected = 1;
	}

	public function disconnect(){
		
	}
	
	public function select($query = ''){
		$res = mysql_query($query);
		return mysql_fetch_object($res);
	}
	
	public function get($query = ''){
		return mysql_query($query);
	}
	
	public function update($pTable = '', $pSet = '', $pWhere){
		return mysql_query( " UPDATE $pTable SET $pSet WHERE $pWhere " );
	}
	
	public function remove($pTable = '', $pWhy = ''){
		return mysql_query( " DELETE FROM $pTable WHERE $pWhy ");
	}
	
	public function insert($pTable = '', $pCols = '', $pVals = ''){
		return mysql_query( " INSERT INTO $pTable ( $pCols ) VALUES ( $pVals ) " );
	}
	
	public function inserts($pTable = '', $pCols = '', $pVals = ''){
		return mysql_query( " INSERT INTO $pTable ( $pCols ) VALUES $pVals " );
	}
}