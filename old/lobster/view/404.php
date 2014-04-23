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
		<li name="link_1">link 1 </li>
		<li name="link_2">link 2 </li>
		<li name="link_3">link 3 </li>
		<li name="link_4">link 4 </li>
		<li name="signout">Sign out</li>
	  </ul>
   </div>
 </div>
 
<div id="body">
  
	<h1>Error 404 ='(</h1>
	<p>The page you have requested could not be found. Please contact your system admin [before applying a poor grade on his assignment].</p>
	<p>This page is generated whenever the controller being requested is not found in the application folder.  Be sure the controller name in the URL parameter <em>controller</em> is spelled correctly.</p>
	<p>Finally, since <em>abandoning</em> users at a dead end 404 page is not very polite, here's a quick link <a href="index.php?controller=dashboard">back to the dashboard</a>.  If you're not logged in, attempting to access the dashboard will result in a redirect to the main landing page. </p>

</div>

<div id="footer">
     <p>Copyright &copy; 2011 Rodrigo Silveira. All rights reserved. </p>
</div>

<?php
	echo $this->jLib;
?>

</body>
</html>