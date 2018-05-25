<?php
// AWS SDK for PHP 2を読み込む
require_once '/home/newpropertylist.my/bin/aws.phar';

use Aws\Ses\SesClient,
    Aws\Ses\Exception\SesException,
    Aws\Common\Enum\Region;
 
$client = SesClient::factory(array(
    'key'    => 'AKIAI6VJYY35W42DMOVQ',
    'secret' => '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',
    'region' => Region::US_EAST_1,
));

$to = $argv[1];
$subject = $argv[2];
$body = $argv[3];
 
try {
    $client->sendEmail(array(
        'Source' => 'newpropertylist@samurai-internet.com',
        'Destination' => array(
            'ToAddresses' => array($to),
        ),
        'Message' => array(
            'Subject' => array(
                'Data' => $subject,
            ),
            'Body' => array(
                'Text' => array(
                    'Data' => $body,
                ),
            ),
        ),
    ));
} catch (SesException $e) {
} 
