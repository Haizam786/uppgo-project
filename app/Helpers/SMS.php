<?php

namespace App\Helpers;

use Exception;
use Swagger\Client\ShoutoutClient;


class SMS{
    //Shout out sms function
    public static function sendSMS($destination, $content)
    {
        try {
            $apiKey = env('SHOUT_OUT_API_KEY');
    
            $client = new ShoutoutClient($apiKey, true, false); //(apikey,debug mode,ssl)
    
    
            $message = array(
                'source' => env('SHOUT_OUT_SOURCE'),
                'destinations' => [$destination],
                'content' => array(
                    'sms' => $content
                ),
                'transports' => ['SMS']
            );
    
            $result = $client->sendMessage($message);
            
            return 1;
        } catch (Exception $e) {
            return 0;
        }

    
    }
}