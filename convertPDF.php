<?php

$servername = "localhost";
$username = "jmtrax";
$password = "s0na@bebe123";
$dbname = "jmtrax";


 require_once 'mailchimp-mandrill-api-php/src/Mandrill.php'; //Not required with Composer

$b64Doc = chunk_split(base64_encode(file_get_contents('senders/7946334593/receipt/12713.pdf')));

try {
    $mandrill = new Mandrill('y6pYJfH1RIF60O0ipBmkSA');
    $template_name = 'Receipt Email';
    $message = array(
        'subject' => 'Your transfer receipt with JMTrax',
        'from_email' => 'info@jmtrax.com',
        'from_name' => 'JMTrax',
        'to' => array(
            array(
                'email' => 'machelslack@icloud.com',
                'name' => 'Machel Slack',
                'type' => 'to'
            )
        ),
        'headers' => array('Reply-To' => 'info@jmtrax.com'),
        'important' => false,
        'track_opens' => null,
        'track_clicks' => null,
        'auto_text' => null,
        'auto_html' => null,
        'inline_css' => null,
        'url_strip_qs' => null,
        'preserve_recipients' => null,
        'view_content_link' => null,
        'tracking_domain' => null,
        'signing_domain' => null,
        'return_path_domain' => null,
        'merge' => true,
        'merge_language' => 'mailchimp',
        'global_merge_vars' => array(
            array(
                'name' => 'sendersFirstname',
                'content' => 'merge1 content'
            ),array(
                'name' => 'senderLastname',
                'content' => 'merge1 content'
            )
        ),'attachments' => array(
            array(
                'type' => 'application/pdf',
                'name' => 'myfile.pdf',
                'content' => $b64Doc
            )
        )
        
    );
    $async = false;
    $ip_pool = 'Main Pool';
    $send_at = '2017-03-22 12:00:00';
    $result = $mandrill->messages->sendTemplate($template_name, $template_content, $message, $async, $ip_pool, $send_at);
    print_r($result);
    /*
    Array
    (
        [0] => Array
            (
                [email] => recipient.email@example.com
                [status] => sent
                [reject_reason] => hard-bounce
                [_id] => abc123abc123abc123abc123abc123
            )
    
    )
    */
} catch(Mandrill_Error $e) {
    // Mandrill errors are thrown as exceptions
    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
    // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
    throw $e;
}


?>