/*
  Jquery Validation using jqBootstrapValidation
   example is taken from jqBootstrapValidation docs 
  */
function response(first, last, attend, email, guest_attend, guest_name, guest_email, arrangements, message) {
    this.first_name = first;
    this.last_name = last;
    this.attend = attend;
    this.email = email;
    this.guest_attend = guest_attend;
    this.guest_name = guest_name;
    this.guest_email = guest_email;
    this.arrangements = arrangements;
    this.message = message;
}

$(function() {
    
    //Form hide/show areas.
    $('input[name="attend"]').click(function() {
        
        if($('#attend_yes').is(':checked')) { 
            $('#email').attr('placeholder', 'E-mail');
            $('#guest, input[name="email"]').fadeIn();
            $('#rsvp_email').fadeIn();
            $('#rsvp_message').fadeOut();
            $('#message').attr('placeholder', 'Message for the happy couple');
            $('#guest_email').attr('placeholder', 'E-Mail');
            $('#guest_first_name').attr('placeholder', 'First Name');
            $('#guest_last_name').attr('placeholder', 'Last Name');
            $('#guest_attend').prop('checked', false);
        }else{
            console.log('This person is not attending.');
            $('#guest, #rsvp_guest_info, input[name="email"]').fadeOut();
            $('#rsvp_arrangements').fadeOut();
            $('#rsvp_email').fadeOut();
            $('#message').val('').attr('placeholder', 'Regrets');
            $('#rsvp_message').fadeIn();
            $('#guest_attend_no').prop('checked', true);
            $('#arrangements_other').prop('checked', true);
            $('#rsvp_guest_info input[type="text"]').val('none');
        }

        $('input[name="guest_attend"]').click(function() {
            console.log("you made a selection about your guest!");
            $('#rsvp_message').fadeIn(); //add #arrangements, 
            $('#rsvp_arrangements').fadeIn();
//            
            if($('#guest_attend_yes').is(':checked')) { 
                $('#guest_email').attr('placeholder', 'E-Mail');
                $('#guest_first_name').attr('placeholder', 'First Name');
                $('#guest_last_name').attr('placeholder', 'Last Name');
                $('#rsvp_guest_info').fadeIn();
            }else{
                $('#rsvp_guest_info').fadeOut();
                $('#rsvp_guest_info input[type="text"]').val('none');
            }
        });
    });

  $('form[name="sentMessage"]').find('input,select,textarea').not('[type=image]').jqBootstrapValidation(
    {
     preventSubmit: true,
     submitError: function($form, event, errors) {
      // something to have when submit produces an error ?
      // Not decided if I need it yet
     },
     submitSuccess: function($form, event) {
      event.preventDefault(); // prevent default submit behaviour
         var attending = $("input[name='attend']:checked").val();
         var val_err_msg = " ";
         var proceed = true;
            if (  ($("input[name='attend']").is(':checked'))  &&  (attending == 'yes') && (!$("input[name='guest_attend']").is(':checked')) ){
                    val_err_msg += '<li>Please select if you are bringing a guest.</li>';
                    $('.guest-error').append(val_err_msg);
                    proceed = false; //set do not proceed flag
            } 

            if (!$("input[name='attend']").is(':checked')) {
                val_err_msg += '<li>Please select whether or not you will be attending.</li>';
                $('.attend-error').append(val_err_msg);
                proceed = false; //set do not proceed flag
            }
            if (  ($("input[name='attend']").is(':checked'))  &&  (attending == 'yes') && ($("input[name='guest_attend']").is(':checked') && (!$("input[name='arrangements']").is(':checked'))) ){
                    val_err_msg += '<li>Please select what arrangements you prefer.</li>';
                    $('.arrangements-error').append(val_err_msg);
                    proceed = false; //set do not proceed flag
            } 
         
       // get values from FORM
        var first_name = $("input#first_name").val();
        var last_name = $("input#last_name").val();
        var email = $("input#email").val(); 
        var message = $("textarea#message").val();
        var attend = $("#contactForm input[name='attend']:checked").val();
        var guest_first_name = $("input#guest_first_name").val(); 
        var guest_last_name = $("input#guest_last_name").val(); 
        var guest_email = $("input#guest_email").val(); 
        var guest_attend = $("#contactForm input[name='guest_attend']:checked").val();
        var arrangements = $("#contactForm input[name='arrangements']:checked").val();
        var name = first_name + ' ' + last_name;
         
         if ($("input[name='guest_attend']").is(':checked') && (guest_first_name == '')){
                guest_first_name = 'none';
            }
         if ($("input[name='guest_attend']").is(':checked') && (guest_last_name == '')){
                guest_last_name = 'none';
            }
         if ($("input[name='guest_attend']").is(':checked') && (guest_email == '')){
                guest_email = 'none';
            }
         if (message == ''){
                message = 'none';
            }
         if (email == ''){
                email = 'none';
            }
         if (guest_email == ''){
                guest_email = 'none';
            }
        var name = first_name + last_name;
        var guest_name = guest_first_name + ' ' + guest_last_name;
        
        console.log("Passing name: " + first_name + ", " + last_name + ", email: " + email + ", message: " + message + ", attend: " + attend + ", guest name: " + guest_first_name + ", " + guest_last_name + ", guest_email: " + guest_email + ", guest attend: " + guest_attend + ", arrangements: " + arrangements + " ...through ajax. Proceed = " + proceed);        
         
         if(proceed !== false){
	 $.ajax({
                url: "./bin/form.php",
            	type: "POST",
            	data: {first_name: first_name, last_name: last_name, email: email, message: message, attend: attend, guest_name: guest_name, guest_email: guest_email, guest_attend: guest_attend, arrangements: arrangements},
            	cache: false,
            	success: function() {  
            	// Success message
            	   $('#success').html("<div class='alert alert-success'>");
            	   $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            		.append( "</button>");
            	  $('#success > .alert-success')
            		.append("<strong>Sorry "+first_name+" it seems that my mail server is not responding...</strong> Could you please email me directly to <a href='mailto:thehappycouple@arianeanddustyn.com?Subject=Message_Me from arianeanddustyn.com'>thehappycouple@arianeanddustyn.com</a> ? Sorry for the inconvenience!"); //force error until servers work again!
//                    .append("<strong>Your message has been sent. </strong>");
 		  $('#success > .alert-success')
 			.append('</div>');
 						    
 		  //clear all fields
 		  $('#contactForm').trigger("reset");
 	      },
 	   error: function() {		
 		// Fail message
 		 $('#success').html("<div class='alert alert-danger'>");
            	$('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            	 .append( "</button>");
            	$('#success > .alert-danger').append("<strong>Sorry "+first_name+" it seems that my mail server is not responding...</strong> Could you please email me directly to <a href='mailto:thehappycouple@arianeanddustyn.com?Subject=Message_Me from arianeanddustyn.com'>thehappycouple@arianeanddustyn.com</a> ? Sorry for the inconvenience!");
 	        $('#success > .alert-danger').append('</div>');
 		//clear all fields
 		$('#contactForm').trigger("reset");
 	    },
           });
     }
         },
         filter: function() {
                   return $(this).is(":visible");
         },
       });

      $("a[data-toggle=\"tab\"]").click(function(e) {
                    e.preventDefault();
                    $(this).tab("show");
        });
  });
 

/*When clicking on Full hide fail/success boxes */ 
$('#name').focus(function() {
     $('#success').html('');
  });