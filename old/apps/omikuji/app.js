var fortunes = [
"Sometimes the best way to be happy is to learn to let go of things you tried hard to hold on to.",
"People don't change, they just become who they are really meant to be.",
"One of the best ways to measure people is to watch the way they behave when something free is offered.",
"Don't quit because something went wrong. Quit because you tried your hardest and nothing made it better.",
"Those who will listen to nothing will fall for anything.",
"The secret of creativity is knowing how to hide your sources.",
"He who angers you conquers you.",
"A fool will learn nothing from a wise man, but a wise man will learn much from a fool.",
"Don't let today be the tomorrow you were worried about Yesterday.",
"Nothing worth having comes easy.",
"A mirror does not show who you are, instead it shows who you pretend to be.",
"Someone doesn't have to be perfect to be exactly what you need.",
"Time heals everything, but can everything heal in time?",
"If you cannot find the way, make one.",
"The only true wisdom is in knowing you know nothing.",
"Sometimes it is a good feeling to feel nothing.",
"Wisdom is nothing more than healed pain.",
"Never ruin an apology with an excuse.",
"An error does not become a mistake, until you refuse to correct it.",
"Sometimes you have to close your eyes to see better.",
"Laugh because it's funny, not because everyone else is.",
"The problem is not the problem. The problem is one's attitude about the problem.",
"Don't look where you fall, but where you slipped.",
"Don't ask someone for their opinion unless you're ready to listen.",
"You learn to trust by daring to try.",
"One who makes no mistakes makes nothing.",
"Those who are afraid to fall,will never fly.",
"Stop doing permanent things for temporary people.",
"The only thing worse than losing someone, is losing yourself.",
"Time you enjoy wasting, was not wasted.",
"In life what isn't hard isn't worth having at all.",
"Be careful what you wish for, because you might wish you'd been more careful.",
"Nothing new cannot start without letting the old go.",
"School brings knowledge, Life brings wisdom.",
"Believe in miracles, but don't depend on them.",
"The difference between the impossible and possible lies in a person's determination.",
"Not everything is meant to be, but everything is worth a try.",
"If you can't amaze people with your intelligence, confuse them with your wisdom.",
"To change your life you must change the way you think.",
"Be brief.",
];
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-15090706-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

function getFortune() {
   var rand = parseInt(Math.random() * fortunes.length);
   $('#ftn').text(fortunes[rand]);
   $('#stg').fadeIn('slow', function(){
      $('#ftn').fadeIn(899);
   });
}

var androidEl = document.getElementById('androidLink');
var androidUrl = 'https://play.google.com/store/apps/details?id=com.formigone.omikuji';

androidEl.addEventListener('click', function(){
   window.open(androidUrl);
});

setTimeout(getFortune, 500);

