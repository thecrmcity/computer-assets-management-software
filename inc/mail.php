<?php


$mail = new PHPMailer;

$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = '10.20.10.18';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'admin.support@silaris.in';                 // SMTP username
$mail->Password = 'google@555';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 25;                                    // TCP port to connect to


     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('rajesh.bisht@silaris.in', 'Rajesh Bisht');
$mail->addCC('rajesh.bisht@silaris.in','Rajesh Bisht');
$mail->addCC('chaman.kaul@silaris.in','Chaman Kaul');
$mail->addCC('samarth.jain@silaris.in','Samarth Jain');
$mail->addCC('emailer@silaris.in','Emailer');

//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML


//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
$mail->setFrom('admin.support@silaris.in', 'Admin Support');
$mail->addAddress('pinaki.narendra@silaris.in', 'Pinaki Narendra');


?>