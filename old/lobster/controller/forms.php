<?php

if( !isset($_REQUEST['q']) )
	return 0;
	
require '/home/a2647781/public_html/lobster/model/forms.php';

$form = new Forms($_REQUEST['q']);
echo $form->getForm();