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
      <a href="#" id="signin">Sign in</a>
      <form id="mf_signin">
            <table>
            <tr>
                <td>
                  <label for="mf_login">User ID</label>
                </td>
                <td>
                  <input type="text" name="mf_login" id="mf_login" />
                </td>
                <td><em id="mf_demo">help</em></td>
            </tr>
            <tr>
                <td>
                  <label for="mf_password">Password</label>
                </td>
                <td>                  
                  <input type="password" name="mf_password" id="mf_password" />
                </td>
                <td>   
                  <input type="submit" id="mf_submit" value="Go" />
                </td>
            </tr>
            </table>
      </form>
   </div>
      
   <div id="slider_shell">
        <div id="slider">                                                                                                                                  
          <ul>
              <li><img src="resources/img/slideshow03.jpg" alt="Music Festival" /></li>
              <li><img src="resources/img/slideshow02.jpg" alt="Music Festival" /></li>
              <li><img src="resources/img/slideshow01.jpg" alt="Music Festival" /></li>
          </ul>
        </div>
        <a href="#" id="learn_more">Learn More</a>
   </div>
</div>

<div id="body">
  
  <ul>
      <li>
         <h1>Great Experience</h1>
         <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sed mollis nunc. Pellentesque a cursus dolor. </p>
      </li>
      <li class="three_cell">
         <h1>Memorable Events</h1>
         <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. </p>
      </li>
      <li>
         <h1>Register Today</h1>
         <p>Cras condimentum magna at massa egestas dapibus. Morbi facilisis dapibus nibh vel placerat. </p>
      </li>
  </ul>

</div>

<div id="footer">
     <p>Copyright &copy; 2011 Rodrigo Silveira. All rights reserved. </p>
</div>

<?php
	echo 	$this->errLog,
			$this->jLib;
?>

</body>
</html>