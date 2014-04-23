<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
<title>Torcedor Apaixonado</title>
<link rel="stylesheet" type="text/css" href="style.css" /> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script> 
<script type="text/javascript" src="jslide.js"></script>
</head>
<body>

<h1>Torcedor Apaixonado!</h1>
<p>Selecione o time que você torce</p>

<ul class="canvasShell jcarousel-skin-tango" id="mycarousel"> 
  <li>
     <img src="img/vasco_3.png" alt="Vasco da Gama" id="vasco" /><p>Vasco</p> 
  </li> 
  <li>
     <img src="img/spfc_3.png" alt="Sao Paulo Futebol Clube" id="spfc" /><p>São Paulo</p> 
  </li>
  <li>
     <img src="img/santos_3.png" alt="Santos Futebol Clube" id="santos" /><p>Santos</p> 
  </li>
  <li>
     <img src="img/uniao_3.png" alt="Uniao Sao Joao de Araras" id="uniao" /><p>União São João</p> 
  </li>
  <li>
     <img src="img/palmeiras_3.png" alt="Palmeiras" id="palmeiras" /><p>Palmeiras</p> 
  </li>
  <li>
     <img src="img/inter_3.png" alt="Internacional" id="inter" /><p>Internacional</p> 
  </li>
  <li>
     <img src="img/gremio_3.png" alt="Gremio" id="gremio" /><p>Grêmio</p> 
  </li> 
  <li>
     <img src="img/fluminense_3.png" alt="Fluminense" id="fluminense" /><p>Fluminense</p> 
  </li>
  <li>
     <img src="img/flamengo_3.png" alt="Flamengo" id="flamengo" /><p>Flamengo</p> 
  </li>
  <li>
     <img src="img/corinthians_3.png" alt="Corinthians" id="corinthians" /><p>Corinthians</p> 
  </li>
  <li>
     <img src="img/botafogo_3.png" alt="Botafogo" id="botafogo" /><p>Botafogo</p> 
  </li>
</ul> 

<p class="copy">Copyright 2011 <a href="http://www.rodrigo-silveira.com" target="_blank">Rodrigo Silveira</a>. Todos os direitos reservados.</p>

<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
  FB.init({
    appId  : '144186038971761',
    status : true, // check login status
    cookie : true, // enable cookies to allow the server to access the session
    xfbml  : true  // parse XFBML
  });
</script>
<div id="me"></div>

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-20148108-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

function regit(tm){
  $.get('set.php?t='+tm, function(r){
    var IMG = 'http://formigone.com/apps/torcedor/img/'+tm+'_f.png';
      FB.ui(
      {
          method: 'stream.publish',
          attachment: {
            name: 'torce pro '+r,
            caption: 'Declare agora seu amor pelo seu time',
            description: (
              ' '
            ),
            href: 'http://apps.facebook.com/torcedor/',
            media: [
            {
              type: 'image',
              href: 'http://apps.facebook.com/torcedor/',
              src: IMG
            }
          ]
          },
          action_links: [
            { text: 'Torcedor Apaixonado', href: 'http://apps.facebook.com/torcedor/' }
          ]
        },
        function(response) {
          if (response && response.post_id) {} else {}
        }
      );
  });
}

$('#mycarousel img').click(function(){regit($(this).attr('id'));});
</script>
</body>
</html>