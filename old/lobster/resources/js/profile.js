var controls = {
	signout : function(){
		$.get('/lobster/model/authenticate.php?q=out', function(res){
			window.location = '/lobster';
		});
	},
	
	students : function(){
		window.location = '?controller=dashboard';
	},
	
	users : function(){
		window.location = '?controller=dashboard';
	},
	
	payments : function(){
		window.location = '?controller=payment';
	},
	
	profile : function(){
		window.location = '?controller=profile';
	},
	
	venue : function(){
		window.location = '?controller=venue';
	},
	
	events : function(){
		window.location = '?controller=events';
	}
};

function hideEditForm(){
	$('#edit_form').fadeOut(150);
}

function showAlert(pTitle, pMessage)
{
	$('#light_box h1').text(pTitle);
	$('#light_box p').text(pMessage);
	$('#light_box').css('display','block')
}

$('#light_box input').live('click', function(){
	$('#light_box').fadeOut(150);
});

function showEditForm(pTitle, pContent){
	$('#edit_form h1').text(pTitle);
	$('#edit_form .content').html(pContent);
	$('#edit_form').css('display', 'block');
}

$('#controls li').live('click', function(){
	var action = $(this).attr('name');

	try {
		controls[action].call();
	}

	// throws if element's NAME attribute doesn't have a matching function here
	catch(e){
		showAlert('Invalid Action', 'You have performed an invalid action');
	}
});

$('.payment_edit').click(function(){
	var teacher = $(this).text();
	$.get('/lobster/controller/forms.php?q=EditPayment&teacher='+teacher, function(res){
		showEditForm('Returning from async call', res);
	});
});

$('#editPay_cancel').live('click', function(){
	hideEditForm();
});