<!doctype html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="">
   <meta name="author" content="">
   <link rel="shortcut icon" href="/assets/img/favicon.png">

   <title><?= $page['title']; ?></title>

   <link href="/assets/css/bootstrap.css" rel="stylesheet">
   <link href="/assets/css/main.css" rel="stylesheet">
   <link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>

   <link
      href="data:image/x-icon;base64,AAABAAEAEBAQAAAAAAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAA/Pz8AKNfFQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAIiIiAAAAAAAiIiIAAAAAACIRIgAAAAAAIhEiAAAAAAAiESIAAAAAACIRIgAAAAAAIhEiIiIiAAAiESIiIiIAACIRERERIgAAIhEREREiAAAiESIiIiIAACIRIiIiIgAAIhEREREiAAAiERERESIAACIiIiIiIgAAIiIiIiIiDgfwAA4H8AAOB/AADgfwAA4H8AAOB/AADgAQAA4AEAAOABAADgAQAA4AEAAOABAADgAQAA4AEAAOABAADgAQAA"
      rel="icon" type="image/x-icon"/>

   <!--[if lt IE 9]>
   <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
   <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
   <![endif]-->
</head>

<body>

<div class="navbar navbar-default navbar-fixed-top">
   <div class="container">
      <div class="navbar-header">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
         </button>
         <a class="navbar-brand" href="/"><b>Formigone</b></a>
      </div>
      <div class="navbar-collapse collapse">
         <ul class="nav navbar-nav navbar-right">
            <li><a href="#products">Products</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
         </ul>
      </div>
   </div>
</div>

<div id="headerwrap">
   <div class="container">
      <div class="row">
         <div class="col-lg-6">
            <h1>Web-based & Mobile software done right</h1>
            <a href="#products" class="btn btn-warning btn-lg">Learn more</a>
         </div>
         <div class="col-lg-6">
            <img class="img-responsive" src="/assets/img/ipad-hand.png" alt="">
         </div>
      </div>
   </div>
</div>

<a name="products"></a>

<div class="container">
   <div class="row mt centered">
      <div class="col-lg-6 col-lg-offset-3">
         <h1>Creative Robust Solutions to Make Life Better</h1>

         <h3>Even complex problems can be solved with simple, creative solutions. Our software is developed with
            simplicity and user experience as priorities.</h3>
      </div>
   </div>

   <div class="row mt centered">
      <div class="col-lg-4">
         <a href="http://bigbrotherjs.com">
            <img src="assets/img/big-brother-js-logo.png" width="180" alt="Big Brother JS">
         </a>
         <h4>Big Brother JS</h4>

         <p>A JavaScript library that monitors user behavior (mouse movement, clicks, keystrokes, etc.) on websites, and
            allows you to playback a recording of their sessions.</p>

         <p><a href="http://bigbrotherjs.com" class="btn btn-success">Learn More</a></p>
      </div>

      <div class="col-lg-4">
         <a href="http://th.formigone.com">
            <img src="assets/img/th-logo.png" width="180" alt="th PHP Framework">
         </a>
         <h4>th PHP Framework</h4>

         <p>Possibly the most concise *VC in the planet. A good choice for simple PHP projects that need more than loose
            files - and less than a heavy, full-blown framework.</p>

         <p><a href="http://th.formigone.com" class="btn btn-success">Learn More</a></p>
      </div>

      <div class="col-lg-4">
         <a href="https://chrome.google.com/webstore/detail/speed-reading-trainer/klloefpijaofgelefjimlhdikagaegfe">
            <img src="assets/img/speed-reading-trainer-banner.png" width="180" alt="Speed Reading Trainer">
         </a>
         <h4>Speed Reading Trainer</h4>

         <p>A Google Chrome app that helps you boost your reading speed and increase comprehension rate. Train your eyes
            and brain, and build habits and techniques like the world's fastest readers.</p>

         <p><a href="https://chrome.google.com/webstore/detail/speed-reading-trainer/klloefpijaofgelefjimlhdikagaegfe"
               class="btn btn-success">Download Now</a></p>
      </div>
   </div>

   <div class="row mt centered">
      <div class="col-lg-4">
         <a href="https://play.google.com/store/apps/details?id=com.formigone.omikuji">
            <img src="assets/img/omikuji-banner.png" width="180" alt="Omikuji Fortune Cookie">
         </a>
         <h4>Omikuji Fortune Cookie</h4>

         <p>A fun Android application that "brings good news to the people who are ready for it." The mythical Internet
            god has combined forces with the almighty fortune giver from ancient Japanese legends.</p>

         <p>
            <a href="https://play.google.com/store/apps/details?id=com.formigone.omikuji" class="btn btn-success">Download
               Now</a>
         </p>
      </div>

      <div class="col-lg-4">
         <a href="https://play.google.com/store/apps/details?id=com.formigone.life">
            <img src="assets/img/game-of-life-logo.png" width="180" alt="Conway's Game of Life">
         </a>
         <h4>ASCII Game of Life</h4>

         <p>No, this is not the board game. This game is John Conway's Game of Life - ASCII version. A zero
            player game - a cellular automaton - a discrete model of life based on simple 4 rules.</p>

         <p>
            <a href="https://play.google.com/store/apps/details?id=com.formigone.life" class="btn btn-success">Download
               Now</a>
         </p>
      </div>
   </div>
