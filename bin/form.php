<?php
// check if fields passed are empty
if(empty($_POST['first_name']) || empty($_POST['last_name'])){
    echo "No arguments Provided!";
    mail('audrey.bosquet@gmail.com', 'error', 'The name was empty, oops!', 'From: arianeanddustyn.com');
	return false;
}
   
if(empty($_POST['email'])){
    echo "No arguments Provided!";
    $name = $_POST['name'];
    mail('audrey.bosquet@gmail.com', 'error', ' $name tried to submit your form, but the email was empty, oops!', 'From: arianeanddustyn.com');
	return false;
}
if(empty($_POST['attend'])){
    echo "No arguments Provided!";
    $name = $_POST['name'];
    mail('audrey.bosquet@gmail.com', 'error', ' $name tried to submit your form, but the attend was empty, oops!', 'From: arianeanddustyn.com');
	return false;
}
if($_POST['email'] != 'none' && !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
    $name = $_POST['name'];
    mail('audrey.bosquet@gmail.com', 'error', ' $name tried to submit your form, but the email was wrong, oops!', 'From: arianeanddustyn.com');
	return false;
   }
if(empty($_POST['guest_first_name'])|| empty($_POST['guest_last_name'])){
    echo "No arguments Provided!";
    $name = $_POST['name'];
    mail('audrey.bosquet@gmail.com', 'error', ' $name tried to submit your form, but the guest name was empty, oops!', 'From: arianeanddustyn.com');
	return false;
}
   
if(empty($_POST['guest_email'])){
    echo "No arguments Provided!";
    $name = $_POST['name'];
    mail('audrey.bosquet@gmail.com', 'error', ' $name tried to submit your form, but the guest email was empty, oops!', 'From: arianeanddustyn.com');
	return false;
}
if(empty($_POST['guest_attend'])){
    echo "No arguments Provided!";
    $name = $_POST['name'];
    mail('audrey.bosquet@gmail.com', 'error', ' $name tried to submit your form, but the guest attend was empty, oops!', 'From: arianeanddustyn.com');
	return false;
}
if(empty($_POST['arrangements'])){
    echo "No arguments Provided!";
    $name = $_POST['name'];
    mail('audrey.bosquet@gmail.com', 'error', ' $name tried to submit your form, but the arrangements was empty, oops!', 'From: arianeanddustyn.com');
	return false;
}
	
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$message = $_POST['message'];
$attend = $_POST['attend'];
$guest_first_name = $_POST['guest_first_name'];
$guest_last_name = $_POST['guest_last_name'];
$guest_email_address = $_POST['guest_email'];
$guest_attend = $_POST['guest_attend'];
$arrangements = $_POST['arrangements'];

$to = 'audrey.bosquet@gmail.com'; // put your email
$email_subject = "Contact form submitted by: $first_name $last_name";

$email_body = "$first_name $last_name has accepted your invitation! $first_name is also bringing a guest! \n".
                    "guest information is not required but may have been submitted (will appear as normal or none) /n guest name: $guest_first_name $guest_last_name, guest email: $guest_email\n",
                    "$first_name has selected the following arrangements: $arrangements\n",
                    "Message as follows: $message";

//if($attend == 'no'){
//    $email_body = "$first_name $last_name has regretfully declined your invitation. \n".
//                    "Message as follows: $message";
//}
//elseif($guest_attend == 'no'){
//    $email_body = "$first_name $last_name has accepted your invitation! $first_name is not planning on bringing a guest \n".
//                    "$first_name has selected the following arrangements: $arrangements\n",
//                    "you may contact $first_name at $email.\n",
//                    "Message as follows: $message";
//}
//else{
//    $email_body = "$first_name $last_name has accepted your invitation! $first_name is also bringing a guest! \n".
//                    "guest information is not required but may have been submitted (will appear as normal or none) /n guest name: $guest_first_name $guest_last_name, guest email: $guest_email\n",
//                    "$first_name has selected the following arrangements: $arrangements\n",
//                    "Message as follows: $message";
//}

// create email body and send it	
$headers = "From: arianeanddustyn.com";
$headers .= "Reply-To: $email_address";	
mail($to,$email_subject,$email_body,$headers);
return true;			
?>