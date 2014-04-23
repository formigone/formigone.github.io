<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
  FB.init({
    appId  : '139777226083180',
    status : true, // check login status
    cookie : true, // enable cookies to allow the server to access the session
    xfbml  : true  // parse XFBML
  });
</script>

<div id="me"></div>

<script>
var
  div    = document.getElementById('me'),
  showMe = function(response) {
    if (!response.session) {
      div.innerHTML = '<em>Not Connected</em>';
    } else {
      FB.api('/me', function(response) {
var e=response['email']
      });
    }
  };
FB.getLoginStatus(function(response) {
  showMe(response);
  FB.Event.subscribe('auth.sessionChange', showMe);
});
</script>
