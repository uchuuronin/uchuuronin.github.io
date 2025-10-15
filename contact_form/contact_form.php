<?php

// configure
$from = 'no-reply@uchuuronin.github.io'; // Replace it with Your Hosting Admin email. REQUIRED!
$sendTo = 'ssharma0@umass.edu'; // Replace it with Your email. REQUIRED!
$subject = 'New message from contact form';
$fields = array('name' => 'Name', 'email' => 'Email', 'subject' => 'Subject', 'message' => 'Message'); // array variable name => Text to appear in the email. If you added or deleted a field in the contact form, edit this array.
$okMessage = 'Thank you for reaching out, I will get back to you soon!';
$errorMessage = 'Sorry, there was an error while submitting the mail. Please try again later or click the mail icon on the left to send one directly! Hope to hear from you soon!';

// let's do the sending
$responseData = (object)['success' => true];
if($responseData->success):

    try
    {
        $emailText = nl2br("You have new message from Contact Form\n");

        foreach ($_POST as $key => $value) {

            if (isset($fields[$key])) {
                $emailText .= nl2br("$fields[$key]: $value\n");
            }
        }

        $headers = array('Content-Type: text/html; charset="UTF-8";',
            'From: ' . $from,
            'Reply-To: ' . $from,
            'Return-Path: ' . $from,
        );
        
        mail($sendTo, $subject, $emailText, implode("\n", $headers));

        $responseArray = array('type' => 'success', 'message' => $okMessage);
    }
    catch (\Exception $e)
    {
        $responseArray = array('type' => 'danger', 'message' => $errorMessage);
    }

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $encoded = json_encode($responseArray);

        header('Content-Type: application/json');

        echo $encoded;
    }
    else {
        echo $responseArray['message'];
    }

else:
    $errorMessage = 'Robot verification failed, please try again.';
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
    $encoded = json_encode($responseArray);

        header('Content-Type: application/json');

        echo $encoded;
endif;

