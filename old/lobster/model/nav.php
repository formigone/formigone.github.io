<?php

class Nav
{
	private $role;
	private $logout;
	private $HTML;
	
	public function __construct($pRole){
		$this->role = $pRole;
		$this->logout = '<li name="signout">Sign out</li>';
		$this->HTML = '';
	}
	
	public function li(){
		switch( $this->role ){
		
			// Return admin nav
			case 'admin' :
				$this->HTML = 	'<li name="users">Users</li>'.
									'<li name="venue">Venues</li>'.
									'<li name="events">Events</li>'.
									'<li name="payments">Payments</li>';
				break;

			// Return teacher nav
			case 'teacher' :
				$this->HTML = 	'<li name="profile">Profile</li>'.
									'<li name="students">Students</li>'.
									'<li name="events">Festivals</li>'.
									'<li name="payments">Payments</li>';
				break;
			
		}
		
		return $this->HTML.$this->logout;
	}
}