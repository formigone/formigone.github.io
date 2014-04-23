<?php
	echo $this->header, 
			$this->style, 
			$this->MF->getFavicon(), 
			$this->MF->getJq();
?>
	
</head>
<body>

<div id="header">
   <div id="title">
      <h1>Music Festival</h1>
	  <ul id="controls">
	  	<?php echo $this->nav->li(); ?>
	  </ul>
   </div>
 </div>
 
<div id="body">

	<?php 
		switch( $_SESSION['user_role'] )
		{
			case 'teacher' :
				echo 	$this->getDues();
				break;
				
			case 'admin' :
				echo 	$this->getOutstandingPayments(),
						$this->spaceHor(),
						$this->getPaymentStats();
				break;
		}
	?>

</div>

<div id="footer">
     <p>Copyright &copy; 2011 Rodrigo Silveira. All rights reserved. </p>
</div>

<?php
	echo $this->errLog, $this->editForm, $this->jLib;
?>

</body>
</html>