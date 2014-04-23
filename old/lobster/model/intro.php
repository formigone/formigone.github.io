<?php

class Intro
{
	private $role;
	private $HTML;
	
	public function __construct($pRole){
		$this->role = $pRole;
		$this->HTML = '';
	}
	
	public function intro(){
			switch( $this->role ){
		
			// Return admin nav
			case 'admin' :
				$this->HTML = 	'<h1>Welcome, Admin!</h1>'.
									'<p>'.
									'In elit lacus, elementum id fringilla ac, interdum sit amet eros. Nulla purus leo, pharetra a placerat id, volutpat sit amet justo. Donec sagittis neque eu nisi iaculis nec molestie nisl tempus. Phasellus ultricies ante quis odio molestie porta. Maecenas eu cursus nunc. In quis lobortis massa. In feugiat justo quis mi blandit posuere. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Duis consequat, nisi vitae tristique vestibulum, nisi dolor molestie neque, a cursus felis est in lacus. Vestibulum aliquet turpis at mauris vestibulum feugiat. Duis in risus non libero tempus hendrerit. Vivamus ut sapien dolor, non suscipit est. In et ipsum lacus.'.
									'</p>';
				break;

			// Return teacher nav
			case 'teacher' :
				$this->HTML = 	'<h1>Welcome, Teacher!</h1>'.
									'<p>'.
									'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam tellus arcu, interdum eget porta in, adipiscing vel leo. Aliquam quam nunc, aliquet vel porta ultricies, mollis ac lectus. Aenean auctor eros dui, et convallis est. Aliquam ac nulla ut tortor ullamcorper fringilla ut et ante. Sed a elit enim, ac lacinia odio. Ut aliquet blandit ultricies. Cras velit dolor, accumsan in vulputate et, egestas id metus. Aliquam est eros, consectetur vitae semper ut, dignissim vitae enim. Sed nibh sapien, posuere a pulvinar dignissim, sodales vitae risus. Proin ultricies euismod mi vel ultricies.'.
									'</p>';
				break;
			
		}
		
		return $this->HTML;
	}
	
}