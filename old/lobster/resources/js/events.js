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

$('.payment_edit').click(function(){
	var teacher = $(this).text();
	$.get('/lobster/controller/forms.php?q=EditPayment&teacher='+teacher, function(res){
		showEditForm('Make a payment to teacher\'s account', res);
	});
});

$('#editPay_cancel').live('click', function(){
	hideEditForm();
});

$('#event_submit').click(function(){

	var name = $('#event_name').val();
	var venue = $('#event_venue option:selected').val();
	var cost = $('#event_cost').val();
		if( cost.indexOf('$') >= 0 )
			cost = parseFloat(cost.substr(1));
	var open = $('#event_open').val();
	var close = $('#event_close').val();
	
	if( name.length < 1 ){
		showAlert("Invalid Input", "Please enter a valid event name");
		return 0;
	}
	
	if( cost.length < 1 ){
		showAlert("Invalid Input", "Please enter a valid cost amount");
		return 0;
	}
	
	if( open.length < 10 ){
		showAlert("Invalid Input", "Please enter a valid open date");
		return 0;
	}
	
	if( close.length < 10 ){
		showAlert("Invalid Input", "Please enter a valid close date");
		return 0;
	}
	
	var rooms = '';
	var opens = '';
	var close = '';
	var instr = '';
	var skill = '';
	
	$('.ev_room').each(function(i){
		rooms += $(this).val() + ',';
	});
	
	$('.ev_open').each(function(i){
		opens += $(this).val() + ',';
	});
	
	$('.ev_close').each(function(i){
		close += $(this).val() + ',';
	});
	
	$('.ev_instrument option:selected').each(function(i){
		instr += $(this).val() + ',';
	});
	
	$('.ev_skill option:selected').each(function(i){
		skill += $(this).val() + ',';
	});
	
	
	var query = '&name='+name+
					'&venue='+venue+
					'&cost='+cost+
					'&open='+open+
					'&close='+close+
					'&rooms='+rooms+
					'&opens='+opens+
					'&close='+close+
					'&instr='+instr+
					'&skill='+skill;
	

	$.get('/lobster/controller/forms.php?q=InsertEvent'+query, function(res){
		showAlert('Succes', 'You have added a new venue successfully.');
		window.location = '?controller=events';
	});

});

$('.event_edit').click(function(){
	var id = $(this).text();
	
	$.get('/lobster/controller/forms.php?q=EditEvent&id='+id, function(res){
		showEditForm('Set up event details', res);
	});
});


$('#evEdit_cancel').live('click', function(){
	hideEditForm();
});

$('.ev_new_row').live('click', function(){
	var row = $(this).parent().parent().html();
	
	$(this).parent().parent().parent().append('<tr>'+row+'</tr>');
});

$('.ev_les_row').live('click', function(){
	var rooms = $('#all_rooms tr');
	
	if(rooms.length > 2)
		$(this).parent().parent().remove();
});


$('.register_edit').live('click', function(){
	var id = $(this).text();
	$.get('/lobster/controller/forms.php?q=FestivalRegister&id='+id, function(res){
		showEditForm('Register Students to a Festival', res);
	});
});

$('#gfr_cancel').live('click', function(){
	hideEditForm();
});

$('#stud_register').live('click', function(){

	var e_id = $('#stud_e_id').val();
	var s_id = $('#stud_list option:selected').val();
	var room = $('#stud_type option:selected').val();
	var query = '&event='+e_id+'&id='+s_id+'&room='+room;

	$.get('/lobster/controller/forms.php?q=RegisterStudent'+query, function(res){
		showAlert('Succes', 'You have added a new venue successfully.');
		window.location = '?controller=events';
	});
});