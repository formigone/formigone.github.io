var slideDelay = 4500;

function rotate(pSlider)
{
   var top = $('#'+pSlider+' li')[0];
   var width = parseInt($(top).css('width'));

 $(top).animate({width:0},900 , function(){
    $('#'+pSlider+ ' ul').append(top);
    $(top).css('width', width);
    setTimeout(function(){rotate('slider');}, slideDelay);
 });
}

function showAlert(pTitle, pMessage)
{
	$('#light_box h1').text(pTitle);
	$('#light_box p').text(pMessage);
	$('#light_box').css('display','block');
}

$('#light_box input').click(function(){
	$('#light_box').fadeOut(150);
});

function getDemoLogin(pType)
{
   $('#mf_demo').html('<em id="mf_demo">help</em>');
   
   var login = '';
   var password = 'byui123';
   
   switch(pType)
   {
      case 'teacher' :
         login = 't_rodrigo2@byui.edu';
         break;
      case 'admin' :
         login = 'a_rodrigo2@byui.edu';
         break;
   }
   
   $('#mf_login').attr('value', login);
   $('#mf_password').attr('value', password);

}

$('#signin').click(function(){

   $(this).slideUp(400, function(){
      $('#mf_signin').css('display','block');
      $('#mf_login').focus();
   });
});

$('#mf_submit').click(function(){
	var u = $('#mf_login').val();
	var p = $('#mf_password').val();

	$.get('/lobster/model/authenticate.php?u='+u+'&p='+p, function(res){

		if(res == 'fail')
			showAlert('Invalid Login', 'You have entered an invalid user id or password.');
		else
			window.location = '?controller=dashboard';
	});

	return false;
});

$('form').submit(function(){
	$('#mf_submit').click();
	return false;
});


$('#mf_demo').live('click', function(){
   $(this).append(
      '<div id="mf_help">'+
      '<p>Login as: </p>'+
      '<input type="radio" name="mf_key" value="teacher"/>'+
      '<label>Teacher</label><br/>'+
      '<input type="radio" name="mf_key" value="admin"/>'+
      '<label>Admin</label>'+
      '</div>'
   );
   
   $('#mf_help input').click(function(){
      var loginType = $(this).val();
      setTimeout(function(){getDemoLogin(loginType);}, 0);
   });
});

$('a').focus(function(){
   $(this).css('outline', 'none');
});

window.onload = function(){setTimeout(function(){rotate('slider');}, slideDelay);};