<?php

$today= time();

$email_send = $_REQUEST['email_send'];
$pmid_send = $_REQUEST['pmid_send'];
$title_send = $_REQUEST['title_send'];
$author_send = $_REQUEST['author_send'];
$publication_send = $_REQUEST['publication_send'];


// Check if the user email is valid:
$pos = strpos($email_send, '@');
if ($pos == NULL)
	$error = 1;
else
{
	$from_user = $email_send; 
	$to = "hippocampome@gmail.com"; 
	$subject = "New Article from PMID";
	
	$mess_text="
				$today ------------ \n
				Insert this new aricle:\n\n
				PMID: $pmid_send \n
				Title: $title_send \n
				Author: $author_send \n
				Publication: $publication_send \n
				Email user: $from_user
				\n\n
				Thanks \n
	";
	
	require_once('class/class.phpgmailer.php');
	$mail = new PHPGMailer();
	$mail->Username = 'hippocampome@gmail.com';
	$mail->Password = 'ascoli08';
	
	$mail->From = 'Hippocampome';
	$mail->FromName = 'Hippocampome';
	$mail->Subject = $subject;
	$mail->AddAddress($to);//to:email address
	$mail->Body = $mess_text;
	$mail->Send();
}
?>

<%@LANGUAGE="JAVASCRIPT" CODEPAGE="1252"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Send Email</title>
<script type="text/javascript" src="style/resolution.js"></script>
</head>
<body>

<!-- COPY IN ALL PAGES -->
<?php include ("function/title.php"); ?>

<div align="center">
<br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
if ($error == 1)
	print ("<font face='Verdana, Arial, Helvetica, sans-serif' color='red' size='4'>Email address not valid</font>");
else
		print ("<font face='Verdana, Arial, Helvetica, sans-serif' color='red' size='4'>Your information was sent successfully. Thanks</font>");
?>
<br /><br />
</div>
</body>
</html>
