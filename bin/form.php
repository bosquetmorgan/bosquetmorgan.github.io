<?php
// check if fields passed are empty
if(empty($_POST['first_name']) || empty($_POST['last_name'])){
    echo "No arguments Provided!";
    mail('audrey.bosquet@gmail.com', 'error', 'The name was empty, oops!', 'From: arianeanddustyn.com');
	return false;
}

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$name = $first_name . ' ' . $last_name;

if(empty($_POST['email'])){
    echo "No arguments Provided!";
    mail('audrey.bosquet@gmail.com', 'error', "$name tried to submit your form, but the email was empty, oops!", 'From: arianeanddustyn.com');
	return false;
}
if(empty($_POST['attend'])){
    echo "No arguments Provided!";
    mail('audrey.bosquet@gmail.com', 'error', "$name tried to submit your form, but the attend was empty, oops!", 'From: arianeanddustyn.com');
	return false;
}
if($_POST['email'] != 'none' && !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
    mail('audrey.bosquet@gmail.com', 'error', ' $name tried to submit your form, but the email was wrong, oops!', 'From: arianeanddustyn.com');
	return false;
   }
if(empty($_POST['guest_name'])){
    echo "No arguments Provided!";
    mail('audrey.bosquet@gmail.com', 'error', "$name tried to submit your form, but the guest name was empty, oops!", 'From: arianeanddustyn.com');
	return false;
}
   
if(empty($_POST['guest_email'])){
    echo "No arguments Provided!";
    $name = $_POST['name'];
    mail('audrey.bosquet@gmail.com', 'error', "$name tried to submit your form, but the guest email was empty, oops!", 'From: arianeanddustyn.com');
	return false;
}
if(empty($_POST['guest_attend'])){
    echo "No arguments Provided!";
    $name = $_POST['name'];
    mail('audrey.bosquet@gmail.com', 'error', "$name tried to submit your form, but the guest attend was empty, oops!", 'From: arianeanddustyn.com');
	return false;
}
if(empty($_POST['arrangements'])){
    echo "No arguments Provided!";
    mail('audrey.bosquet@gmail.com', 'error', "$name tried to submit your form, but the arrangements was empty, oops!", 'From: arianeanddustyn.com');
	return false;
}

$email = $_POST['email'];
$message = $_POST['message'];
$attend = $_POST['attend'];
$guest_name = $_POST['guest_name'];
$guest_email = $_POST['guest_email'];
$guest_attend = $_POST['guest_attend'];
$arrangements = $_POST['arrangements'];


if($attend == 'no'){
    $email_body = "$name regretfully declines your invitation. \n\n".
        "message: \n $message";
}
elseif($guest_attend == 'no'){
    $email_body = "$name has accepted your invitation! \n\n".
        "$first_name will not be bringing a guest \n".
        "$first_name has indicated an lodging choice of: $arrangements \n".
        "You can reach $first_name at $email.\n\n".
        "Message: \n $message";
}
else{ 
    $email_body = "$name has accepted your invitation! \n\n".
        "$first_name is bringing a guest. Guest information that follows may or may not be complete: \n".
        "Guest Name: $guest_name, Guest Email: $guest_email\n".
        "$first_name has indicated an lodging choice of: $arrangements \n\n".
        "You can reach $first_name at $email.\n\n".
        "Message: \n $message";
}

$to = 'thehappycouple@arianeanddustyn.com'; // put your email
$email_subject = "Contact form submitted by: $name";

$headers = "From: $name ";
$headers .= "Reply-To: RSVP ";	
mail($to,$email_subject,$email_body,$headers);
return true;			
?>