<?php

mysql_connect('mysql10.000webhost.com', 'a2647781_apps', 'f0r3ns1cs')
  or die('Could not connect: ' . mysql_error());
mysql_select_db('a2647781_chrome') or die('Could not select database');

$result = mysql_query("SELECT * FROM omijuki ORDER BY RAND() LIMIT 0,1");
$row = mysql_fetch_array($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html> 
<head>
  <title>Omikuji &laquo; Fortune Cookie</title>
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
  background: url(http://formigone.com/apps/omikuji/ck02-fb.jpg) center center no-repeat;
  overflow: hidden;
  cursor: pointer;
}

#fbshare {
  position: absolute;
  bottom: 10px;
  left: 10px;
}

p {
  text-align: center;
  position: absolute;
  bottom: 10px;
  width: 96%;
  margin: 0;
  padding: 0;
}

h1 {
  display: none;
  text-align: center;
  height: 30px;
  color: #333;
  font-family: 'Vollkorn';
  margin: 0;
  padding: 0;
  cursor: pointer;
}

</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
</head>
<body>
<div id="stg"></div>
<h1 id="ftn"></h1>

<p>Copyright &copy; 2011 <a href="http://www.rodrigo-silveira.com">Rodrigo Silveira</a>. All rights reserved.</p>

<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
  FB.init({
    appId  : '181944331837601',
    status : true, // check login status
    cookie : true, // enable cookies to allow the server to access the session
    xfbml  : true  // parse XFBML
  });
</script>

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-20148108-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

function getFortune(){$('#ftn').text('<?php echo $row['fortune']; ?>');$('#stg').fadeIn('slow',function(){$('#ftn').fadeIn(899);});}setTimeout(getFortune,500);

function likeit(){
  
  FB.ui(
  {
      method: 'stream.publish',
      attachment: {
        name: 'opened an Omikuji Fortune Cookie',
        caption: '\"<?php echo $row['fortune']; ?>\"',
        description: (
          ' '
        ),
        href: 'http://apps.facebook.com/omikuji-fws/',
        media: [
        {
          type: 'image',
          href: 'http://apps.facebook.com/omikuji-fws/',
          src: 'http://formigone.com/apps/omikuji/ck02-fb.jpg'
        }
      ]
      },
      action_links: [
        { text: 'Omikuji', href: 'http://apps.facebook.com/omikuji-fws/' }
      ]
    },
    function(response) {
      if (response && response.post_id) {} else {}
    }
  );
}

$('#stg').click(function(){likeit();});
$('#ftn').click(function(){likeit();});
</script>
</body>
</html>