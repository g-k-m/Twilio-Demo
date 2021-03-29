<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VoiceGrant;
use Twilio\TwiML\VoiceResponse;

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

class TwilioController extends Controller
{
    public function sendMessage()
    {
        // Your Account SID and Auth Token from twilio.com/console
        $sid = config('services.twilio_credentials.account_sid');
        $token = config('services.twilio_credentials.auth_token');
        $fromNumber = config('services.twilio_credentials.from_number');
        $toNumber = request('number');
        $message = request('message');
        $client = new Client($sid, $token);

        // Use the client to do fun stuff like send text messages!
        $client->messages->create(
            // the number you'd like to send the message to
            $toNumber,
            [
                // A Twilio phone number you purchased at twilio.com/console
                'from' => $fromNumber,
                // the body of the text message you'd like to send
                'body' => $message,
                // twilio will send post request to this URL after the message is sent
                // https://www.twilio.com/docs/sms/send-messages?code-sample=code-send-an-sms-with-a-statuscallback-url&code-language=PHP&code-sdk-version=6.x
                'statusCallback' => 'https://tel-sms.makesales.com/messagecallback'
            ]
        );
    }

    public function handleMessageCallback(Request $request)
    {
        $status = request('SmsStatus');

        if ($status === 'sent' || $status === 'delivered') {
            $message = 'Message sent!';

            return redirect()->route('gMessage')->with('alert', $message);
        }
    }

    public function createAccessToken()
    {
        // Required for all Twilio access tokens
        $twilioAccountSid = config('services.twilio_credentials.account_sid');
        $twilioApiKey = config('services.twilio_credentials.api_key');
        $twilioApiSecret = config('services.twilio_credentials.api_secret');

        // Required for Voice grant
        $outgoingApplicationSid = config('services.twilio_credentials.app_sid');
        // An identifier for your app - can be anything you'd like
        $identity = "john_doe";

        // Create access token, which we will serialize and send to the client
        $token = new AccessToken(
            $twilioAccountSid,
            $twilioApiKey,
            $twilioApiSecret,
            3600,
            $identity
        );

        // Create Voice grant
        $voiceGrant = new VoiceGrant();
        $voiceGrant->setOutgoingApplicationSid($outgoingApplicationSid);

        // Optional: add to allow incoming calls
        //$voiceGrant->setIncomingAllow(true);

        // Add grant to token
        $token->addGrant($voiceGrant);

        // render token to string
        return $token->toJWT();
    }

    public function handleVoiceRequest()
    {
        $response = new VoiceResponse();

        $to = request('To');

        if (!empty($to) && strlen($to) > 0) {
            $number = htmlspecialchars($to);
            $dial = $response->dial('', ['callerId' => config('services.twilio_credentials.from_number')]);

            // wrap the phone number or client name in the appropriate TwiML verb
            // by checking if the number given has only digits and format symbols
            if (preg_match("/^[\d\+\-\(\) ]+$/", $number)) {
                $dial->number($number);
            } else {
                $dial->client($number);
            }
        } else {
            $response->say("Thanks for calling!");
        }
        return (string)$response;
    }
}
