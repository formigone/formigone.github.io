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
		window.location = '?controller=venues';
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

$('#iv_submit').click(function(){
	var name = $('#iv_name').val();
	var address = $('#iv_address').val();
	if( name < 1 ){
		showAlert('Incomplete Request', 'Please enter a valid venue name');
		return 0;
	}
	
	if( address.length < 1 ){
		showAlert('Incomplete Request', 'Please enter a valid venue address');
		return 0;
	}
	
	$.get('/lobster/controller/forms.php?q=InsertVenue&name='+name+'&addr='+address, function(res){
		showAlert('Succes', 'You have added a new venue successfully.');
		window.location = '?controller=venues';
	});
});

$('.venue_edit').click(function(){
	var id = $(this).text();
	
	$.get('/lobster/controller/forms.php?q=EditVenue&id='+id, function(res){
		showEditForm('Edit Venue Information', res);
	});
});

$('#editVenue_cancel').live('click', function(){
	hideEditForm();
});


$("#gev_submit").live('click', function(){
	var id = $("#gev_id").val();
	var name = $("#gev_name").val();
	var addr = $("#gev_addr").val();
	
	if(name.length < 1){
		showAlert("Invalid Input", "Please enter a valid venue name");
		return 0;
	}
	
	if(addr.length < 1){
		showAlert("Invalid Input", "Please enter a valid venue address");
		return 0;
	}
	
	$.get('/lobster/controller/forms.php?q=UpdateVenue&name='+name+'&addr='+addr+'&id='+id, function(res){
		showAlert('Succes', 'You have updated a new venue successfully.');
		window.location = '?controller=venues';
	});
});