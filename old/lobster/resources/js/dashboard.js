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

$('.view_all').live('click', function(){
	var table = $(this).attr('id');
	$('#'+table).prev().fadeTo(1,0.5);
	$.get('/lobster/controller/refresh.php?q=viewAll&t='+table.substr(table.indexOf('get')), function(res){
		$('#'+table).prev().fadeTo(1,1.0);
		$('#'+table).prev().html(res);
		$('#'+table).remove();
	});
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

$('.student_edit').live('click', function(){
	var id = $(this).html();
	
	$.get('/lobster/controller/forms.php?q=StudentEdit&id='+id, function(res){
		showEditForm('Edit Student Information', res);
		
		$('#student_update').click(function(){
			var first_name = $('#gse_first_name').val();
			var last_name = $('#gse_last_name').val();
			var birthdate = $('#gse_birthdate').val();
			
			if(first_name.length < 1){
				showAlert('Incomplete Request', 'Please enter a valid first name');
				return 0;
			}
			
			if(last_name.length < 1){
				showAlert('Incomplete Request', 'Please enter a valid last name');
				return 0;
			}
			
			if(birthdate.length < 10){
				showAlert('Incomplete Request', 'Please enter a valid birthdate (ccyy-mm-dd)');
				return 0;
			}
			
			var query = '&first_name=' + first_name + 
							'&last_name=' + last_name + 
							'&birthdate=' + birthdate + 
							'&instrument=' + $('#sel_instrument option:selected').val();

			$.get('/lobster/controller/edit-students.php?q=u&t=PersonalInfo&id='+id+query, function(res){
				if(res){
					window.location = '?controller=dashboard';
				}
			});
		});
		
		$('#student_remove').click(function(){

			$.get('/lobster/controller/edit-students.php?q=u&t=Unregister&id='+id, function(res){
				if(res){
					window.location = '?controller=dashboard';
				}
			});
		});
		
		$('#stuEdit_cancel').click(function(){
			hideEditForm();
		});
	});
});

$('#new_submit').live('click', function(){

	var first_name = $('#new_first_name').val();
	var last_name = $('#new_last_name').val();
	var birthdate = $('#new_birthdate').val();
	var instrument = $('#new_instrument option:selected').val();
	
	if(first_name.length < 1){
		showAlert('Incomplete Request', 'Please enter a valid first name');
		return 0;
	}
	
	if(last_name.length < 1){
		showAlert('Incomplete Request', 'Please enter a valid last name');
		return 0;
	}
	
	if(birthdate.length < 10){
		showAlert('Incomplete Request', 'Please enter a valid birthdate (ccyy-mm-dd)');
		return 0;
	}
	
	var query = '&first_name=' + $('#new_first_name').val() +
					'&last_name=' + $('#new_last_name').val() +
					'&birthdate=' + $('#new_birthdate').val() +
					'&instrument=' + instrument;

	$.get('/lobster/controller/select.php?q=u&t=StudentInfo&'+query, function(res){
		// new student added and linked
		if( res == 'success' ){
			showAlert('Success!', 'Student added successfully!');
			window.location = '?controller=dashboard';
		}
		else if( res == 'already' ){
			showAlert('Oops...', 'It appears that you are already teaching this student.');
		}

		else if( res == 'different' ){
			$.get('/lobster/controller/forms.php?q=NoTeacher', function(res){
				showEditForm('Existing student', res);

				$('#already_cancel').live('click', function(){
					hideEditForm();
				});
				
				$('#already_add').live('click', function(){

					$.get('/lobster/controller/edit-students.php?q=u&t=StudentOverride&'+query, function(res){

						// new student added and linked
						if( res == 'success' ){
							showAlert('Success!', 'Student added successfully!');
							window.location = '?controller=dashboard';
						}
					});
				});
			});
		}
	});
});

$('#new_t_submit').click(function(){
	
	var first_name = $('#new_t_first_name').val();
	var last_name = $('#new_t_last_name').val();
	var phone = $('#new_t_phone').val();
	var email = $('#new_t_email').val();
	var member_id = $('#new_t_member_id').val();
	var role = $('#new_t_role option:selected').val();
	
	if( first_name.length < 1 ){
		showAlert('Incomplete Request', 'Please enter a valid first name');
		return 0;
	}
	
	if( last_name.length < 1 ){
		showAlert('Incomplete Request', 'Please enter a valid last name');
		return 0;
	}
	
	if( phone.length < 10 ){
		showAlert('Incomplete Request', 'Please enter a valid phone number');
		return 0;
	}
	
	if( email.length < 5 ){
		showAlert('Incomplete Request', 'Please enter a valid email address');
		return 0;
	}
	
	if( member_id.length < 4 ){
		showAlert('Incomplete Request', 'Please enter a valid teacher membership id');
		return 0;
	}
	
	$('#new_teacher').fadeTo(1,0.5);

	var query = '&first_name=' + first_name +
					'&last_name=' + last_name +
					'&phone=' + phone +
					'&email=' + email +
					'&member_id=' + member_id +
					'&role=' + role;

	$.get('/lobster/controller/select.php?q=u&t=NewTeacher'+query, function(res){
		
		$('#new_teacher').fadeTo(1,1.0);
		if( res.indexOf('already') >= 0 ){
			showAlert('Oops...', 'It appears that this teacher is already in our system.');
		}
		else if( res.indexOf('success') >= 0 ){
			window.location = '?controller=dashboard';
		}
		else{
			showAlert('Oops...', res);
		}

		showAlert('Success!', 'New teacher added successfully!');
	});
});


$('#new_s_submit_admin').click(function(){

	var first_name = $('#new_s_first_name_admin').val();
	var last_name = $('#new_s_last_name_admin').val();
	var birthdate = $('#new_s_birthdate_admin').val();
	var instrument = $('#new_s_instrument_admin option:selected').val();
	var teacher = $('#new_s_teacher_admin option:selected').val();
	
	if( first_name.length < 1 ){
		showAlert('Incomplete Request', 'Please enter a valid first name');
		return 0;
	}
	
	if( last_name.length < 1 ){
		showAlert('Incomplete Request', 'Please enter a valid last name');
		return 0;
	}
	
	if( birthdate.length < 10 ){
		showAlert('Incomplete Request', 'Please enter a valid birthdate');
		return 0;
	}
	

	$('#new_student_admin').fadeTo(1,0.5);

	var query = '&first_name=' + first_name +
					'&last_name=' + last_name +
					'&birthdate=' + birthdate +
					'&instrument=' + instrument +
					'&teacher=' + teacher;

	$.get('/lobster/controller/select.php?q=u&t=NewStudentAdmin'+query, function(res){
		$('#new_student_admin').fadeTo(1, 1.0);

		if( res.indexOf('already') >= 0 ){
			showAlert('Oops...', 'It appears that this teacher is already in our system.');
			return 0;
		}
		
		if( res.indexOf('success') >= 0 ){
			showAlert('Success!', 'New student added successfully!');
			window.location = '?controller=dashboard';
			return 0;
		}

		showAlert('Oops...', res);
	});
});


$('.teacher_edit').live('click', function(){
	showAlert('Finish this!', 'Teacher edit form. To edit: 1. first_name 2. last_name 3. phone 4. email 5. member id 6. role 7. reset password (to default byui123)');
});

$('.student_edit_admin').live('click', function(){
	showAlert('Finish this, too!', 'Student info. To edit: 1. first_name 2. last_name 3. birthdate 4. teacher 5. instrument');
});