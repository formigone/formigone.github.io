<?php
//
// Poor man's way of detecting if app is being accessed properly
//
if (strpos(strtoupper($_SERVER["HTTP_USER_AGENT"]), "WEBKIT") === false || isset($_SERVER["HTTP_REFERER"]))
        header("Location: https://chrome.google.com/webstore/detail/klloefpijaofgelefjimlhdikagaegfe?utm_source=chrome-ntp-icon", true, 307);
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Speed Reader Trainer</title>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <link rel="stylesheet" href="css/style.css"/>
   </head>
   <body>
      <h1 class="title">Speed Reader Trainer</h1>
      <div id="rokkoShell">
         <div class="paragraphs">
            
            <h2>Getting Started</h2>
            <p>The text used in this application is taken from the book "The Secret Garden", by Frances Hodgson Burnett. Only fix your eyes lightly on each word as they appear, and try not to sound the word out in your mind. Some people can only achieve this at first by playing soothing music on the background. If at first you feel your understanding is low, don't worry. With practice you will speed up your eyes, and boost your comprehension and retention.</p>
            <p><span id="startNow"></span></p>
            <hr/>
            <h2>Speed Reading</h2>
            <p>Believe it or not, the average adult reader reads an average of 250 words per minute (WPM), at about 70% comprehension. The main factors that slow them down (or that keep them at that same rate) are:
            <ul>
               <li>Sub-vocalizing words (sounding them out in their head, even when reading silently)</li>
               <li>Backtracking (looking back to re-read a work previously read)</li>
            </ul>
            Thus, the great key to improving your reading speed to <b>only scan words with your eyes</b>, and let your brain take care of understanding what you read. With practice, you'll be able to look at a word, and your brain will get the meaning.</p>
            <p>The way this application makes you a super fast reader (reaching upwards of 700 WPM within a few weeks) is that it forces your eyes to only glance a word, then run to the next, and so on. But training your eyes to follow this routine (and to develop this habit), you will break the two barriers that make you a slow (or at least as "average") reader.</p>
         </div>
      </div>
      <hr/>
      <p>Copyright <a href="http://www.rodrigo-silveira.com">Rodrigo Silveira</a>. All rights reserved.</p>
      
      <script src="js/rokkonline.js"></script>
      <script>
          var _gaq = _gaq || [];
         _gaq.push(['_setAccount', 'UA-15090706-1']);
         _gaq.push(['_trackPageview']);
         (function() {
         var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
         ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
         var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
         })();
      </script>
      <script>var _0xcffa=["\x52\x6F\x6B\x6B\x6F","\x63\x6C\x69\x63\x6B","\x72\x6F\x6B\x6B\x6F\x53\x68\x65\x6C\x6C","\x69\x6E\x69\x74","\x61\x64\x64\x45\x76\x65\x6E\x74\x4C\x69\x73\x74\x65\x6E\x65\x72","\x23\x73\x74\x61\x72\x74\x4E\x6F\x77","\x71\x75\x65\x72\x79\x53\x65\x6C\x65\x63\x74\x6F\x72"];(function (){var _0x2964x1= new com[_0xcffa[0]].RokkoReader();document[_0xcffa[6]](_0xcffa[5])[_0xcffa[4]](_0xcffa[1],function (){_0x2964x1[_0xcffa[3]](_0xcffa[2]);} );} )();</script>
   </body>
</html>
	