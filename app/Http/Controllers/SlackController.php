<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

class SlackController extends Controller
{

    public function getChannels()
    {
        $channels = $this->callApi('conversations.list', 'GET');

        return $channels->channels;
    }

    public function sendNotificaton($channels_id, $taskName, $taskDescription, $clickupUrl)
    {
        $notifications = $this->callApi("chat.postMessage", "POST", [
            "channel" => $channels_id,
            "blocks" => [
                [
                    "type" => "section",
                    "text" => [
                        "type" => "mrkdwn",
                        "text" => "*NEW TASK CREATED IN CLICKUP!*\n" . $taskName . "\n" . $taskDescription
                    ]
                ],
                [
                    "type" => "section",
                    "text" => [
                        "type" => "mrkdwn",
                        "text" => "<" . $clickupUrl . "|Click for more>"
                    ]
                ]
            ]
        ]);

        return $notifications;
    }

    private function callApi($endpoint, $http_method, $payload = [])
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer " . env('SLACK_TOKEN'),
                "Content-Type: application/json"
            ],
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_URL => "https://slack.com/api/" . $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $http_method,
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        if ($error) {
            throw new Exception("cURL Error #:" . $error);
        } else {
            return json_decode($response);
        }
    }
}
