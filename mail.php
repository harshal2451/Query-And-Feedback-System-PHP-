<?php
            include_once("class.phpmailer.php");
            $mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
			$mail->Username = "patilharshal2451@gmail.com";
			$mail->Password = "Arpita72**";
			$mail->SetFrom("patilharshal2451@gmail.com");
			$mail->Subject = "Fault Detected";
			//$mail->AddEmbeddedImage('logo1.png', 'logo1', 'logo1.png');

	
$msg=" 
<div style=height:300px; width:300px;>Hello
<center>"; 

$mail->Body = $msg; 


$mail->AddAddress("harshalpatil2451@gmail.com");

	
	if(!$mail->send())
	{
		echo "not send";
	}
	else
	{
			
	echo "<h1>send maile";
		
	}
?>