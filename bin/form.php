<?php
// check if fields passed are empty
if(empty($_POST['name'])  		||
   empty($_POST['attend']) 		||
   empty($_POST['email']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }
	
$name = $_POST['name'];
$email_address = $_POST['email'];
$message = $_POST['message'];
$attend = $_POST['attend'];
$attend_message = 'regretfully declines your wedding invitation.';

if($attend == 'yes'){
    $attend_message = 'has happily accepted your wedding invitation!';
}
	
// create email body and send it	
$to = 'audrey.bosquet@gmail.com'; // put your email
$email_subject = "Contact form submitted by:  $name";
$email_body = "You have received a new response for your wedding. \n\n".
				  "$name $attend_message".
				  "Email: $email_address\n Message \n $message";
$headers = "From: arianeanddustyn.com\n";
$headers .= "Reply-To: $email_address";	
mail($to,$email_subject,$email_body,$headers);
return true;			
?>