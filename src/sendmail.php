<?php

require 'vendor/autoload.php';
$subject = "Welcome to a test subject mail";

$msg = "this is a wonderful message, but we don't know why it is not working all the times!";

$transport = new Swift_SendmailTransport('/usr/sbin/sendmail -bs');

$from[1] = 'CACF Service Desk';
$from[0] = 'cacf_sd@cz.ibm.com';
// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);
$message = (new Swift_Message($subject));
// Create a message
$message->setFrom(array($from[0] => $from[1]));

$message->setBody($msg, 'text/html');

$addr = $_POST['email'];

$message->addTo($addr);


$mailer->send($message);