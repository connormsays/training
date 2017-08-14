$('#email').focusout(function(){
	var username = $('#email').val();
	$.post('./inc/ajax/register.php', {email: username}, function(data){
		if(data == "User Exists")
		{
			$('#emailError').show();
			$('#submit').attr('disabled', true);
		}
		else
		{	
			$('#emailError').hide();
			$('#submit').attr('disabled', false);
		}
	});
});

$('#pass2').focusout(function(){
	var pass1 = $('#pass1').val();
	var pass2 = $('#pass2').val();
	if(pass1 != pass2)
	{
		$('#passError').show();
		$('#submit').attr('disabled', true);
	}else
	{
		$('#passError').hide();
		$('#submit').attr('disabled', false);
	}
});

$('#postcode_lookup').getAddress({
    api_key: 'Qt-UkrwJX0-HwOnRo3Ld9g7425',  
    output_fields:{
        line_1: '#addr1',
        line_2: '#addr2',
        line_3: '#addr3',
        post_town: '#town',
        county: '#county',
        postcode: '#postcode'
    },

});

$('#opc_input').addClass('form-control');