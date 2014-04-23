<?php

mysql_connect('mysql10.000webhost.com', 'a2647781_apps', 'f0r3ns1cs')
  or die('Could not connect: ' . mysql_error());
mysql_select_db('a2647781_chrome') or die('Could not select database');

$result = mysql_query("SELECT * FROM omijuki ORDER BY RAND() LIMIT 0,1");
$row = mysql_fetch_array($result);
?>
<!DOCTYPE html>
<html> 
<head>
  <title>Omikuji &laquo; Fortune Cookie</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="height=device-height,width=device-width; initial-scale=0.7; maximum-scale=1.0; user-scalable=0;" /> 
  <meta name="apple-mobile-web-app-status-bar-style" content="black" /> 
  <meta name="apple-mobile-web-app-capable" content="yes" />
<link href='http://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css'>
<style type="text/css">
* {
  color: #6a6aa0;
  text-decoration: none;
}
body {
  background: #fff;
  font-size: 12px;
}
#stg {
  display: none;
  margin: 50px auto 50px;
  width: 435px;
  height: 186px;
  background: url(ck02-fb.jpg) center center no-repeat;
  overflow: hidden;
}

p {
  text-align: center;
  position: absolute;
  bottom: 0;
  width: 96%;
}

h1 {
  display: none;
  text-align: center;
  height: 30px;
  color: #333;
  font-family: 'Vollkorn';
  margin: 0;
  padding: 0;
}
</style>
</head>
<body>
<div id="stg"></div>
<h1 id="ftn"></h1>
<p>Copyright &copy; 2011 <a href="http://www.rodrigo-silveira.com">Rodrigo Silveira</a>. All rights reserved.</p>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript">
setTimeout(function() {
  window.scrollTo(0, 1);
}, 1000);

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-20148108-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

function getFortune() {
   $('#ftn').text('<?php echo $row['fortune']; ?>');
   $('#stg').fadeIn('slow', function(){
      $('#ftn').fadeIn(899);
   });
}
setTimeout(getFortune,500);
</script>
</body>
</html>