</div>

<div class="container">
   <div class="row mt centered">
      <div class="col-xs-8 col-xs-offset-2">
         <hr/>
      </div>
   </div>
</div>

<a name="about"></a>

<div class="container">
   <div class="row mt centered">
      <div class="col-lg-6 col-lg-offset-3">
         <h1>About Formigone Software</h1>

         <h3>Our mission is to make people's life better through technology.</h3>
      </div>
   </div>

   <div class="row mt centered">
      <div class="col-lg-6 col-lg-offset-3">
         <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
               <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
               <li data-target="#carousel-example-generic" data-slide-to="1"></li>
               <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner">
               <div class="item active">
                  <img src="/assets/img/p01.png" alt="">
               </div>
               <div class="item">
                  <img src="/assets/img/p02.png" alt="">
               </div>
               <div class="item">
                  <img src="/assets/img/p03.png" alt="">
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="row mt centered">
      <div class="col-lg-6 col-lg-offset-3">
         <p>We are a small software studio based in Salt Lake City, Utah. With both open-source and commercial software
            deployed in multiple platforms and form factors, we are constantly looking for new opportunities to improve
            lifes by creating quality software to solve everyday problems.</p>
      </div>
   </div>
</div>

<div class="container">
   <div class="row mt centered">
      <div class="col-xs-8 col-xs-offset-2">
         <hr/>
      </div>
   </div>
</div>

<a name="contact"></a>

<div class="container">
   <div class="row mt centered">
      <div class="col-lg-6 col-lg-offset-3">
         <h1>Contact Us</h1>

         <h3>Be a part of our mission and help make the world a better place!</h3>
      </div>
   </div>

   <div class="row mt centered">
      <div class="col-md-4">
         <img class="img-circle" src="/assets/img/rodrigo-silveira.jpg" width="140"
              alt="Rodrigo Silveira: Software Engineer">
         <h4>Rodrigo Silveira</h4>

         <p>Founder, Director, Software guy, Creative guy, and the wearer of every other hat worn in the company. Yes,
            that's our big secret - one man band!</p>

         <p>
            <a href="https://plus.google.com/+RodrigoSilveiraSoftware/about">
               <i class="glyphicon glyphicon-user"></i>
            </a>
            <a href="https://plus.google.com/+RodrigoSilveiraSoftware/posts">
               <i class="glyphicon glyphicon-comment"></i>
            </a>
            <a href="http://www.rodrigo-silveira.com">
               <i class="glyphicon glyphicon-globe"></i>
            </a>
         </p>
      </div>

      <div class="col-md-4">
         <img class="img-circle" src="/assets/img/github.png" width="140" alt="Formigone Software">
         <h4>Open-source projects</h4>

         <p>Check out our open-source projects hosted on GitHub. Our commercial apps are hosted privately, and source
            code is not publicly available.</p>

         <p>
            <a href="https://github.com/formigone">
               <i class="glyphicon glyphicon-floppy-disk"></i>
            </a>
         </p>
      </div>
   </div>
</div>

<div class="container">
   <hr/>
   <p class="centered">Copyright &copy; 2014 Formigone Software. All rights reserved.</p>
</div>


<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>

<script type="text/javascript">
   var _gaq = _gaq || [];
   _gaq.push(['_setAccount', 'UA-20148108-1']);
   _gaq.push(['_trackPageview']);

   (function() {
      var ga = document.createElement('script');
      ga.type = 'text/javascript';
      ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0];
      s.parentNode.insertBefore(ga, s);
   })();
</script>
</body>
</html>
